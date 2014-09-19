<?php
class ZoneRelay extends Eloquent {

	protected $fillable = array('zone_id', 'relay_id', 'status');
	protected $table = 'zone_relays';

	public function Zone()
	{
		return $this->belongsTo('Zone', 'zone_id');
	}

	public function Status()
	{
		return $this->status;
	}

	public function scopeWithZoneAndRelay($query, $zone_id, $relay_id)
	{
		return $query->whereZone_id($zone_id)->whereRelay_id($relay_id);
	}


}