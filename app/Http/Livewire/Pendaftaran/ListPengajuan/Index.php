<?php

namespace App\Http\Livewire\Pendaftaran\ListPengajuan;

use Livewire\Component;
use App\Models\Izin;
use App\Models\Syarat;
use App\Models\Berkas;
use App\Models\Pengajuan;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class Index extends Component
{
    use WithPagination;
    public $prompt;
    public $selectedItem;
    public $action;
    protected $pengajuans=[];
    public $name_delete,$name_pemohon,$izin_id,$berkas;
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
            $model=Pengajuan::findOrFail($this->selectedItem);
            $this->name_delete=$model->izins->nama_izin;
            $this->name_pemohon=$model->pemohons->name;
           $this->dispatchBrowserEvent('openDeleteModal');

       }
    }
    public function delete(){
        try{
        $model=\App\Models\Berkas::where('pengajuan_id',$this->selectedItem)->get();
        foreach($model as $item){
            if($item->link && file_exists(storage_path('app/public/' . $item->link))){
                \Storage::delete('public/'.$item->link);
            }
            $item->delete();
        }
       
        $mod_peng=\App\Models\Pengajuan::find($this->selectedItem);
        $mod_peng->delete();
        $this->alert('success', 'Hai!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  'Pengajuan berhasil dihapus', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Close', 
            'showCancelButton' =>  true, 
            'showConfirmButton' =>  false, 
      ]);
      $this->dispatchBrowserEvent('closeDeleteModal');
      \DB::commit();
        
       
        }catch(\Execption $e){
            \DB::rollback();
           
            $this->alert('error', 'Yah!', [
                'position' =>  'top-end', 
                'timer' =>  3000,  
                'toast' =>  true, 
                'text' =>  'Data gagal dihapus', 
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
          
            $this->pengajuans=$this->readyToLoad ?  Pengajuan::with('pemohons')->with('berkas')
            ->whereHas('pemohons', function($query) {
                $query->where('name','like', '%'.$this->search.'%');
            })
            ->where(function($sub_query){
                $sub_query->where('izin_id', '=', $this->izin_id);
                //$sub_query->where('pemohons.name', 'like', '%'.$this->search.'%');
            })->orderBy('created_at','DESC')->paginate(10)
            : [];
            
           
           
        }else{
       
        $this->pengajuans=$this->readyToLoad ?  Pengajuan::with('pemohons')->with('berkas')
        ->whereHas('pemohons', function($query) {
            $query->where('name','like', '%'.$this->search.'%');
        })
       
       
       
        ->orderBy('pengajuans.created_at','DESC')->paginate(10)
            : [];
       
           
            
           
        }
        
       
        return view('livewire.pendaftaran.list-pengajuan.index', [
    		'pengajuans'=>$this->pengajuans,'izins'=>Izin::get()
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
    

