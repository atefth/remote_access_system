<?php

class ZoneController extends \BaseController {

	/**
     * Instantiate a new ZoneController instance.
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
		$zones = Zone::orderBy('id')->get();
		$status = array();
		foreach ($zones as $zone_count => $zone) {
			$count = $zone_count + 1;			
			$switch_relays = $zone->Relays;
			if ($switch_relays->count()) {
				foreach ($switch_relays as $relay) {
					$status['zone_' . $count . '_status_' . $relay->relay_id] = $relay->status;
				}
			}else{
				for ($i=0; $i < 6; $i++) { 
					$status['zone_' . $count . '_status_' . $i] = 'False';					
				}
			}
		}
		$data = array(
			'page' => 'zones',
			'zones' => $zones,
			'status' => $status
			);
		return View::make('zones.index', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array(
			'page' => 'zones'
			);
		return View::make('zones.create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$zone = new Zone;
		$zone->name = Input::get('name');
		$zone->save();

		return Redirect::to('zone');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$zone = Zone::find($id);
		$switch_relays = $zone->Relays;
		$status = array();
		if ($switch_relays->count()) {
			foreach ($switch_relays as $key => $value) {
				if ($value->status == 'True') {
					$status[$value->relay_id] = 1;
				}else{
					$status[$value->relay_id] = 0;
				}
			}
		}else{
			for ($i=0; $i < 6; $i++) { 
				$status[$i] = 0;
			}
		}
		$data = array(
			'zone' => Zone::find($id),
			'page' => 'zones',
			'status' => $status,
			'tab' => 'zones'
			);
		return View::make('zones.show', $data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array(
			'zone' => Zone::find($id),
			'page' => 'zones'
			);
		return View::make('zones.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$zone = Zone::find($id);
		$zone->name = Input::get('name');
		$zone->save();

		return Redirect::to('zone');
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

	public function onCommand($zone_id, $relay_id)
    {
        $zone = Zone::find($zone_id);
        $zone_sites = $zone->Sites;
        $zone_relays = $zone->Relays;
        if (!$zone_relays->count()) {
        	for ($i=0; $i < 6; $i++) { 
        		ZoneRelay::create(array('zone_id' => $zone_id, 'relay_id' => $i, 'status' => 'False'));
        	}
        }
    	$zone_relay = ZoneRelay::withZoneAndRelay($zone_id, $relay_id)->get()->first();
    	$relay = ZoneRelay::find($zone_relay->id);
    	$relay->status = 'True';
    	$relay->save();

    	$entry = new ZoneRecord;
        $entry->zone_id = $zone->id;
        $entry->zone_name = $zone->name;
        $entry->switch = $relay->relay_id;
    	$entry->status = 'On';
    	$entry->command = 1;
        $entry->admin_id = Auth::admin()->get()->id;
    	$entry->save();

    	foreach ($zone_sites as $zone_site) {
    		$site_relays = $zone_site->Relays;
			if (!$site_relays->count()) {
				for ($i=0; $i < 6; $i++) { 
	        		Relay::create(array('site_id' => $zone_site->id, 'relay_id' => $i, 'status' => 'False'));
	        	}
			}
			$site_relay = Relay::withSiteAndRelay($zone_site->id, $zone_relay->relay_id)->get()->first();
			$relay = Relay::find($site_relay->id);
			$relay->status = 'True';
			$relay->save();

    		$entry = new Record;
	        $entry->site_id = $zone_site->id;
	        $entry->site_name = $zone_site->name;
	        $entry->switch = $relay->relay_id;
	    	$entry->status = 'On';
	    	$entry->command = 1;
	        $entry->admin_id = Auth::admin()->get()->id;
	    	$entry->save();
    	}

    	return Redirect::to('zone/'.$zone_id);
    }

    public function OffCommand($zone_id, $relay_id)
    {
        $zone = Zone::find($zone_id);
        $zone_sites = $zone->Sites;
        $zone_relays = $zone->Relays;
        if (!$zone_relays->count()) {
        	for ($i=0; $i < 6; $i++) { 
        		ZoneRelay::create(array('zone_id' => $zone_id, 'relay_id' => $i, 'status' => 'False'));
        	}        	
        }
    	$zone_relay = ZoneRelay::withZoneAndRelay($zone_id, $relay_id)->get()->first();
    	$relay = ZoneRelay::find($zone_relay->id);
    	$relay->status = 'False';
    	$relay->save();

    	$entry = new ZoneRecord;
        $entry->zone_id = $zone->id;
        $entry->zone_name = $zone->name;
        $entry->switch = $relay->relay_id;
    	$entry->status = 'Off';
    	$entry->command = 0;
        $entry->admin_id = Auth::admin()->get()->id;
    	$entry->save();

    	foreach ($zone_sites as $zone_site) {
    		$site_relays = $zone_site->Relays;
			if (!$site_relays->count()) {
				for ($i=0; $i < 6; $i++) { 
	        		Relay::create(array('site_id' => $zone_site->id, 'relay_id' => $i, 'status' => 'False'));
	        	}						
			}
			$site_relay = Relay::withSiteAndRelay($zone_site->id, $zone_relay->relay_id)->get()->first();
			$relay = Relay::find($site_relay->id);
			$relay->status = 'False';
			$relay->save();

    		$entry = new Record;
	        $entry->site_id = $zone_site->id;
	        $entry->site_name = $zone_site->name;
	        $entry->switch = $relay->relay_id;
	    	$entry->status = 'Off';
	    	$entry->command = 0;
	        $entry->admin_id = Auth::admin()->get()->id;
	    	$entry->save();
    	}

    	return Redirect::to('zone/'.$zone_id);
    }

}
