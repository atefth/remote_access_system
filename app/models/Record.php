<?php
class Record extends Eloquent {
	protected $fillable = array('site_id', 'site_name', 'switch', 'status', 'isIdle', 'command');
	protected $table = 'records';

	public static function status($id){
    	if (Record::all()->count()) {
            $query =  DB::select( DB::raw("SELECT DISTINCT *
                                            FROM records
                                            WHERE switch = '" .$id. "'
                                            AND updated_at IN(
                                            SELECT MAX(updated_at) 
                                            FROM records 
                                            GROUP BY id
                                            )ORDER BY updated_at DESC;"));
            if ($query != null) {
                $record = $query[0];
                if ($record->status == 'on') {
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public static function command($id){
        if (Record::all()->count()) {
            $query =  DB::select( DB::raw("SELECT DISTINCT *
                                            FROM records
                                            WHERE switch = '" .$id. "'
                                            AND updated_at IN(
                                            SELECT MAX(updated_at) 
                                            FROM records 
                                            GROUP BY id
                                            )ORDER BY updated_at DESC;"));
            if ($query != null) {
                $record = $query[0];                
                return $record->command;                
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function getDayAttribute()
    {
        return $this->updated_at->format('d.m.Y');
    }
}