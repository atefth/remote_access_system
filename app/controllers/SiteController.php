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
		$data = array(
			'page' => 'sites',
			'sites' => Site::all()
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
		$switch_status = $site->Relays;
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


}
