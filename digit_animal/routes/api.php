<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('admin:api')->post('/customers', function (Request $request) {

//     return json_encode($request);
//     //return "1";
// });


Route::post('/admin/customers', 'AdminController@customers');
Route::post('/admin/edit_customer', 'AdminController@edit_customer');
Route::post('/admin/del_customer', 'AdminController@del_customer');
Route::post('/admin/get_customer', 'AdminController@get_customer');

Route::post('/admin/thingkinds', 'AdminController@thingkinds');
Route::post('/admin/edit_thingkind', 'AdminController@edit_thingkind');
Route::post('/admin/del_thingkind', 'AdminController@del_thingkind');
Route::post('/admin/get_thingkind', 'AdminController@get_thingkind');


Route::post('/admin/devicemodels', 'AdminController@devicemodels');
Route::post('/admin/edit_devicemodel', 'AdminController@edit_devicemodel');
Route::post('/admin/del_devicemodel', 'AdminController@del_devicemodel');
Route::post('/admin/get_devicemodel', 'AdminController@get_devicemodel');


Route::post('/user/get_profile', 'CustomerController@get_profile');
Route::post('/user/change_profile', 'CustomerController@change_profile');
Route::post('/user/change_password', 'CustomerController@change_password');
Route::post('/user/areas', 'CustomerController@areas');
Route::post('/user/edit_area', 'CustomerController@edit_area');
Route::post('/user/del_area', 'CustomerController@del_area');
Route::post('/user/get_area', 'CustomerController@get_area');
Route::post('/user/get_area_details', 'CustomerController@get_area_details');


Route::post('/user/map_elements', 'CustomerController@map_elements');
Route::post('/user/devices', 'CustomerController@devices');
Route::post('/user/del_device', 'CustomerController@del_device');
Route::post('/user/edit_device_0', 'CustomerController@edit_device_0');
Route::post('/user/edit_device_1', 'CustomerController@edit_device_1');

Route::post('/user/get_new_notifies', 'CustomerController@get_new_notifies');
Route::post('/user/get_all_notifies', 'CustomerController@get_all_notifies');

Route::post('/user/set_read_notify', 'CustomerController@set_read_notify');
Route::post('/user/set_read_all_notify', 'CustomerController@set_read_all_notify');
Route::post('/user/get_new_notify_count', 'CustomerController@get_new_notify_count');


Route::post('/updateLocation', 'CustomerController@updateLocation');
Route::post('/user/get_thing_path', 'CustomerController@get_thing_path');
Route::post('/user/get_thing_temperature', 'CustomerController@get_thing_temperature');
Route::post('/user/get_thing_distance', 'CustomerController@get_thing_distance');
Route::post('/user/get_thing_location', 'CustomerController@get_thing_location');


Route::post('/user/send_email', 'CustomerController@send_email');





