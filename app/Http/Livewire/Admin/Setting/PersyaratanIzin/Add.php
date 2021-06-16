<?php

namespace App\Http\Livewire\Admin\Setting\PersyaratanIzin;

use Livewire\Component;

use App\Models\Izin;
use App\Models\Syarat;


class Add extends Component
{
    public $nama_syarat,$izin_id;
    
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
                
            'nama_syarat' => 'required',
            'izin_id' => 'required',
            
        ]);
        try{

           
        
            $new = new \App\Models\Syarat;
            $new->izin_id=$this->izin_id;
            $new->nama_syarat=$this->nama_syarat;
            $new->created_by=\Auth::user()->id;
            
            $new->save();
    
            $this->emit('refreshParent');
            $this->dispatchBrowserEvent('closeModalAdd');
            $this->alert('success', 'Hai!', [
                'position' =>  'top-end', 
                'timer' =>  3000,  
                'toast' =>  true, 
                'text' =>  'Data Persyaratan '.$this->nama_syarat.' berhasil diinput', 
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
        $this->nama_syarat=null;
        $this->izin_id=null;
    }
    public function render()
    {
        return view('livewire.admin.setting.persyaratan-izin.add',['izins'=>Izin::get()]);
    }

}
