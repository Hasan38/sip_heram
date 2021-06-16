<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Izin;

class SettingController extends Controller
{
    //

    
    public function User(){
        return view('admin.setting.user');
      
    }

    public function JenisIzin(){
        return view('admin.setting.jenis-izin');
    }
    public function PersyaratanIzin(){
        $izin=Izin::get();
        if(count($izin)>0){
            return view('admin.setting.persyaratan-izin');
        }else{
            return view('admin.setting.jenis-izin');
        }
       
    }

    public function Kelurahan(){

        return view('admin.setting.kelurahan');
    }
    
}
