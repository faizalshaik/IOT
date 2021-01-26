<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Customer;
use App\ThingKind;
use App\Thing;
use App\Area;
use App\AreaNotify;
use App\DeviceModel;
use App\Track;
use App\Notify;

class CustomerController extends Controller
{

    private function pointInPolygon($point, $vertices) {
        $intersections = 0; 
        $vertices_count = count($vertices);

        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1]; 
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return 0;//"boundary";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return 0;
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++; 
                }
            } 
        } 

        //echo $intersections;
        // If the number of edges we passed through is odd, then it's in the polygon. 
        if ($intersections % 2 != 0) {
            return 1;//"inside";
        }
        return -1; //"outside";
    }

    private function findAreaByPosition($customerId, $lat, $lng)
    {
        $areas = Area::where(['customer_id'=>$customerId])->get();
        foreach($areas as $area)
        {
            $polygon = array();
            $region = json_decode($area->area_region);
            foreach($region as $pt)
            {
                $polygon[] = ['y'=>$pt[0],'x'=>$pt[1]];
            }
            if($this->pointInPolygon(['y'=>$lat, 'x'=>$lng], $polygon) < 0)
                continue;

            return $area;
        }
        return null;
    }

    private function updateThingsState($customerId)
    {
        $things = Thing::where(['customer_id'=>$customerId])->get();
        foreach($things as $thing)
        {
            $area = $this->findAreaByPosition($customerId, $thing->lat, $thing->lng);
            if($area!=null)
            {
                if($area->area_type=='green')
                    $thing->state = 'ok';
                else $thing->state = 'medium';
            }
            else
                $thing->state = 'critical';
            $thing->save();
        }
    }

    private function loginCheck(Request $request)
    {
        $user = null;
        if(isset($request->token))
        {
            $user = Customer::where(['remember_token'=>$request->token])->first();
        }
        return $user;
    }
    private function find_data($list, $id)
    {
        foreach($list as $itm)
        {
            if($itm->id == $id)
                return $itm;
        }
        return null;
    }

    public function change_password(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) {
            return ['status'=>401, 'message'=>'login error'];
        }
        
        if(!password_verify($request->cur_pwd, $user->password))
            return ['status'=>402, 'message'=>'incorrect current password'];

        $user->password = password_hash($request->new_pwd, PASSWORD_DEFAULT);
        $user->save();

        return ['status'=>200, 'message'=>'Password changed'];

    }

    public function change_profile(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) {
            return ['status'=>401, 'message'=>'login error'];
        }
        
        $user->notify_email = $request->notify_email;
        $user->notify_phone = $request->notify_phone;
        $user->save();

        return ['status'=>200, 'message'=>'Change saved!'];
    }

    public function areas(Request $request)
    {
        $user = $this->loginCheck($request);
        $data = array();

        if($user!=null) 
        {
            $data = array();
            $rows = Area::where(['customer_id'=>$user->id])->get();
            foreach($rows as $area)
            {
                $row = array();
                $row[] = $area->area_name;
                if($area->area_type=="farm")
                    $row[] = '<img class="thumb-xs" src="'. url('assets/images/app/farm.svg') . '"><span> <span>';
                else
                    $row[] = '<img class="thumb-xs" src="' . url('assets/images/app/enclosure.svg') . '"><span><span>';

                //$row[] = $area->area_type;
                // $row[] = $area->created_at;
                // $row[] = $area->updated_at;    
                $strAction = '<a href="javascript:void(0)" class="on-default edit-row" ' .
                    'onclick="onEditArea(' . $area->id . ')" title="Edit" ><i class="fa fa-pencil"></i></a><span> </span>' .
                    '<a href="javascript:void(0)" class="on-default edit-row" ' .
                	'onclick="onViewArea(' . $area->id . ')" title="View" ><i class="fa fa-eye text-success"></i></a><span> </span>' .
                	'<a href="javascript:void(0)" class="on-default remove-row" ' .
                	'onclick="onDeleteArea(' . $area->id . ')" title="Remove" ><i class="fa fa-trash-o text-danger"></i></a>';
                $row[] = $strAction;
                $data[] = $row;
            }
    
        }
        return [
            'draw' => null,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data
        ];
    }

    public function edit_area(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) {
            return ['status'=>401, 'message'=>'login error'];
        }

        $area = Area::where(['area_name'=>$request->new_area_name, 'customer_id'=>$user->id])->first();
        if($area != null && $request->id!=$area->id)
            return ['status'=>400, 'message'=>'Area already exist!'];

        if($request->id!=null && $request->id !="")
        {
            $area = Area::find($request->id);
            if($area==null)
                return ['status'=>400, 'message'=>'Kind id does not exist!'];
        }
        else
            $area = new Area;

        $area->customer_id = $user->id;
        $area->area_name = $request->new_area_name;
        $area->area_type = $request->new_area_type;
        if($request->id =="")
            $area->area_region = json_encode($request->new_area_region);
        $area->save();
        $this->updateThingsState($user->id);

        return ['status'=>200, 'message'=>'ok'];
    }


    public function del_area(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];

        $area = Area::find($request->id);
        if($area == null)
            return ['status'=>400, 'message'=>'Area id does not exist!'];

        //remove area_notify
        AreaNotify::where(['area_id'=>$request->id])->delete();

        //remove area
        $area->delete();
        $this->updateThingsState($user->id);        
        return ['status'=>200, 'message'=>'ok', 'data'=>null];
    }

    public function get_area(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];

        $area = Area::find($request->id);
        if($area == null)
            return ['status'=>400, 'message'=>'Area id does not exist!'];
        return ['status'=>200, 'message'=>'ok', 'data'=>$area];
    }


    public function get_area_details(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];
        $area = Area::find($request->id);
        if($area == null)
            return ['status'=>400, 'message'=>'Area id does not exist!'];        

        $polygon = array();
        $region = json_decode($area->area_region);
        foreach($region as $pt)
        {
            $polygon[] = ['y'=>$pt[0],'x'=>$pt[1]];
        }

        $entries = array();
        for($i=0; $i<5; $i++)
        {
            $entries[]= ['img'=>url('assets/images/app/setting_'.$i.'.svg'), 'devices'=>array()];
        }        

        $things = Thing::where(['customer_id'=>$user->id])->get();
        foreach($things as $thing)
        {     
            if($this->pointInPolygon(['y'=>$thing->lat, 'x'=>$thing->lng], $polygon) < 0)
                continue;           
            
            for($i=0; $i<5; $i++)
            {
                if($thing->monitor_settings & pow(2, $i) )
                {
                    $entries[$i]['devices'][]=['name'=>$thing->name, 'device'=>$thing->device_name];
                }
            }
        }

        // $entry1 = array('img'=>url('assets/images/app/setting_0.svg'), 
        //                 'devices'=>array(array('name'=>'Lola', 'device'=>'AH163'), 
        //                                 array('name'=>'Finla', 'device'=>'AH163')));
        // $entry2 = array('img'=>url('assets/images/app/setting_1.svg'),
        //             'devices'=>array(array('name'=>'Lola', 'device'=>'AH163'), 
        //                 array('name'=>'Finla', 'device'=>'AH163')));
        //$data = ['area'=>$area, 'list'=>[$entry1, $entry2]];
        $data = ['area'=>$area, 'list'=>$entries];        
        return ['status'=>200, 'message'=>'ok', 'data'=>$data];
    }
        

    public function devices(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];

        $kinds = ThingKind::all();
        $devices = DeviceModel::all();

        $data = array();
        $rows = Thing::where(['customer_id'=>$user->id])->get();
        foreach($rows as $thing)
        {
            $kind = $this->find_data($kinds, $thing->kind_id);
            if($kind==null) continue;

            $device = $this->find_data($devices, $thing->device_id);
            if($device==null) continue;            

            $newThing = $thing;
            $newThing->thumb_image = url($kind->thumb_image);
            if($thing->image!="")
                $thing->image = url($thing->image);
            $newThing->device_name = $device->model_name;
            $data[] = $newThing;
        }
        return ['status'=>200, 'message'=>'ok', 'data'=>$data];
    }

    public function del_device(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];

        $thing = Thing::find($request->id);
        if($thing == null)
            return ['status'=>400, 'message'=>'Device id does not exist!'];

        //remove area_notify
        AreaNotify::where(['thing_id'=>$request->id])->delete();

        //remove thing track
        Track::where(['thing_id'=>$request->id])->delete();

        //remove thing notify
        Notify::where(['thing_id'=>$request->id])->delete();
        
        //remove thing image
        if($thing->image!="" && file_exists($thing->image))
            unlink($thing->image);
        //remove thing        
        $thing->delete();
        return ['status'=>200, 'message'=>'ok', 'data'=>null];
    }    

    public function edit_device_0(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) {
            return ['status'=>401, 'message'=>'login error'];
        }

        $thing = Thing::where(['name'=>$request->info_edit_name, 'customer_id'=>$user->id])->first();
        if($thing != null && $request->id!=$thing->id)
            return ['status'=>400, 'message'=>'Device already exist!'];

        if($request->id!=null && $request->id !="")
        {
            $thing = Thing::find($request->id);
            if($thing==null)
                return ['status'=>400, 'message'=>'Device id does not exist!'];
        }
        else
        {
            $thing = new Thing;
            if(isset($request->lat))
            {
                $thing->lat = $request->lat;
                $thing->lng = $request->lng;    
                $thing->monitor_settings = 0;
                $area = $this->findAreaByPosition($user->id, $request->lat, $request->lng);
                if($area!=null)
                {
                    if($area->area_type=='green')
                        $thing->state = 'ok';
                    else $thing->state = 'medium';
                }
                else
                    $thing->state = 'critical';
            }
        }
            

        $thing->customer_id = $user->id;
        $thing->name = $request->info_edit_name;
        $thing->device_id = $request->info_edit_device_name;
        $thing->kind_id = $request->info_edit_kind;
        $thing->about = $request->info_edit_about;


		$image = "";
		if(isset($_FILES["device_pic"])) {
			$tmpPicName = $_FILES["device_pic"]["name"]; // The file name
			$tmpPic = $_FILES["device_pic"]["tmp_name"]; // File in the PHP tmp folder
			$picExt = pathinfo($tmpPicName, PATHINFO_EXTENSION);
			$tmpPicNewName = time().".".$picExt; 
            if ($tmpPic) { // if file not chosen                
                $filePath = 'uploads/thing-imgs/'.$tmpPicNewName;
				if(move_uploaded_file($tmpPic, $filePath)){
					$image = $filePath;
				}
            }            
        }
        $thing->image = $image;
        $thing->save();
        return ['status'=>200, 'message'=>'ok', 'data'=>$thing];
    }

    public function edit_device_1(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) {
            return ['status'=>401, 'message'=>'login error'];
        }

        $thing = Thing::find($request->id);
        if($thing == null)
            return ['status'=>400, 'message'=>'Device dose not exist exist!'];

        $thing->monitor_settings = $request->settings;
        $thing->temperature_range = $request->temp_range;
        $thing->save();

        $areaNotify = $request->area_notify;
        $areas = explode('_',$areaNotify);
        foreach($areas as $area)
        {
            $datas = explode('-',$area);
            if(count($datas) !=3) continue;
            $notify =  AreaNotify::where(['area_id'=>$datas[0], 'thing_id'=>$request->id])->first();
            if($notify==null)
            {
                $notify = new AreaNotify();
                $notify->customer_id = $user->id;
                $notify->thing_id = $request->id;
                $notify->area_id = $datas[0];
            }
            $notify->get_out = $datas[1];
            $notify->get_in = $datas[2];
            $notify->save();
        }

        return ['status'=>200, 'message'=>'ok'];
    }

    private function thing_area_notify($areas, $thingId)
    {
        $result = array();
        foreach($areas as $area)
        {
            $item = array();
            $item['area_id'] = $area->id;
            $item['area_name'] = $area->area_name;
            $row = AreaNotify::where(['area_id'=>$area->id, 'thing_id'=>$thingId])->first();
            if($row!=null)
            {
                $item['get_out'] = $row->get_out;
                $item['get_in'] = $row->get_in;
            }
            else
            {
                $item['get_out'] = 0;
                $item['get_in'] = 0;
            }
            $result[] = $item;            
        }
        return $result;
    }

    public function map_elements(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];

        $rows1 = Area::where(['customer_id'=>$user->id])->get();

        $devices = DeviceModel::all();
        $kinds = ThingKind::all();
        $things = array();
        $areas = array();

        $rows0 = Thing::where(['customer_id'=>$user->id])->get();
        foreach($rows0 as $thing)
        {
            $kind = $this->find_data($kinds, $thing->kind_id);
            if($kind==null) continue;

            $device = $this->find_data($devices, $thing->device_id);
            if($device==null) continue;

            $itm = array();
            $itm['id'] = $thing->id;
            $itm['name'] = $thing->name;
            $itm['device_id'] = $thing->device_id;
            $itm['device'] = $device->model_name;
            $itm['kind'] = $thing->kind_id;
            $itm['about'] = $thing->about;
            $itm['lat'] = $thing->lat;
            $itm['lng'] = $thing->lng;
            $itm['temperature_range'] = $thing->temperature_range;
            $itm['thumb'] = url($kind->thumb_image);
            $itm['marker_ok'] = url($kind->marker_image_ok);
            $itm['marker_medium'] = url($kind->marker_image_medium);
            $itm['marker_critical'] = url($kind->marker_image_critical);
            if($thing->image!="")
                $itm['image'] = url($thing->image);
            else
                $itm['image'] = '';
            $itm['settings'] = $thing->monitor_settings;
            $itm['state'] = $thing->state;
            $time = strtotime($thing->updated_at);

            $itm['updated'] = date('Y-m-d H:i:s',$time);
            $itm['area_notify'] = $this->thing_area_notify($rows1, $thing->id);
            $itm['new_notify'] = Notify::where(['customer_id'=>$user->id, 'thing_id'=>$thing->id, 'read'=>0])->count();
            $things[] = $itm;
            //unread notify count            
        }

        
        foreach($rows1 as $area)
        {
            $itm = array();
            $itm['id'] = $area->id;
            $itm['type'] = $area->area_type;
            $itm['region'] = json_decode($area->area_region);
            $areas[] = $itm;
        }
        return ['status'=>200, 'message'=>'ok', 'data'=>['things'=>$things,'areas'=>$areas]];
    }

    public function get_all_notifies(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];
        
        $rows = null;
            $rows = Notify::where(['customer_id'=>$user->id])
                ->orderByRaw('created_at DESC')->limit(40)->get();

        $result = array();
        foreach($rows as $row)
        {
            $thing = Thing::find($row->thing_id);
            $item = array();
            $item['id'] = $row->id;
            $item['thing_id'] = $row->thing_id;
            $item['message'] = $row->message;
            $item['type'] = $row->type;
            $item['read'] = $row->read;            

            $time = strtotime($row->created_at);
            $item['at'] = date('Y-m-d H:i:s',$time);

            $item['thing_name'] = '';
            if($thing!=null)
                $item['thing_name'] = $thing->name;
            $result[] = $item;
        }
        return ['status'=>200, 'message'=>'ok', 'data'=>$result];
    }

    public function get_new_notifies(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];
        
        $rows = null;
        if($request->thingId!='')
            $rows = Notify::where(['customer_id'=>$user->id, 'thing_id'=>$request->thingId, 'read'=>0])
                ->orderByRaw('created_at DESC')->get();            
        else
            $rows = Notify::where(['customer_id'=>$user->id, 'read'=>0])
                ->orderByRaw('created_at DESC')->get();

        $result = array();
        foreach($rows as $row)
        {
            $thing = Thing::find($row->thing_id);
            $item = array();
            $item['id'] = $row->id;
            $item['thing_id'] = $row->thing_id;
            $item['message'] = $row->message;
            $item['type'] = $row->type;

            $time = strtotime($row->created_at);
            $item['at'] = date('Y-m-d H:i:s',$time);

            $item['thing_name'] = '';
            if($thing!=null)
                $item['thing_name'] = $thing->name;
            $result[] = $item;
        }
        return ['status'=>200, 'message'=>'ok', 'data'=>$result];
    }

    public function set_read_notify(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];

        $entry = Notify::find($request->id);
        if($entry==null)
            return ['status'=>401, 'message'=>'missed id'];
        $entry->read = 1;
        $entry->save();       
        return ['status'=>200, 'message'=>'ok'];
    }

    public function set_read_all_notify(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];

        Notify::where(['customer_id'=>$user->id])->update(['read'=>1]);
        return ['status'=>200, 'message'=>'ok'];
    }    

    public function get_new_notify_count(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];

        $cnt = Notify::where(['customer_id'=>$user->id, 'read'=>0])->count();
        return ['status'=>200, 'message'=>'ok', 'data'=>$cnt];
    }


    private function get_area_notify_setting($thingId, $areaId)
    {
        $entry = AreaNotify::where(['thing_id'=>$thingId, 'area_id'=>$areaId])->first();
        return $entry;
    }

    private function sendNotifyViaSMS($user, $message)
    {
        if($user->notify_email >0)
        {
            mail($user->email,
            "localizator.mobi",
            $message,
            "From: localizator.mobi" . "\r\n" . "Content-Type: text/plain; charset=utf-8");    
        }

        if($user->notify_phone >0)
        {
        }
    }


    public function updateLocation(Request $request)
    {
        $email = $request->email;
        if($email=='')
            return ['status'=>400, 'message'=>'missing param email'];

        $thingName = $request->name;
        if($thingName=='')
            return ['status'=>400, 'message'=>'unknown thing'];
        $lat = $request->lat;
        $lng = $request->lng;
        if($lat == '' || $lng=='')
            return ['status'=>400, 'message'=>'missing param lat/lng'];
    

        $user = Customer::where(['email'=>$email])->first();
        if($user==null)
            return ['status'=>400, 'message'=>'unknown customer'];

        $thing = Thing::where(['customer_id'=>$user->id, 'name'=>$thingName])->first();
        if($thing==null)
            return ['status'=>400, 'message'=>'unknown thing'];

        //update thing's lat/lng, state
        $oldArea = $this->findAreaByPosition($user->id, $thing->lat, $thing->lng);
        $newArea = $this->findAreaByPosition($user->id, $lat, $lng);

        $oldTemperature = $thing->temperature;
        $thing->lat = $lat;
        $thing->lng = $lng;
        $thing->temperature = $request->temperature;

        if($newArea!=null)
        {
            if($newArea->type=='green')
                $thing->state='ok';
            else  $thing->state='medium';
        }
        else $thing->state='critical';
        $thing->save();

        //clear old track
        Track::where(['customer_id'=>$user->id, 'thing_id'=>$thing->id])
            ->where('created_at', '<', date('Y-m-d H:i:s',strtotime("-1 week")))->delete();

        //make new record in tack
        $newTrack = new Track; 
        $newTrack->customer_id=$user->id;
        $newTrack->thing_id = $thing->id;
        $newTrack->lat = $lat;
        $newTrack->lng = $lng;
        $newTrack->temperature = $request->temperature;       
        $newTrack->save();    

        $oldAreaId = '';
        if($oldArea!=null) $oldAreaId= $oldArea->id;
        $newAreaId = '';
        if($newArea!=null) $newAreaId= $newArea->id;


        //make notify
        if($oldAreaId != $newAreaId)
        {
            if($newArea==null)
            {
                $notifySetting = $this->get_area_notify_setting($thing->id, $oldArea->id);
                if($notifySetting!=null && $notifySetting->get_out > 0)
                {
                    $newNotify = new Notify;
                    $newNotify->customer_id = $user->id;
                    $newNotify->thing_id = $thing->id;        
                    $newNotify->type='critical';
                    $newNotify->message = "get out from ".$oldArea->area_name;
                    $newNotify->save();
                    $this->sendNotifyViaSMS($user, $thing->name.' '.$newNotify->message);
                }
            }
            else
            {
                $notifySetting = $this->get_area_notify_setting($thing->id, $newArea->id);
                if($notifySetting!=null && $notifySetting->get_in > 0)
                {
                    $newNotify = new Notify;
                    $newNotify->customer_id = $user->id;
                    $newNotify->thing_id = $thing->id;

                    if($newArea->type=='green')
                    {                    
                        $newNotify->type='critical';
                        $newNotify->message = "get in to ".$newArea->area_name;
                    }
                    else
                    {
                        $newNotify->type='warnning';
                        $newNotify->message = "get in to ".$newArea->area_name;
                    }
                    $newNotify->save();
                    $this->sendNotifyViaSMS($user, $thing->name.' '.$newNotify->message);    
                }
            }            
        }

        //make temp notify
        if($thing->temperature_range !='')
        {
            $temps = explode('~', $thing->temperature_range);
            if(count($temps) ==2)
            {
                $min = floatval($temps[0]);
                $max = floatval($temps[1]);
            }else{
                $min = floatval($temps[0]);
                $max = floatval($temps[0]);
            }
            if($oldTemperature >= $min && $oldTemperature <=$max )
            {
                if($thing->temperature < $min || $thing->temperature > $max)
                {
                    $newNotify = new Notify;
                    $newNotify->customer_id = $user->id;
                    $newNotify->thing_id = $thing->id;        
                    $newNotify->type='warnning';
                    $newNotify->message = "Temperature is out of range ".$thing->temperature." ºC";
                    $newNotify->save();
                    $this->sendNotifyViaSMS($user, $thing->name.' '.$newNotify->message);
                }
            }
            else if($oldTemperature < $min || $oldTemperature >$max )
            {
                if($thing->temperature >= $min && $thing->temperature <= $max)
                {
                    $newNotify = new Notify;
                    $newNotify->customer_id = $user->id;
                    $newNotify->thing_id = $thing->id;        
                    $newNotify->type='normal';
                    $newNotify->message = "Temperature backed to normal ".$thing->temperature." ºC";
                    $newNotify->save();
                    $this->sendNotifyViaSMS($user, $thing->name.' '.$newNotify->message);
                }
            }

        }


        return ['status'=>200, 'message'=>'ok', 'data'=>null];
    }


    public function get_thing_path(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];        
        
        $id = $request->id;
        $thing = Thing::find($id);
        if($thing==null)
            return ['status'=>400, 'message'=>'thing is invalid'];

        $tracks = Track::where(['customer_id'=>$user->id, 'thing_id'=>$id])
            ->where('created_at', '>=', date('Y-m-d H:i:s',strtotime("-1 day")))->get();

        $result = array();
        foreach($tracks as $track)
        {
            $result[] = [$track->lat, $track->lng];
        }
        $result[] = [$thing->lat, $thing->lng];        
        return ['status'=>200, 'message'=>'ok', 'data'=>$result];

    }

    public function get_thing_temperature(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];        
        
        $id = $request->id;
        $thing = Thing::find($id);
        if($thing==null)
            return ['status'=>400, 'message'=>'thing is invalid'];

        $cur = $thing->temperature;
        $tracks = Track::where(['customer_id'=>$user->id, 'thing_id'=>$id])
            ->where('created_at', '>=', date('Y-m-d H:i:s',strtotime("-1 week")))->get();


        $cnt = 0;
        $sum = 0;
        foreach($tracks as $track)
        {
            if($track->temperature=='') continue;
            $cnt++;
            $sum += $track->temperature;
        }
        $weekely = 0.0;
        if($cnt > 0)
            $weekely = $sum/$cnt;

        return ['status'=>200, 'message'=>'ok', 'data'=>['cur'=>number_format($cur, 2) , 'weekely'=>number_format($weekely,2)]];
    }


    public function get_thing_distance(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];        
        
        $id = $request->id;
        $thing = Thing::find($id);
        if($thing==null)
            return ['status'=>400, 'message'=>'thing is invalid'];

        $dayly = array();
        $tracks = Track::where(['customer_id'=>$user->id, 'thing_id'=>$id])
            ->where('created_at', '>=', date('Y-m-d H:i:s',strtotime("-1 day")))->get();
        foreach($tracks as $track)
        {
            $dayly[]=[$track->lat,$track->lng];
        }

        $weekely = array();
        $tracks = Track::where(['customer_id'=>$user->id, 'thing_id'=>$id])
            ->where('created_at', '>=', date('Y-m-d H:i:s',strtotime("-1 week")))->get();
        foreach($tracks as $track)
        {
            $weekely[]=[$track->lat,$track->lng];
        }
        return ['status'=>200, 'message'=>'ok', 'data'=>['daily'=>$dayly , 'weekely'=>$weekely]];
    }


    public function get_thing_location(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];        
        
        $id = $request->id;
        $thing = Thing::find($id);
        if($thing==null)
            return ['status'=>400, 'message'=>'thing is invalid'];

        $area = $this->findAreaByPosition($user->id, $thing->lat, $thing->lng);
        return ['status'=>200, 'message'=>'ok', 'data'=>$area];
    }    
    
    public function get_profile(Request $request)
    {
        $user = $this->loginCheck($request);
        if($user==null) 
            return ['status'=>401, 'message'=>'login error'];        
        return ['status'=>200, 'message'=>'ok', 'data'=>$user];
    }
}

