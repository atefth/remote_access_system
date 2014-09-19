<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent {

	protected $fillable = array('f_name', 'l_name', 'phone', 'address', 'rfid');
	protected $table = 'users';
	protected $primaryKey = 'rfid';

	// public static function has_access($rfid){
 //    	$user = User::find($rfid);
 //    	if ($user) {
 //            if ($user->has_access == 'granted') {
 //                return 1;
 //            }else{
 //                return 0;
 //            }
 //        }else{
 //            return 0;
 //        }
 //    }

    public function Zones()
    {
        return $this->belongsToMany('User', 'user_zone');
    }

    public function Sites()
    {
        return $this->belongsToMany('Site', 'site_user');
    }

    public function Records()
    {
        return $this->belongsTo('Record', 'user_id');
    }

}
