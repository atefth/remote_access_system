<?php

class SiteUserController extends \BaseController {

	/**
     * Instantiate a new SiteUserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter(function()
        {
            if (!Auth::check()) {
            	return Redirect::to('/');
            }
        });
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$site = Site::find($id);
		$users = User::all();
		$data = array(
			'page' => 'sites',
			'tab' => 'access',
			'site' => $site,
			'users' => $users
			);
		return View::make('site_user.index', $data);
	}

	public function update()
	{
		$site = Site::find(Input::get('site_id'));
		$users = User::all();
		foreach ($users as $key => $value) {
			$user_access = Input::get('user_access_'.$value->rfid);
			if ($user_access) {
				if ($site->GivesAccessToUser($value->rfid) == 'Denied') {
					DB::table('site_user')->insert(
					    array('user_id' => $value->rfid, 'site_id' => $site->id)
					);
				}else{
					DB::table('site_user')->where('user_id', '=', $value->rfid)->where('site_id', '=', $site->id)->delete();
				}
			}
		}
		return Redirect::to('siteUser/'.$site->id);
	}

}
