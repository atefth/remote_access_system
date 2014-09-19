<?php

class ZoneController extends \BaseController {

	/**
     * Instantiate a new ZoneController instance.
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
	public function index()
	{
		$data = array(
			'page' => 'zones',
			'zones' => Zone::all()
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
		$switch_status = $zone->Relays;
		$status = array();
		if ($switch_status->count()) {
			foreach ($switch_status as $key => $value) {
				$status[$key] = $value->Status;
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


}
