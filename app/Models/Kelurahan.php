<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;


    public function pemohons(){
		return $this->hasMany('App\Models\Pemohon','kelurahan_id');
	}
}
