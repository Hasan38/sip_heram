<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Syarat extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function izins(){

		return $this->belongsTo('App\Models\Izin','izin_id');
    
	  }

    public function berkas(){

      return $this->hasMany('App\Models\Berkas','syarat_id');
      
      }
}
