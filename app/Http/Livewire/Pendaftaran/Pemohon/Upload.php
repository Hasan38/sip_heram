<?php

namespace App\Http\Livewire\Pendaftaran\Pemohon;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Pemohon;

class Upload extends Component
{
    use WithPagination;
    public $iteration;
    public $modelId,$m=[];
    public $id_pemohon;



    protected $listeners=[
        'getModelId'
    ];

    

   
    
    public function getModelId($modelId){
        
        $this->modelId=$modelId;     
        $this->m=Pemohon::findOrFail($this->modelId);
        $this->id_pemohon=$this->m->id;
        
        
    
    }
    

    public function render()
    {
        
        return view('livewire.pendaftaran.pemohon.upload',['models'=>$this->m]);
    }

    
}
