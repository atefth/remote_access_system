<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'LoginController@getIndex');
// Route::post('login/attempt', 'LoginController@attempt');

Route::get('control', function()
{
	$page = 'control';
	$status = array();
	$status[0] = Record::status(1);
	$status[1] = Record::status(2);
	$status[2] = Record::status(3);
	$status[3] = Record::status(4);
	$status[4] = Record::status(5);
	$status[5] = Record::status(6);
	return View::make('control')->with('page', $page)->with('status', $status);
});

Route::get(
	'/image/{file}',
	'ImageController@getImage'
);

Route::get(
    '/image/{size}/{file}',
    'ImageController@getImage'
);

Route::group(array('before'=>'auth'),function()
{
	Route::get('siteZone/{site_id}', 'SiteZoneController@index');
	Route::post('siteZone/update', 'SiteZoneController@update');

	Route::get('siteUser/{site_id}', 'SiteUserController@index');
	Route::post('siteUser/update', 'SiteUserController@update');

	Route::get('zoneSite/{site_id}', 'ZoneSiteController@index');
	Route::post('zoneSite/update', 'ZoneSiteController@update');

	Route::get('zoneUser/{site_id}', 'ZoneUserController@index');
	Route::post('zoneUser/update', 'ZoneUserController@update');

	Route::post('user/updatePermissions', 'UserController@updatePermissions');

	Route::resource('user', 'UserController');

	Route::resource('admin', 'AdminController');

	Route::resource('zone', 'ZoneController');

	Route::resource('site', 'SiteController');

	Route::get('turnOnSwitch/{id}', array('as' => 'switch', 'uses' => 'RecordController@OnCommand'));

	Route::get('turnOffSwitch/{id}', array('as' => 'switch', 'uses' => 'RecordController@OffCommand'));

	Route::get('getCommand/{id}', array('as' => 'switch', 'uses' => 'RecordController@getCommand'));

	Route::get('getAll/', array('as' => 'switches', 'uses' => 'RecordController@getAll'));

	Route::get('verifyRFID/{id}', array('as' => 'site', 'uses' => 'RecordController@verifyRFID'));

	Route::get('confirmCommand/', array('as' => 'switch', 'uses' => 'RecordController@confirmCommand'));

	Route::get('uploadLog/{site_id}/{switch}/{status}/{rfid}/{created_at}/', array('as' => 'log', 'uses' => 'RecordController@uploadLog'));

	Route::controller('records', 'RecordController');

	Route::controller('home', 'HomeController');

	Route::controller('login', 'LoginController');

	Route::get('combo/', array('as' => 'report', 'uses' => 'ReportController@getCombo'));

	Route::get('pie/', array('as' => 'report', 'uses' => 'ReportController@getPie'));
});