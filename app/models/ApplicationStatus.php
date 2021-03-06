<?php

class ApplicationStatus extends \Eloquent {
	protected $fillable = [];


    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }

    public function scopeLastRecordBySAN($query,$san) {
        // return DB::table('students')->where('san','=',$san)->orderBy('id', 'desc')->first();
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
}