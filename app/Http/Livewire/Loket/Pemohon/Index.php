<?php

namespace App\Http\Livewire\Loket\Pemohon;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pemohon;
use App\Models\Kelurahan;
use Illuminate\Pagination\Paginator;

class Index extends Component
{
    use WithPagination;
    public $prompt,$avatar;
    public $selectedItem,$sum=[];
    public $action;
    protected $pemohons=[];
    public $name_delete,$kelurahan_id;
    public $search;
    public $currentPage = 1;
    public $readyToLoad = false;
    public $readyToSum = false;


    protected $listeners=[
        'refreshParent',
        'loadPosts',
        'loadSums'
        
    ];


   
    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    public function loadSums()
    {
        $this->readyToSum = true;
    }
    
    
    public function selectItem($itemId,$action)
    {
       
       $this->selectedItem=$itemId;
       switch ($action){
            case 'delete':
                $pemohon=Pemohon::findOrFail($this->selectedItem);
                $this->name_delete=$pemohon->name;
                $this->dispatchBrowserEvent('openDeleteModal');
                break;
            case 'edit':
                $this->emit('getModelId',$this->selectedItem);
                $this->dispatchBrowserEvent('openModalEdit'); 
                break;
            case 'upload':
                $this->emit('getModelId',$this->selectedItem);
                $this->dispatchBrowserEvent('openModalUpload'); 
                break;
       }
       
    }
    public function delete(){
        try{
        $pemohon=Pemohon::findOrFail($this->selectedItem);
        $pemohon->delete();
        $this->dispatchBrowserEvent('closeDeleteModal');
        $this->alert('success', 'Hai!', [
        'position' =>  'top-end', 
        'timer' =>  3000,  
        'toast' =>  true, 
        'text' =>  'Permohon a.n '.$this->name_delete.' berhasil dihapus', 
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
        

       
        if($this->kelurahan_id){
          
            $this->pemohons=$this->readyToLoad ?  Pemohon::where(function($sub_query){
                $sub_query->where('kelurahan_id', '=', $this->kelurahan_id);
                $sub_query->where('nik', 'like', '%'.$this->search.'%');
            })->paginate(10)
            : [];
        }else{
       
            $this->pemohons=$this->readyToLoad ?  Pemohon::where(function($sub_query){
                $sub_query->where('nik', 'like', '%'.$this->search.'%');
            })->paginate(10)
            : [];
        }
       
        $this->sum=$this->readyToSum ?  \App\Models\Kelurahan::with('pemohons')
        ->get() : [];
      
        return view('livewire.loket.pemohon.index', [
    		'pemohons'=>$this->pemohons,'kelurahans'=>Kelurahan::get()
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
