<?php

class SiteController extends \BaseController {

	/**
     * Instantiate a new SiteController instance.
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
		$sites = Site::all();
		$status = array();		

		foreach ($sites as $site) {
			$relays = $site->Relays;
			// foreach ($relays as $key => $value) {
			// 	var_dump($key . ' => ' . $value);
			// 	echo '</br>';
			// }
			
			if (!$relays->count()) {
				for ($i=0; $i < 6; $i++) {
					$status['site_' . $site->id . '_status_' . $i] = 'False';
				}
			}
			foreach ($relays as $relay) {
				// var_dump('Updating Relay ' . $relay . ' to ' . $relay->status);
				$status['site_' . $site->id . '_status_' . $relay->relay_id] = $relay->status;
			}
		}
		
		// die();
		$sites = Site::orderBy('id')->get();
		$data = array(
			'page' => 'sites',
			'sites' => $sites,
			'status' => $status
			);
		return View::make('sites.index', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array(
			'page' => 'sites'
			);
		return View::make('sites.create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$site = new Site;
		$site->name = Input::get('name');
		$site->save();

		return Redirect::to('site');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$site = Site::find($id);
		$switch_relays = $site->Relays;
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
			'site' => $site,
			'page' => 'sites',
			'status' => $status,
			'tab' => 'sites'
			);
		return View::make('sites.show', $data);
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
			'site' => Site::find($id),
			'page' => 'sites'
			);
		return View::make('sites.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$site = Site::find($id);
		$site->name = Input::get('name');
		$site->save();

		return Redirect::to('site');
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

    public function onCommand($site_id, $relay_id)
    {
        $site = Site::find($site_id);
        $site_relays = $site->Relays;
        if (!$site_relays->count()) {
        	for ($i=0; $i < 6; $i++) { 
        		Relay::create(array('site_id' => $site_id, 'relay_id' => $i, 'status' => 'False'));
        	}
        }
    	$site_relay = Relay::withSiteAndRelay($site_id, $relay_id)->get()->first();
    	$relay = Relay::find($site_relay->id);
    	$relay->status = 'True';
    	$relay->save();

    	$entry = new Record;
        $entry->site_id = $site_id;
        $entry->site_name = $site->name;
        $entry->switch = $relay->relay_id;
    	$entry->status = 'On';
    	$entry->command = 1;
        $entry->rfid = 'nil';
    	$entry->save();

    	return Redirect::to('site/'.$site_id);
    }

    public function OffCommand($site_id, $relay_id)
    {
        $site = Site::find($site_id);
        $site_relays = $site->Relays;
        if (!$site_relays->count()) {
        	for ($i=0; $i < 6; $i++) { 
        		Relay::create(array('site_id' => $site_id, 'relay_id' => $i, 'status' => 'False'));
        	}        	
        }
    	$site_relay = Relay::withSiteAndRelay($site_id, $relay_id)->get()->first();
    	$relay = Relay::find($site_relay->id);
    	$relay->status = 'False';
    	$relay->save();

    	$entry = new Record;
        $entry->site_id = $site_id;
        $entry->site_name = $site->name;
        $entry->switch = $relay->relay_id;
    	$entry->status = 'Off';
    	$entry->command = 0;
        $entry->rfid = 'nil';
    	$entry->save();
    	return Redirect::to('site/'.$site_id);
    }


}
