<?php

namespace App\Http\Livewire\Pendaftaran\Pengajuan;

use Livewire\Component;
use Livewire\WithFileUploads;

class AddBerkas extends Component
{
    use WithFileUploads;
    public $iteration;
    public $modelId,$modelIdPengajuan,$syarat_name,$link;


   

    protected $listeners=[
        'getModelId',
        'forcedCloseModal',
    ];

    public function forcedCloseModal(){
        $this->clean();
        $this->resetErrorBag();
        $this->resetValidation();
        
    }

    public function uploadBerkas(): void{
        $this->validate([
            'link' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
            
        ]);
            try{
                
               
                $old = \App\Models\Berkas::find($this->modelId);
                
                if($this->link != $old->link){
                   
                    
                    if($old->link && file_exists(storage_path('app/public/' . $old->link))){
                        \Storage::delete('public/'.$old->link);
                    }
                    $file = $this->link->store('berkas-pengajuan', 'public');
                    $old->link = $file;
                }
                $old->updated_by=\Auth::user()->id;
                $old->save();
                $this->emit('refreshParent');
                $this->iteration++;
                $this->dispatchBrowserEvent('closeModalUpload');
                $this->alert('success', 'Hai!', [
                    'position' =>  'top-end', 
                    'timer' =>  3000,  
                    'toast' =>  true, 
                    'text' =>  'Persyaratan berhasil diupload', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Close', 
                    'showCancelButton' =>  true, 
                    'showConfirmButton' =>  false, 
              ]);
              $this->emit('syaratAdded');  
                }catch(\Exception $e){
                    dd($e);
                    $this->emit('syaratAdded');  
                }
            
    }
    public function getModelId($modelId,$modelIdPengajuan){
        
        $this->modelId=$modelId;
        $this->modelIdPengajuan=$modelIdPengajuan; 
       

    
    }

    public function clean(){
        $this->link='';
       
    }

    public function render()
    {
       
        return view('livewire.pendaftaran.pengajuan.add-berkas');
    }
}
