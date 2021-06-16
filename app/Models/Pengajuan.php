<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Pengajuan extends Model
{
    use HasFactory, Uuids;
    protected $guarded = [];

  public function berkas(){
		return $this->hasMany('App\Models\Berkas','pengajuan_id');
	}
  public function izins(){
		return $this->belongsTo('App\Models\Izin','izin_id');
	}
  
  public function pemohons(){
		return $this->belongsTo('App\Models\Pemohon','pemohon_id');
	}

	public function sum_not_null() {
        return $this->berkas()->where('link','!=', null)->get();
    }
}
