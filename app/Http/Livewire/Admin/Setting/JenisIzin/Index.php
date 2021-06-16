<?php

namespace App\Http\Livewire\Admin\Setting\JenisIzin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Izin;
use App\Models\Syarat;
use Illuminate\Pagination\Paginator;

class Index extends Component
{
    use WithPagination;
    public $prompt;
    public $selectedItem;
    public $action,$izin,$syaratz=[];
    public $name_delete;
    public $search;
    public $currentPage = 1;

    protected $listeners=[
        'refreshParent',
        
    ];

    
    public function selectItem($itemId,$action)
    {
       
       $this->selectedItem=$itemId;
       if ($action == 'delete'){
            $izins=Izin::findOrFail($this->selectedItem);
           $this->name_delete=$izins->nama_izin;
           $this->dispatchBrowserEvent('openDeleteModal');

       }else{
        $this->emit('getModelId',$this->selectedItem);
        $this->dispatchBrowserEvent('openModalEdit'); 
       }
    }
    public function delete(){
        $this->syaratz=Syarat::where('izin_id',$this->selectedItem)->get();
       
        if(count($this->syaratz)>0){
            $this->alert('error', 'Yah!', [
                'position' =>  'top-center', 
                'timer' =>  3000,  
                'toast' =>  true, 
                'text' =>  'Data Izin ini memiliki '.count($this->syaratz).' Persyaratan, Silahkan Hapus terlebih dahulu persyaratannya', 
                'confirmButtonText' =>  'Ok', 
                'cancelButtonText' =>  'Close', 
                'showCancelButton' =>  true, 
                'showConfirmButton' =>  false, 
          ]);
        }else{
            try{
                $izins=Izin::findOrFail($this->selectedItem);
                $izins->delete();
                $this->dispatchBrowserEvent('closeDeleteModal');
                $this->alert('success', 'Hai!', [
                    'position' =>  'top-end', 
                    'timer' =>  3000,  
                    'toast' =>  true, 
                    'text' =>  'Jenis Izin '.$this->name_delete.' berhasil dihapus', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Close', 
                    'showCancelButton' =>  true, 
                    'showConfirmButton' =>  false, 
                    ]);
            } catch (\Exception $e) {
        
                $this->alert('error', 'Yah!', [
                    'position' =>  'top-end', 
                    'timer' =>  3000,  
                    'toast' =>  true, 
                    'text' =>  'Data Gagal dihapus', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Close', 
                    'showCancelButton' =>  true, 
                    'showConfirmButton' =>  false, 
              ]);
            }
        }
        
      
    }

    public function refreshParent(){

        $this->prompt="the parent has refresh";
    }
    public function render()
    {
        
        return view('livewire.admin.setting.jenis-izin.index', [
    		'izins'=>Izin::where(function($sub_query){
    			$sub_query->where('nama_izin', 'like', '%'.$this->search.'%');
    		})->paginate(10)
    	]);
       
    }


    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
    }
}

