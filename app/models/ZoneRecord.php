<?php
class ZoneRecord extends Eloquent {
	protected $fillable = array('zone_id', 'zone_name', 'switch', 'status', 'command', 'admin_id');
	protected $table = 'zone_records';

    public function Admin()
    {
        return $this->belongsTo('Admin');
    }
}