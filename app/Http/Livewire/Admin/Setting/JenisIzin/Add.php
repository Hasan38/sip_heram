<?php

namespace App\Http\Livewire\Admin\Setting\JenisIzin;

use Livewire\Component;
use App\Models\Izin;
use App\Models\TemporaryFile;

class Add extends Component
{
    public $nama_izin,$cover,$izin;
    public $temporaryFile,$waktu_pelayanan,$biaya,$produk_pelayanan;
    public $iteration;

    protected $listeners=[
        'forcedCloseModal',
        
    ];

    public function forcedCloseModal(){
        $this->clean();
        $this->resetErrorBag();
        $this->resetValidation();
        
    }
    public function Save(){

        $this->validate([
                
            'nama_izin' => 'required',
            'waktu_pelayanan' => 'required',
            'biaya' => 'required',
            'produk_pelayanan' => 'required',
            
        ]);
        try{

           
            $this->izin= Izin::create([
                'nama_izin'=>$this->nama_izin,
                'waktu_pelayanan'=>$this->waktu_pelayanan,
                'biaya'=>$this->biaya,
                'produk_pelayanan'=>$this->produk_pelayanan,
                'cover'=>"saat-ini-tidak-ada-file.png",
                'created_by'=>\Auth::user()->id
          
            ]);
        /*$this->temporaryFile=TemporaryFile::where('folder',$this->cover)->first();
        if($this->temporaryFile){
            
            $this->izin->addMedia(storage_path('app/public/cover-izin/tmp/'.$this->cover.'/'.$this->temporaryFile->filename))
            ->toMediaCollection('cover');
            rmdir(storage_path('app/public/cover-izin/tmp/'.$this->cover));
            $this->temporaryFile->delete();
        }else{
            dd($this->cover);
        }*/
       
        $this->emit('refreshParent');
            $this->dispatchBrowserEvent('closeModalAdd');
            $this->alert('success', 'Hai!', [
                'position' =>  'top-end', 
                'timer' =>  3000,  
                'toast' =>  true, 
                'text' =>  'Data Izin '.$this->nama_izin.' berhasil diinput', 
                'confirmButtonText' =>  'Ok', 
                'cancelButtonText' =>  'Close', 
                'showCancelButton' =>  true, 
                'showConfirmButton' =>  false, 
          ]);
    
            $this->clean();
            $this->iteration++;

            }catch (\Exception $e) {

                dd($e);
            }

    }

    public function clean(){
        $this->nama_izin=null;
        $this->waktu_pelayanan=null;
        $this->biaya=null;
        $this->produk_pelayanan=null;
    }

    
    public function render()
    {
        return view('livewire.admin.setting.jenis-izin.add');
    }
}
