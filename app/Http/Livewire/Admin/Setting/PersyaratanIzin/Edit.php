<?php

namespace App\Http\Livewire\Admin\Setting\PersyaratanIzin;

use Livewire\Component;

class Edit extends Component
{
    public $nama_syarat,$izin_id;
    public $iteration;
    public $selectedItem;
    public $modelId;
  
  
  

    protected $listeners=[
        'getModelId',
        'forcedCloseModal',
    ];

    

    public function forcedCloseModal(){
    
        $this->resetErrorBag();
        $this->resetValidation();
        
    }
    
    public function getModelId($modelId){
        $this->modelId=$modelId;
        $model=\App\Models\Syarat::findOrFail($this->modelId);
        $this->nama_syarat=$model->nama_syarat;
        $this->izin_id=$model->izin_id;
       
        
    }
    
    public function Save(){
    
      if($this->modelId){
       try{
        $this->validate([
                
            'nama_syarat' => 'required', // 1MB Max
            'izin_id' => 'required',
            
        ]);
            $new = \App\Models\Syarat::findOrFail($this->modelId);
            $new->nama_syarat=$this->nama_syarat;
            $new->izin_id=$this->izin_id;
            $new->updated_by=\Auth::user()->id;
           
            
            $new->save();
          
      
    
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalEdit');

        $this->alert('success', 'Hai!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  'Data Persyaratan '.$this->nama_syarat.' berhasil diubah', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Close', 
            'showCancelButton' =>  true, 
            'showConfirmButton' =>  false, 
      ]);

    
        $this->iteration++;
       }catch(\Exexption $e){
        $this->alert('error', 'Yah!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  'Data Gagal diubah', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Close', 
            'showCancelButton' =>  true, 
            'showConfirmButton' =>  false, 
      ]);
       }
    
      }
       
        
          

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalEdit');

      
        $this->iteration++;

       
    }


    

    public function render()
    {
        return view('livewire.admin.setting.persyaratan-izin.edit',['izins'=>\App\Models\Izin::get()]);
    }
}
