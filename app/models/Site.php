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
		$users_with_access = DB::statement('select * from "users" inner join "site_user" on "users"."rfid" = "site_user"."user_id" inner join "sites" on "sites"."id" = "site_user"."site_id" where "site_user"."site_id" = '.$this->id.')');
        foreach ($users_with_access as $key => $value) {
        	if ($value->rfid == $rfid) {
	        	return 'Granted';
	        }
        }
        return 'Denied';
	}

}