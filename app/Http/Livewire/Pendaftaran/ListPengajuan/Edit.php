<?php

namespace App\Http\Livewire\Pendaftaran\ListPengajuan;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class Edit extends Component
{
    use WithPagination;
    public $pengajuan_id,$prompt,$pengajuans=[];
    public $recents;
    public $selectedItem,$selectedItemPengajuan,$syarat_name;
    public $readyToLoad = false;


    protected $listeners=[
        'refreshParent',
        'loadPosts'
       
        
    ];

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    public function mount($pengajuan_id){
            $this->pengajuan_id = $pengajuan_id; 
    }

    public function selectItem($itemId,$itemIdPengajuan,$action)
    {
       
       $this->selectedItem=$itemId;
       $this->selectedItemPengajuan=$itemIdPengajuan;
       switch ($action){
            
            case 'upload':
                $this->emit('getModelId',$this->selectedItem,$this->selectedItemPengajuan);
                $this->dispatchBrowserEvent('openModalUpload'); 
                $model=\App\Models\Berkas::find($this->selectedItem);
                $this->syarat_name=$model->syarats->nama_syarat;
                break;
       }
       
    }
    public function refreshParent(){

        $this->prompt="the parent has refresh";
    }
    public function download($link)
    {
     
        return response()->download(storage_path('app/public/'.$link));
    }

    public function render()
    {
        $this->pengajuans=\App\models\Pengajuan::find($this->pengajuan_id);
        $this->recents=$this->readyToLoad ? 
        \App\models\Pengajuan::where('pemohon_id',$this->pengajuans->pemohon_id)
        ->orderBy('created_at','DESC')->take(5)->get() : [];

        
       
        return view('livewire.pendaftaran.list-pengajuan.edit');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
    }
}
