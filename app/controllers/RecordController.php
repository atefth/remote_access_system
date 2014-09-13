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
        $entry->rfid = 'nil';
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
        $entry->rfid = 'nil';
    	$entry->save();
    	return Redirect::to('/control');
    }

    public function getCommand($id){
        return '>>>'. Record::command($id);
    }

    public function getAll(){
        $switches = '>>>'. Record::command(1) . '>>>'. Record::command(2) . '>>>'. Record::command(3) . '>>>'. Record::command(4) . '>>>'. Record::command(5) . '>>>'. Record::command(6);
        return $switches;
    }

    public function confirmCommand(){
        $page = 'home';
        return View::make('confirmation')->with('page', $page);
    }

    public function uploadLog($site_id, $switch, $status, $rfid, $created_at){
        $page = 'log';
        $entry = new Record;
        $entry->site_id = $site_id;
        $entry->site_name = 'test';
        $entry->switch = $switch;
        if ($status) {
            $status_string = 'on';
            $command = 1;
        }else{
            $status_string = 'off';
            $command = 0;
        }
        $entry->status = $status_string;
        $entry->command = $command;
        $entry->rfid = $rfid;
        $entry->created_at = $created_at;
        $entry->save();
        $records = Record::all();
    }

    public function verifyRFID($id){
        return '>>>' . User::has_access($id);
    }

    public function deleteDestroy()
    {
		
    }

}
