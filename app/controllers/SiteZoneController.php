<?php

class SiteZoneController extends \BaseController {

	/**
     * Instantiate a new SiteZoneController instance.
     */
    public function __construct()
    {
        $this->beforeFilter(function()
        {
            if (!Auth::check();) {
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
		$zones = Zone::all();
		$data = array(
			'page' => 'sites',
			'tab' => 'manage',
			'site' => $site,
			'zones' => $zones
			);
		return View::make('site_zone.index', $data);
	}

	public function update()
	{
		$site = Site::find(Input::get('site_id'));
		$selected_zone = Input::get('selected_zone');
		if ($selected_zone) {
			$site->zone_id = $selected_zone;
			$site->save();
		}
		return Redirect::to('siteZone/'.$site->id);
	}

}
