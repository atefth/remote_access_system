<?php

class ZoneSiteController extends \BaseController {

	/**
     * Instantiate a new ZoneSiteController instance.
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
		$sites = Site::all();
		$data = array(
			'page' => 'zones',
			'tab' => 'manage',
			'zone' => $zone,
			'sites' => $sites
			);
		return View::make('zone_site.index', $data);
	}

	public function update()
	{
		$zone = Zone::find(Input::get('zone_id'));
		$sites = Site::all();
		foreach ($sites as $key => $value) {
			$selected_sites = Input::get('selected_sites_'.$value->id);
			if ($selected_sites) {
				$value->zone_id = $zone->id;
				$value->save();

				$users = User::all();
				foreach ($users as $user) {
					if ($zone->GivesAccessToUser($user->rfid)) {
						DB::table('site_user')->insert(
						    array('user_id' => $user->rfid, 'site_id' => $value->id)
						);
					}else{
						DB::table('site_user')->where('user_id', '=', $user->rfid)->where('site_id', '=', $value->id)->delete();
					}
				}
			}else{
				$value->zone_id = null;
				$value->save();
			}
			
		}
		return Redirect::to('zoneSite/'.$zone->id);
	}

}
