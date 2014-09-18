<?php
class Zone extends Eloquent {

	public function Sites()
	{
		return $this->hasMany('Site');
	}

	public function Users()
	{
		return $this->belongsToMany('User', 'user_zone');
	}

	public function Relays()
	{
		return $this->hasMany('ZoneRelay');
	}

	public function GivesAccessToUser($rfid)
	{
		$users_with_access = DB::statement('select * from "users" inner join "user_zone" on "users"."rfid" = "user_zone"."user_id" inner join "zones" on "zones"."id" = "user_zone"."zone_id" where "user_zone"."zone_id" = '.$this->id.')');
        foreach ($users_with_access as $key => $value) {
        	if ($value->rfid == $rfid) {
	        	return 'Granted';
	        }
        }
        return 'Denied';
	}

	public function ContainsSite($id)
	{
		$sites = $this->Sites;
		foreach ($sites as $site) {
			if ($site->id == $id) {
				return true;
			}
		}
		return false;
	}

}