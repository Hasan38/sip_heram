<?php

namespace App\Http\Livewire\Admin\Setting\JenisIzin;

use Livewire\Component;

class Edit extends Component
{
    public $nama_izin,$waktu_pelayanan,$biaya,$produk_pelayanan;
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
        $model=\App\Models\Izin::findOrFail($this->modelId);
        $this->nama_izin=$model->nama_izin;
        $this->waktu_pelayanan = $model->waktu_pelayanan;
        $this->biaya = $model->biaya;
        $this->produk_pelayanan = $model->produk_pelayanan;
       
        
    }
    
    public function Save(){
    
      if($this->modelId){
       try{
        $this->validate([
                
            'nama_izin' => 'required', // 1MB Max
            'waktu_pelayanan' => 'required',
            'biaya' => 'required',
            'produk_pelayanan' => 'required',
            
        ]);
            $new = \App\Models\Izin::findOrFail($this->modelId);
            $new->nama_izin=$this->nama_izin;
            $new->updated_by=\Auth::user()->id;
            $new->waktu_pelayanan=$this->waktu_pelayanan;
            $new->biaya=$this->biaya;
            $new->produk_pelayanan=$this->produk_pelayanan;
           
            
            $new->save();
          
      
    
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalEdit');

        $this->alert('success', 'Hai!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  'Data Izin '.$this->nama_izin.' berhasil diubah', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Close', 
            'showCancelButton' =>  true, 
            'showConfirmButton' =>  false, 
      ]);

        $this->clean();
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

        $this->clean();
        $this->iteration++;

       
    }


    private function clean(){
        $this->nama_izin=null;
        $this->waktu_pelayanan=null;
        $this->biaya=null;
        $this->produk_pelayanan=null;
       
    }
    
    public function render()
    {
        return view('livewire.admin.setting.jenis-izin.edit');
    }
}
