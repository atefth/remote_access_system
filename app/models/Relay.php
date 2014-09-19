<?php
class Relay extends Eloquent {

	protected $fillable = array('site_id', 'relay_id', 'status');
	protected $table = 'relays';

	public function Site()
	{
		return $this->belongsTo('Site', 'site_id');
	}

	public function Status()
	{
		return $this->status;
	}

	public function scopeWithSiteAndRelay($query, $site_id, $relay_id)
	{
		return $query->whereSite_id($site_id)->whereRelay_id($relay_id);
	}

}