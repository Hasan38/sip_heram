<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Izin extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    
    public function syarats(){
		return $this->hasMany('App\Models\Syarat','izin_id');
	}
  public function pengajuans(){
		return $this->hasMany('App\Models\Pengajuan','izin_id');
	}
    
}
