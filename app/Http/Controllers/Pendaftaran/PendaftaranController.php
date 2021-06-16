<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    //

    public function Pemohon(){
        return view('pendaftaran.pemohon');
    }

    public function Pengajuan(){
        return view('pendaftaran.pengajuan');
    }

    public function ListPengajuan(){
        return view('pendaftaran.list-pengajuan');
    }

    public function edit($pengajuan_id){

        $data=\App\Models\Pengajuan::find($pengajuan_id);

        if($data){
            return view('pendaftaran.edit-pengajuan',['pengajuan_id'=>$pengajuan_id]);
        }else{
            return view('pendaftaran.list-pengajuan');
        }
        
        
    }
}
