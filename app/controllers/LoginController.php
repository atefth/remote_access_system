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

	public function getLogout()
	{
		Auth::admin()->logout();
        return Redirect::to('/');
	}

}
