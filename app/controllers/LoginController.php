<?php

class LoginController extends \BaseController {

	public function getIndex()
	{
		$page = '';
		return View::make('login')->with('page', $page);
	}

	public function postIndex()
	{
		$userdata = array(
			'username' 	=> Input::get('username'),
			'password' 	=> Input::get('password')
		);
		if (Auth::admin()->attempt($userdata))
		{	
			Auth::admin()->login(Auth::admin()->get(), true);
		    return Redirect::action('HomeController@getIndex');
		}else{
			return Redirect::to('/');
		}
	}

	public function postLogin()
	{
		$userdata = array(
			'f_name' => Input::get('username'),
			'rfid' => Input::get('rfid')
			);
		$users = User::all();
		foreach ($users as $key => $user) {
			if ($userdata['f_name'] == $user->f_name && $userdata['rfid'] == $user->rfid) {
				return 'success';
			}
		}
		return 'failed';
	}

	public function getLogout()
	{
		Auth::admin()->logout();
        return Redirect::to('/');
	}

}
