<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Customer;
use App\ThingKind;
use App\DeviceModel;

class AdminController extends Controller
{

    public function customers(Request $request)
    {
        $data = array();
        $rows = Customer::all();
        foreach($rows as $customer)
        {
            $row = array();
            $row[] = $customer->name;
            $row[] = $customer->surname;
            $row[] = $customer->email;
            $row[] = $customer->phone;
            $row[] = $customer->map_type;
            $row[] = $customer->created_at;
            $row[] = $customer->updated_at;

			$strAction = '<a href="javascript:void(0)" class="on-default edit-row" ' .
				'onclick="onEdit(' . $customer->id . ')" title="Edit" ><i class="fa fa-pencil"></i></a>' .
				'<a href="javascript:void(0)" class="on-default remove-row" ' .
				'onclick="onDelete(' . $customer->id . ')" title="Remove" ><i class="fa fa-trash-o"></i></a>';
			$row[] = $strAction;            
            $data[] = $row;
        }                
        return [
            'draw' => null,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data
        ];
    }

    public function edit_customer(Request $request)
    {
        $customer = Customer::where(['email'=>$request->email])->first();
        if($customer != null && $request->id!=$customer->id)
            return ['status'=>400, 'message'=>'Email already exist!'];

        if($request->id!=null && $request->id !="")
        {
            $customer = Customer::find($request->id);
            if($customer==null)
                return ['status'=>400, 'message'=>'Customer id des not exist!'];
        }
        else
            $customer = new Customer;

        $customer->name = $request->name;
        $customer->surname = $request->surname;
        $customer->email = $request->email;
        if($request->id =="")
            $customer->password = password_hash($request->password, PASSWORD_DEFAULT);

        $customer->phone = $request->phone;
        $customer->save();

        return ['status'=>200, 'message'=>'ok', 'data'=>$customer];
    }

    public function del_customer(Request $request)
    {
        $customer = Customer::find($request->id);
        if($customer == null)
            return ['status'=>400, 'message'=>'Customer id does not exist!'];
        $customer->delete();
        return ['status'=>200, 'message'=>'ok', 'data'=>null];
    }

    public function get_customer(Request $request)
    {
        $customer = Customer::find($request->id);
        if($customer == null)
            return ['status'=>400, 'message'=>'Customer id does not exist!'];
        return ['status'=>200, 'message'=>'ok', 'data'=>$customer];
    }


    public function devicemodels(Request $request)
    {
        $data = array();
        $rows = DeviceModel::all();
        foreach($rows as $device)
        {
            $row = array();
            $row[] = $device->model_name;
            $row[] = $device->brand;
            $row[] = $device->kind;

			$strAction = '<a href="javascript:void(0)" class="on-default edit-row" ' .
				'onclick="onEdit(' . $device->id . ')" title="Edit" ><i class="fa fa-pencil"></i><span> </span></a>' .
				'<a href="javascript:void(0)" class="on-default remove-row" ' .
				'onclick="onDelete(' . $device->id . ')" title="Remove" ><i class="fa fa-trash-o text-danger"></i></a>';
			$row[] = $strAction;            
            $data[] = $row;
        }                
        return [
            'draw' => null,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data
        ];
    }

    public function edit_devicemodel(Request $request)
    {
        $device = DeviceModel::where(['model_name'=>$request->name])->first();
        if($device != null && $request->id!=$device->id)
            return ['status'=>400, 'message'=>'Model already exist!'];

        if($request->id!=null && $request->id !="")
        {
            $device = DeviceModel::find($request->id);
            if($device==null)
                return ['status'=>400, 'message'=>'Model id des not exist!'];
        }
        else
            $device = new DeviceModel;

        $device->model_name = $request->name;
        $device->brand = $request->brand;
        $device->kind = $request->kind;
        $device->save();

        return ['status'=>200, 'message'=>'ok', 'data'=>$device];
    }

    public function del_devicemodel(Request $request)
    {
        $device = DeviceModel::find($request->id);
        if($device == null)
            return ['status'=>400, 'message'=>'Model id does not exist!'];
        $device->delete();
        return ['status'=>200, 'message'=>'ok', 'data'=>null];
    }

    public function get_devicemodel(Request $request)
    {
        $device = DeviceModel::find($request->id);
        if($device == null)
            return ['status'=>400, 'message'=>'Model id does not exist!'];
        return ['status'=>200, 'message'=>'ok', 'data'=>$device];
    }



    public function thingkinds(Request $request)
    {
        $data = array();
        $rows = ThingKind::all();
        foreach($rows as $kind)
        {
            $row = array();
            $row[] = $kind->kind_name;
            $row[] = $kind->descr;
            $row[] = '<img class="thumb-sm" src="'.url('').'/'.$kind->thumb_image.'" >';
            $row[] = $kind->created_at;
            $row[] = $kind->updated_at;

			$strAction = '<a href="javascript:void(0)" class="on-default edit-row" ' .
				'onclick="onEdit(' . $kind->id . ')" title="Edit" ><i class="fa fa-pencil"></i></a>' .
				'<a href="javascript:void(0)" class="on-default remove-row" ' .
				'onclick="onDelete(' . $kind->id . ')" title="Remove" ><i class="fa fa-trash-o"></i></a>';
			$row[] = $strAction;
            $data[] = $row;
        }                
        return [
            'draw' => null,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data
        ];
    }

    public function edit_thingkind(Request $request)
    {
        $kind = ThingKind::where(['kind_name'=>$request->name])->first();
        if($kind != null && $request->id!=$kind->id)
            return ['status'=>400, 'message'=>'Kind already exist!'];

        if($request->id!=null && $request->id !="")
        {
            $kind = ThingKind::find($request->id);
            if($kind==null)
                return ['status'=>400, 'message'=>'Kind id does not exist!'];
        }
        else        
            $kind = new ThingKind;


		$kind_pic = "";
		if(isset($_FILES["kind_pic"])) {
			$tmpPicName = $_FILES["kind_pic"]["name"]; // The file name
			$tmpPic = $_FILES["kind_pic"]["tmp_name"]; // File in the PHP tmp folder
			$picExt = pathinfo($tmpPicName, PATHINFO_EXTENSION);
			$tmpPicNewName = time()."1.".$picExt; 
            if ($tmpPic) { // if file not chosen                
                $filePath = 'uploads/kind-imgs/'.$tmpPicNewName;
				if(move_uploaded_file($tmpPic, $filePath)){
					$kind_pic = $filePath;
				}
            }            
        }

		$marker_ok_pic = "";
		if(isset($_FILES["marker_ok"])) {
			$tmpPicName = $_FILES["marker_ok"]["name"]; // The file name
			$tmpPic = $_FILES["marker_ok"]["tmp_name"]; // File in the PHP tmp folder
			$picExt = pathinfo($tmpPicName, PATHINFO_EXTENSION);
			$tmpPicNewName = time()."2.".$picExt; 
            if ($tmpPic) { // if file not chosen                
                $filePath = 'uploads/kind-imgs/'.$tmpPicNewName;
				if(move_uploaded_file($tmpPic, $filePath)){
					$marker_ok_pic = $filePath;
				}
            }            
        }
		$marker_medium_pic = "";
		if(isset($_FILES["marker_medium"])) {
			$tmpPicName = $_FILES["marker_medium"]["name"]; // The file name
			$tmpPic = $_FILES["marker_medium"]["tmp_name"]; // File in the PHP tmp folder
			$picExt = pathinfo($tmpPicName, PATHINFO_EXTENSION);
			$tmpPicNewName = time()."3.".$picExt; 
            if ($tmpPic) { // if file not chosen                
                $filePath = 'uploads/kind-imgs/'.$tmpPicNewName;
				if(move_uploaded_file($tmpPic, $filePath)){
					$marker_medium_pic = $filePath;
				}
            }            
        }
		$marker_critical_pic = "";
		if(isset($_FILES["marker_critical"])) {
			$tmpPicName = $_FILES["marker_critical"]["name"]; // The file name
			$tmpPic = $_FILES["marker_critical"]["tmp_name"]; // File in the PHP tmp folder
			$picExt = pathinfo($tmpPicName, PATHINFO_EXTENSION);
			$tmpPicNewName = time()."4.".$picExt;
            if ($tmpPic) { // if file not chosen                
                $filePath = 'uploads/kind-imgs/'.$tmpPicNewName;
				if(move_uploaded_file($tmpPic, $filePath)){
					$marker_critical_pic = $filePath;
				}
            }
        }


        $kind->kind_name = $request->name;
        $kind->descr = $request->descr;
        if($kind_pic!="")
        {
            if($kind->thumb_image!="" && file_exists($kind->thumb_image))
                unlink($kind->thumb_image);
            $kind->thumb_image = $kind_pic;
        }

        if($marker_ok_pic!="")
        {
            if($kind->marker_image_ok!="" && file_exists($kind->marker_image_ok))
                unlink($kind->marker_image_ok);
            $kind->marker_image_ok = $marker_ok_pic;
        }
        if($marker_medium_pic!="")
        {
            if($kind->marker_image_medium!="" && file_exists($kind->marker_image_medium))
                unlink($kind->marker_image_medium);
            $kind->marker_image_medium = $marker_medium_pic;
        }
        if($marker_critical_pic!="")
        {
            if($kind->marker_image_critical!="" && file_exists($kind->marker_image_critical))
                unlink($kind->marker_image_critical);
            $kind->marker_image_critical = $marker_critical_pic;
        }

        $kind->save();

        return redirect('/admin/thingkinds');
    }

    public function del_thingkind(Request $request)
    {
        $kind = ThingKind::find($request->id);
        if($kind == null)
            return ['status'=>400, 'message'=>'Kind id does not exist!'];

        if($kind->thumb_image!="" && file_exists($kind->thumb_image))
            unlink($kind->thumb_image);
            
        $kind->delete();
        return ['status'=>200, 'message'=>'ok', 'data'=>null];
    }

    public function get_thingkind(Request $request)
    {
        $kind = ThingKind::find($request->id);
        if($kind == null)
            return ['status'=>400, 'message'=>'Kind id does not exist!'];

        return ['status'=>200, 'message'=>'ok', 'data'=>$kind];
    }    
}

