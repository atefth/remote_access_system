<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	/**
     * Instantiate a new HomeController instance.
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

	public function getIndex()
	{
		$page = 'home';
		return View::make('home')->with('page', $page);
	}

	public function syncServer($id)
	{
		$site = Site::find($id);
		$relay_status = '>>>';
    	for ($i=0; $i < 6; $i++) { 
    		$relay = Relay::withSiteAndRelay($id, $i)->get()->first();
    		if ($relay) {
    			if ($relay->status == 'True') {
    				$relay_status = $relay_status . 1 . '>>>';
    			}else{
    				$relay_status = $relay_status . 0 . '>>>';
    			}
    		}else{
    			$relay_status = $relay_status . 0 . '>>>';
    		}
    	}
    	$users = '>>>';
    	$site_users = $site->Users;
    	$count = 0;
    	if ($site_users->count()) {
    		foreach ($site_users as $site_user) {
	    		if ($site_user) {
	    			$users = $users . $site_user->rfid . '>>>!' . PHP_EOL;
	    			$count++;
	    		}
	    	}
    	}

    	for ($i=$count; $i < 10; $i++) { 
    		$users = $users . '0000000' . '#' . '>>>!' . PHP_EOL;
    		$users = $users . '>>>';
    	}
		$response = $relay_status . PHP_EOL . $users;
		return $response;
	}

    public function remoteToOrigin($site_id, $relay_id, $status, $rfid, $access, $day, $month, $year, $hour, $min, $sec)
    {
        $timestamp =  mktime($hour, $min, $sec, $month, $day, $year);
        $site = Site::find($site_id);

        $site_relay = Relay::withSiteAndRelay($site_id, $relay_id)->get()->first();
        // dd($site_relay);
        if ($access) {
            if ($status) {
                $site_relay->status = 'True';
                $site_relay->save();
                $entry = new Record;
                $entry->site_id = $site_id;
                $entry->site_name = $site->name;
                $entry->switch = $relay_id;
                $entry->user_id = $rfid;
                $entry->status = 'On';
                $entry->command = 1;
                $entry->created_at = $timestamp;
                $entry->save();
            }else{
                $site_relay->status = 'False';
                $site_relay->save();
                $entry = new Record;
                $entry->site_id = $site_id;
                $entry->site_name = $site->name;
                $entry->switch = $relay_id;
                $entry->user_id = $rfid;
                $entry->status = 'Off';
                $entry->command = 0;
                $entry->created_at = $timestamp;
                $entry->save();
            }
        }else{
            $entry = new Record;
            $entry->site_id = $site_id;
            $entry->site_name = $site->name;
            $entry->switch = $relay_id;
            $entry->user_id = $rfid;
            $entry->status = 'DENIED';
            $entry->command = 0;
            $entry->created_at = $timestamp;
            $entry->save();
    }
        return '#';
    }
    public function closeDoor($id)
    {
        $site = Site::find($id);
        $door = Relay::withSiteAndRelay($id, 0)->get()->first();
        $door->status = 'False';
        $door->save();

        $entry = new Record;
        $entry->site_id = $id;
        $entry->site_name = $site->name;
        $entry->switch = 0;
        $entry->status = 'Off';
        $entry->command = 0;
        $entry->save();

        return '#';
    }
}
