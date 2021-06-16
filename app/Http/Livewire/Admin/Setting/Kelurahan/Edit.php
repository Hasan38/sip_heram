<?php

namespace App\Http\Livewire\Admin\Setting\Kelurahan;

use Livewire\Component;

class Edit extends Component
{
    public $nama_kelurahan;
    public $iteration;
    public $selectedItem;
    public $modelId;
  

  

    protected $listeners=[
        'getModelId',
        'forcedCloseModal'
    ];

    public function forcedCloseModal(){
 
        $this->resetErrorBag();
        $this->resetValidation();
        
    }
    
    public function getModelId($modelId){
        $this->modelId=$modelId;
        $model=\App\Models\Kelurahan::findOrFail($this->modelId);
        $this->nama_kelurahan=$model->nama_kelurahan;
       
        
    }
    
    public function Save(){
    
      if($this->modelId){
       try{
        $this->validate([
                
            'nama_kelurahan' => 'required', // 1MB Max
            
        ]);
            $new = \App\Models\Kelurahan::findOrFail($this->modelId);
            $new->nama_kelurahan=$this->nama_kelurahan;
            $new->updated_by=\Auth::user()->id;
           
            
            $new->save();
          
      
    
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalEdit');

        $this->alert('success', 'Hai!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  'Data Kelurahan '.$this->nama_kelurahan.' berhasil diubah', 
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
        return view('livewire.admin.setting.kelurahan.edit');
    }
}
