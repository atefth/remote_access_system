<?php
class ZoneRelay extends Eloquent {

	public function Zone()
	{
		return $this->belongsTo('Zone', 'zone_id');
	}

	public function Status()
	{
		return $this->status;
	}

}