<?php

class RecordController extends BaseController {

    public function __construct()
    {
        Config::set('session.driver', 'array');
    }

	public function getIndex()
    {
    	$page = 'log';
		$records = Record::all();
		return View::make('log')->with('page', $page)->with('records', $records);
    }

    public function OnCommand($id)
    {
        $entry = new Record;
        $entry->site_id = 'test1234';
        $entry->site_name = 'test';
        $entry->switch = $id;
    	$entry->status = 'on';
    	$entry->command = 1;
    	$entry->save();
    	return Redirect::to('/control');
    }

    public function OffCommand($id)
    {
        $entry = new Record;
        $entry->site_id = 'test1234';
        $entry->site_name = 'test';
        $entry->switch = $id;
    	$entry->status = 'off';
    	$entry->command = 0;
    	$entry->save();
    	return Redirect::to('/control');
    }

    public function getCommand($id){
        return Record::command($id);
    }

    public function confirmCommand(){
        $page = 'home';
        return View::make('confirmation')->with('page', $page);
    }

    public function deleteDestroy()
    {
		
    }

}
