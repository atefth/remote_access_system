<?php

class UserController extends \BaseController {

	/**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter(function()
        {
            if (!Auth::admin()) {
            	return Redirect::to('/');
            }
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
 		
        $user->f_name  = Input::get('f_name');
        $user->l_name  = Input::get('l_name');
        $user->phone   = Input::get('phone');
        $user->address = Input::get('address');
        $user->rfid    = Input::get('rfid');
 
        $user->save();
 
        return Redirect::to('user');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$sites = Site::all();
		$zones = Zone::all();
		$user = User::find($id);
		$data = array(
			'page' => 'users',
			'sites' => $sites,
			'user' => $user,
			'zones' => $zones
			);
		return View::make('users.show', $data);
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
        $user->f_name = Input::get('f_name');
        $user->l_name  = Input::get('l_name');
        $user->phone   = Input::get('phone');
        $user->address      = Input::get('address');
        $user->rfid      = Input::get('rfid');
 
        $user->save();
 
        return Redirect::to('user');
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

	public function updatePermissions()
	{
		$user = User::find(Input::get('rfid'));
		$sites = Site::all();
		foreach ($sites as $key => $value) {
			$selected_site = Input::get('selected_site_'.$value->id);
			if ($selected_site) {
				$site = Site::find($selected_site);
				if ($site->GivesAccessTosite($user->rfid) == 'Denied') {
					DB::table('site_user')->insert(
					    array('site_id' => $value->id, 'user_id' => $user->rfid)
					);
				}else{
					DB::table('site_user')->where('user_id', '=', $user->rfid)->where('site_id', '=', $value->id)->delete();
				}
			}
		}
		$zones = Zone::all();
		foreach ($zones as $key => $value) {
			$selected_zone = Input::get('selected_zone_'.$value->id);
			if ($selected_zone) {
				if ($value->GivesAccessToUser($user->rfid) == 'Denied') {
					DB::table('user_zone')->insert(
					    array('zone_id' => $value->id, 'user_id' => $user->rfid)
					);
					foreach ($sites as $site) {
						if ($value->ContainsSite($site->id)) {
							DB::table('site_user')->insert(
							    array('site_id' => $site->id, 'user_id' => $user->rfid)
							);
						}
					}
				}else{
					DB::table('user_zone')->where('user_id', '=', $user->rfid)->where('zone_id', '=', $value->id)->delete();
					foreach ($sites as $site) {
						if ($value->ContainsSite($site->id)) {
							DB::table('site_user')->where('user_id', '=', $user->rfid)->where('site_id', '=', $site->id)->delete();
						}
					}
				}				
			}
		}
		return Redirect::to('user/'.$user->id);
	}


}
