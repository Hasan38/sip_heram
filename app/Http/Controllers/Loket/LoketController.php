<?php

namespace App\Http\Controllers\Loket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoketController extends Controller
{
    //
    public function Pemohon(){
        return view('loket.pemohon');
    }

    public function ListPengajuan(){
        return view('loket.list-pengajuan');
    }
}
