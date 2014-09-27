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
    		$users = $users . '000000000' . '#' . '>>>!' . PHP_EOL;
    		$users = $users . '>>>';
    	}
		$response = $relay_status . PHP_EOL . $users;
		return $response;
	}

}
