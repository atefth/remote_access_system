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

Route::get('/', function()
{
	$page = 'home';
	return View::make('home')->with('page', $page);
});

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

Route::get('seed', function ()
{
	$tom = new User;
	$tom->site_id =  'test1234';
	$tom->rfid = '123456789';
	$tom->has_access = 'granted';
	$tom->save();

	$jerry = new User;
	$jerry->site_id =  'test1234';
	$jerry->rfid = '987654321';
	$jerry->has_access = 'denied';
	$jerry->save();
});

Route::get('turnOnSwitch/{id}', array('as' => 'switch', 'uses' => 'RecordController@OnCommand'));

Route::get('turnOffSwitch/{id}', array('as' => 'switch', 'uses' => 'RecordController@OffCommand'));

Route::get('getCommand/{id}', array('as' => 'switch', 'uses' => 'RecordController@getCommand'));

Route::get('verifyRFID/{id}', array('as' => 'site', 'uses' => 'RecordController@verifyRFID'));

Route::get('confirmCommand/', array('as' => 'switch', 'uses' => 'RecordController@confirmCommand'));

Route::get('uploadLog/{site_id}/{switch}/{status}/{rfid}/{created_at}/', array('as' => 'log', 'uses' => 'RecordController@uploadLog'));

Route::controller('records', 'RecordController');
