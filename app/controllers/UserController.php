<?php

class UserController extends \BaseController {

	/**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter(function()
        {
            Auth::check();
        });
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$page = 'users';
		$users = User::all();
		return View::make('users.index')->with('page', $page)->with('users', $users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$page = 'users';
		return View::make('users.create')->with('page', $page);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;
		if (Input::get('has_access') != null) {
			$access = 1;
		}else{
			$access = 0;
		}
 		
        $user->f_name = Input::get('f_name');
        $user->l_name  = Input::get('l_name');
        $user->phone   = Input::get('phone');
        $user->address      = Input::get('address');
        $user->site_id   = Input::get('site_id');
        $user->rfid      = Input::get('rfid');
        $user->has_access   = $access;
 
        $user->save();
 
        return Redirect::to('/user');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($rfid)
	{
		$page = 'users';
		$user = User::find($rfid);
        return View::make('users.edit', [ 'user' => $user , 'page' => $page]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($rfid)
	{
		$user = User::find($rfid);
 		if (Input::get('has_access') != null) {
			$access = 1;
		}else{
			$access = 0;
		}
        $user->f_name = Input::get('f_name');
        $user->l_name  = Input::get('l_name');
        $user->phone   = Input::get('phone');
        $user->address      = Input::get('address');
        $user->site_id   = Input::get('site_id');
        $user->rfid      = Input::get('rfid');
        $user->has_access   = $access;
 
        $user->save();
 
        return Redirect::to('/user');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
