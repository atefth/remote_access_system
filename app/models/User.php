<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent {

	protected $fillable = array('site_id', 'rfid', 'has_access');
	protected $table = 'users';
	protected $primaryKey = 'rfid';

	public static function has_access($rfid){
    	$user = User::find($rfid);
    	if ($user->has_access == 'granted') {
    		return 1;
    	}else{
    		return 0;
    	}
    }

}
