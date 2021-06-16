<?php

namespace App\Http\Livewire\Pendaftaran\Pemohon;

use Livewire\Component;

class Edit extends Component
{
    public $name,$phone,
    $nik,
    $email,
    $jk,
    $tgl_lahir,
    $kelurahan_id,
    $address,$avatar;
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
        $model=\App\Models\Pemohon::findOrFail($this->modelId);
        $this->name=$model->name;
        $this->phone=$model->phone;
        $this->nik=$model->nik;
        $this->email=$model->email;
        $this->jk=$model->jk;
        $this->tgl_lahir=$model->tgl_lahir;
        $this->kelurahan_id=$model->kelurahan_id;
        $this->address=$model->address;
       
       
        
    }
    
    public function Save(){
    
      if($this->modelId){
       try{
        $this->validate([
                
            'name' => 'required',
            'phone' => 'required',
            'jk' => 'required',
            'tgl_lahir' => 'required',
            'kelurahan_id' => 'required',
            'address' => 'required'
            
        ]);
            $new = \App\Models\Pemohon::findOrFail($this->modelId);
            $new->name=$this->name;
            $new->phone=$this->phone;
            $new->nik=$this->nik;
            $new->email=$this->email;
            $new->jk=$this->jk;
            $new->tgl_lahir=$this->tgl_lahir;
            $new->kelurahan_id=$this->kelurahan_id;
            $new->address=$this->address;
            
            $new->save();
          
      
    
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalEdit');

        $this->alert('success', 'Hai!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  'Data Pemohon'.$this->name.' berhasil diubah', 
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
        return view('livewire.pendaftaran.pemohon.edit',['kelurahans'=>\App\Models\Kelurahan::get()]);
    }
}
