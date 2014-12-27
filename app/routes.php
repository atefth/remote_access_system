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
Route::get('logout', 'LoginController@getLogout');
Route::post('login', 'LoginController@postLogin');
Route::post('/', 'LoginController@postIndex');
// Route::controller('login', 'LoginController');

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

// Route::get(
// 	'/image/{file}',
// 	'ImageController@getImage'
// );

// Route::get(
//     '/image/{size}/{file}',
//     'ImageController@getImage'
// );

Route::get('getAll/{site_id}', 'SiteController@getAllCommands');
Route::get('syncServer/{site_id}', 'HomeController@syncServer');
Route::get('remoteToOrigin/{site_id}/{relay_id}/{status}/{rfid}/{access}/{day}/{month}/{year}/{hour}/{min}/{sec}', 'HomeController@remoteToOrigin');
Route::get('closeDoor/{site_id}', 'HomeController@closeDoor');

Route::get('sites', 'HomeController@sites');
Route::get('sites/{rfid}', 'HomeController@sitesForUser');
Route::get('users', 'HomeController@users');
Route::get('zones', 'HomeController@zones');
Route::get('zones/{rfid}', 'HomeController@zonesForUser');
Route::get('relays/{site_id}', 'HomeController@relays');
Route::get('updateSiteRelay/{site_id}/{relay_id}/{status}', 'SiteController@updateSiteRelay');

Route::filter('auth', function()
{
	if (Auth::admin()->guest()) return Redirect::guest('/');
});

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

	Route::resource('user', 'UserController');
	Route::post('user/updatePermissions', 'UserController@updatePermissions');
	
	Route::resource('admin', 'AdminController');

	Route::resource('zone', 'ZoneController');
	Route::get('zone/onCommand/{zone_id}/{relay_id}', 'ZoneController@onCommand');
	Route::get('zone/offCommand/{zone_id}/{relay_id}', 'ZoneController@offCommand');

	Route::resource('site', 'SiteController');
	Route::get('site', array('as' => 'sites', 'uses' => 'SiteController@index'));
	Route::get('site/onCommand/{site_id}/{relay_id}', 'SiteController@onCommand');
	Route::get('site/offCommand/{site_id}/{relay_id}', 'SiteController@offCommand');	

	Route::controller('records', 'RecordController');

	Route::controller('home', 'HomeController');	

	Route::get('combo/', array('as' => 'report', 'uses' => 'ReportController@getCombo'));

	Route::get('pie/', array('as' => 'report', 'uses' => 'ReportController@getPie'));
});