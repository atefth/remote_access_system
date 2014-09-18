<?php
class Site extends Eloquent {

	public function Zone()
	{
		return $this->belongsTo('Zone');
	}

	public function Users()
	{
		return $this->belongsToMany('User', 'site_user');
	}

	public function Relays()
	{
		return $this->hasMany('Relay');
	}

	public function GivesAccessToUser($rfid)
	{
		$users_with_access = DB::table('users')
        ->join('site_user', 'users.rfid', '=', 'site_user.user_id')        
        ->join('sites', 'sites.id', '=', 'site_user.site_id')
        ->where('site_user.site_id', '=', $this->id)
        ->get();
        foreach ($users_with_access as $key => $value) {
        	if ($value->rfid == $rfid) {
	        	return 'Granted';
	        }
        }
        return 'Denied';
	}

}