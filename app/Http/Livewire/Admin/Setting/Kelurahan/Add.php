<?php

namespace App\Http\Livewire\Admin\Setting\Kelurahan;

use Livewire\Component;
use App\Models\Kelurahan;


class Add extends Component
{
    public $nama_kelurahan,$kelurahan;
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
                
            'nama_kelurahan' => 'required',
            
        ]);
        try{

           
            $this->kelurahan= new Kelurahan;
            $this->kelurahan->nama_kelurahan=$this->nama_kelurahan;
            $this->kelurahan->created_by= \Auth::user()->id;
            $this->kelurahan->save();
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
                'text' =>  'Data Kelurahan '.$this->nama_kelurahan.' berhasil diinput', 
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
        $this->nama_kelurahan=null;
    }

    public function render()
    {
        return view('livewire.admin.setting.kelurahan.add');
    }
}
