<?php
class Relay extends Eloquent {

	public function Site()
	{
		return $this->belongsTo('Site', 'site_id');
	}

	public function Status()
	{
		return $this->status;
	}

}