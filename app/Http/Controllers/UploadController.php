<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\Berkas;

class UploadController extends Controller
{
    //

    public function store(Request $request){

       
        if($request->hasFile('syarat')){
            $file= $request->file('syarat');
            $filename=$file->getClientOriginalName();
            $folder=uniqid().'-'.now()->timestamp;
            $file->storeAs('/public/berkas-pengajuan/tmp/'.$folder, $filename);

            TemporaryFile::create([
                'folder'=>$folder,
                'filename'=>$filename
            ]);
            return $folder;
        }
        /*try{
        $new_berkas = new \App\Models\Berkas;
        
        
        if($request->file('syarat')){
            $file = $request->file('syarat')->store('berkas-pengajuan', 'public');
           
            $new_berkas->link = $file;
            
        }
        $new_berkas->pengajuan_id='197bd0dc-6cb3-46f6-8a11-803aafea42a1';
        $new_berkas->syarat_id=$request->get('syarat_id');
        $new_berkas->created_by=\Auth::user()->id;

        $new_berkas->save();
    }catch (\Execption $e){
        dd($e);
    }
        return '';*/
    }
}
