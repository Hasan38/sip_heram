<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Berkas extends Model
{
    use HasFactory, Uuids;
    protected $guarded = [];

    public function pengajuans(){
		return $this->belongsTo('App\Models\Pengajuan','pengajuan_id');
	}

    public function syarats(){
		return $this->belongsTo('App\Models\Syarat','syarat_id');
	}
}
