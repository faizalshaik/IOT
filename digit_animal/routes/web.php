<?php

use App\Admin;
use App\Customer;
use App\ThingKind;
use Illuminate\Http\Request;
use App\DeviceModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
function generateToken($id)
{
    return md5($id. rand(1, 10) . microtime());
}


Route::get('/', function () {
    return view('user.login');
});

Route::get('/user/logout', function (Request $request) {

    $request->session()->remove('user_id');
    $request->session()->remove('admin_id');
    return redirect('/');
});

Route::post('/user/auth', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required|max:255',
        'password' => 'required|max:255',
    ]);

    if (!$validator->fails()) 
    {
        $user = Customer::where('email',$request->email)->first();
        if($user!=null)
        {
            if(password_verify($request->password, $user->password))
            {
                $request->session()->put('user_id', $user->id);
                $user->remember_token = generateToken($user->id);
                $request->session()->put('token', $user->remember_token);
                $user->save();

                return redirect('/user/home');
            }
        }
    }

    return redirect('/')
        ->withInput()
        ->withErrors($validator);
});

Route::get('/user/home', function (Request $request) {

    if (!$request->session()->exists('user_id')) {
        return redirect('/');
    }
    
    $user = Customer::find($request->session()->get('user_id'));
    //fill data
    $data['devicemodels'] = DeviceModel::all();
    $data['thingkinds'] = ThingKind::all();
    $data['token'] = $request->session()->get('token');
    $data['user'] = $user;
    
    return view('user.home', $data);
});



Route::get('/admin', function (Request $request) {

    if ($request->session()->exists('admin_id')) {
        return redirect('/admin/dashboard');
    }
    return view('admin.login');
});

Route::get('/admin/logout', function (Request $request) {

    $request->session()->remove('admin_id');
    return redirect('/admin');
});



Route::post('/admin/auth', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required|max:255',
        'password' => 'required|max:255',
    ]);

    // $npass = password_hash($request->password, PASSWORD_DEFAULT);
    // $user = new Admin;
    // $user->email = $request->email;
    // $user->password = $npass;
    // $user->save();

    if (!$validator->fails()) 
    {
        $user = Admin::where('email',$request->email)->first();
        if($user!=null)
        {
            if(password_verify($request->password, $user->password))
            {
                $request->session()->put('admin_id', $user->id);
                return redirect('/admin/dashboard');
            }
        }
    }

    return redirect('/admin')
        ->withInput()
        ->withErrors($validator);
});

Route::get('/admin/dashboard', function (Request $request) 
{
    if ($request->session()->exists('admin_id')) {
        return view('admin.dashboard');
    }

    return redirect('/admin');
});

Route::get('/admin/customers', function (Request $request) {
    if ($request->session()->exists('admin_id')) {
        return view('admin.customers');
    }    
    return redirect('/admin');
});


Route::get('/admin/thingkinds', function (Request $request) {
    if ($request->session()->exists('admin_id')) {
        return view('admin.thingkinds');
    }
    return redirect('/admin');
});

Route::get('/admin/devicemodels', function (Request $request) {
    if ($request->session()->exists('admin_id')) {
        return view('admin.devicemodel');
    }
    return redirect('/admin');
});

