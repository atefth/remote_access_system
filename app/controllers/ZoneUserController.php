<?php

class ZoneUserController extends \BaseController {

	/**
     * Instantiate a new ZoneUserController instance.
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
	public function index($id)
	{
		$zone = Zone::find($id);
		$users = User::all();
		$data = array(
			'page' => 'zones',
			'tab' => 'access',
			'zone' => $zone,
			'users' => $users
			);
		return View::make('zone_user.index', $data);
	}

	public function update()
	{
		$zone = Zone::find(Input::get('zone_id'));
		$users = User::all();
		foreach ($users as $key => $value) {
			$user_access = Input::get('user_access_'.$value->rfid);
			if ($user_access) {
				$sites = $zone->Sites;
				if ($zone->GivesAccessToUser($value->rfid) == 'Denied') {
					DB::table('user_zone')->insert(
					    array('user_id' => $value->rfid, 'zone_id' => $zone->id)
					);					
					foreach ($sites as $site) {
						DB::table('site_user')->insert(
						    array('user_id' => $value->rfid, 'site_id' => $site->id)
						);
					}
				}else{
					DB::table('user_zone')->where('user_id', '=', $value->rfid)->where('zone_id', '=', $zone->id)->delete();
					foreach ($sites as $site) {
						DB::table('site_user')->where('user_id', '=', $value->rfid)->where('site_id', '=', $site->id)->delete();
					}					
				}
			}
		}
		return Redirect::to('zoneUser/'.$zone->id);
	}

}
