<?php

namespace App\Http\Livewire\Admin\Setting\Kelurahan;

use Livewire\Component;


use Livewire\WithPagination;
use App\Models\Kelurahan;
use Illuminate\Pagination\Paginator;

class Index extends Component
{
    use WithPagination;
    public $prompt;
    public $selectedItem;
    public $action,$izin;
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
            $izins=Kelurahan::findOrFail($this->selectedItem);
           $this->name_delete=$izins->nama_kelurahan;
           $this->dispatchBrowserEvent('openDeleteModal');

       }else{
        $this->emit('getModelId',$this->selectedItem);
        $this->dispatchBrowserEvent('openModalEdit'); 
       }
    }
    public function delete(){
        try{
        $izins=Kelurahan::findOrFail($this->selectedItem);
        $izins->delete();
       $this->dispatchBrowserEvent('closeDeleteModal');
       $this->alert('success', 'Hai!', [
        'position' =>  'top-end', 
        'timer' =>  3000,  
        'toast' =>  true, 
        'text' =>  'Kelurahan '.$this->name_delete.' berhasil dihapus', 
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
        
        return view('livewire.admin.setting.kelurahan.index', [
    		'kelurahans'=>Kelurahan::where(function($sub_query){
    			$sub_query->where('nama_kelurahan', 'like', '%'.$this->search.'%');
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
