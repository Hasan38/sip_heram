<?php

namespace App\Http\Livewire\Admin\Setting\PersyaratanIzin;

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
    public $action;
    protected $syarat=[];
    public $name_delete,$izin_id;
    public $search;
    public $currentPage = 1;
    public $readyToLoad = false;


    protected $listeners=[
        'refreshParent',
        'loadPosts'
        
    ];


   
    public function loadPosts()
    {
        $this->readyToLoad = true;
    }
    
    public function selectItem($itemId,$action)
    {
       
       $this->selectedItem=$itemId;
       if ($action == 'delete'){
            $syarats=Syarat::findOrFail($this->selectedItem);
           $this->name_delete=$syarats->nama_syarat;
           $this->dispatchBrowserEvent('openDeleteModal');

       }else{
        $this->emit('getModelId',$this->selectedItem);
        $this->dispatchBrowserEvent('openModalEdit'); 
       }
    }
    public function delete(){
        try{
        $syarats=Syarat::findOrFail($this->selectedItem);
        $syarats->delete();
       $this->dispatchBrowserEvent('closeDeleteModal');
       $this->alert('success', 'Hai!', [
        'position' =>  'top-end', 
        'timer' =>  3000,  
        'toast' =>  true, 
        'text' =>  'Persyaratan '.$this->name_delete.' berhasil dihapus', 
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

    public function refreshParent(){

        $this->prompt="the parent has refresh";
    }
    public function render()
    {
        if($this->izin_id){
          
            $this->syarat=$this->readyToLoad ?  Syarat::where(function($sub_query){
                $sub_query->where('izin_id', '=', $this->izin_id);
                $sub_query->where('nama_syarat', 'like', '%'.$this->search.'%');
            })->paginate(10)
            : [];
        }else{
       
        $this->syarat=$this->readyToLoad ?  Syarat::where(function($sub_query){
                $sub_query->where('nama_syarat', 'like', '%'.$this->search.'%');
            })->paginate(10)
            : [];
        }
       
       
        return view('livewire.admin.setting.persyaratan-izin.index', [
    		'syarat'=>$this->syarat,'izins'=>Izin::get()
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
    

