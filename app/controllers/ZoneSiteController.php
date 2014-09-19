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
		$sites = Site::orderBy('id')->get();
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
		$zone_sites = $zone->Sites;
		$zone_relays = $zone->Relays;

		//add sites to zone
		foreach ($sites as $key => $value) {
			$selected_sites = Input::get('selected_sites_'.$value->id);
			if ($selected_sites) {
				$value->zone_id = $zone->id;
				$value->save();
			}else{
				// $value->zone_id = null;
				// $value->save();
			}			
		}
		$zone = Zone::find(Input::get('zone_id'));
		$zone_sites = $zone->Sites;
		$zone_relays = $zone->Relays;

		//create new zone relays if not present
		if (!$zone_relays->count()) {
			for ($i=0; $i < 6; $i++) { 
        		ZoneRelay::create(array('zone_id' => $zone->id, 'relay_id' => $i, 'status' => 'False'));
        	}
		}

		//for all sites of the zone
		$zone_sites = $zone->Sites;
		foreach ($zone_sites as $site) {
			
			//update site relays
			$zone_relays = $zone->Relays;
			foreach ($zone_relays as $relay) {

				$site_relays = $site->Relays;
								
				//create new site relays if not present
				if (!$site_relays->count()) {
					Relay::create(array('site_id' => $site->id, 'relay_id' => $relay->relay_id, 'status' => $relay->status));
				}
				$site_relay = Relay::where('site_id', '=', $site->id)->where('relay_id', '=', $relay->relay_id)->get()->first();
				$relay_status = $site_relay->status;
				//when zone relay is true
				if ($relay->status == 'True') {
					$site_relay->status = 'True';
					$site_relay->save();

					//log this change
					$entry = new Record;
					$entry->site_id = $site->id;
					$entry->site_name = $site->name;
					$entry->switch = $relay->relay_id;
					$entry->status = 'On';
					$entry->command = 1;
					$entry->admin_id = Auth::admin()->get()->id;
					$entry->save();					
				//when zone relay is false
				}else{
					$site_relay->status = 'False';
					$site_relay->save();

					//log this change
					$entry = new Record;
					$entry->site_id = $site->id;
					$entry->site_name = $site->name;
					$entry->switch = $relay->relay_id;
					$entry->status = 'Off';
					$entry->command = 0;
					$entry->save();
				}
			}			
		}

		$users = User::all();
		foreach ($users as $user) {
			if ($zone->GivesAccessToUser($user->rfid) == 'Granted') {
				DB::table('user_zone')->insert(
				    array('user_id' => $user->rfid, 'zone_id' => $zone->id)
				);
				foreach ($zone_sites as $zone_site) {
					DB::table('site_user')->insert(
					    array('user_id' => $user->rfid, 'site_id' => $zone_site->id)
					);
				}
			}else{
				DB::table('user_zone')->where('user_id', '=', $user->rfid)->where('zone_id', '=', $zone->id)->delete();
				foreach ($zone_sites as $zone_site) {
					DB::table('site_user')->where('user_id', '=', $user->rfid)->where('site_id', '=', $zone_site->id)->delete();
				}
			}
		}
		return Redirect::to('zoneSite/'.$zone->id);
	}

}
