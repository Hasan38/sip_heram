<?php

namespace App\Http\Livewire\Pendaftaran\Pengajuan;

use Livewire\Component;

class Index extends Component
{
    public $izin_id,$pemohon_id,$pengajuan_id;
    public $izins=[],$pemohons=[],$syarats,$berkas,$pengajuan;
    public $currentStep = 1,$profil,$name_delete;
    public $selectedItem,$selectedItemPengajuan,$avatar,$syarat_name,$berkas_not_null;
    public $readyToLoadBerkas = false;
   
    protected $listeners = [
        'syaratAdded' => 'updateSyarat',
        'loadPosts'
       
    ];

    public function loadPosts()
    {
        $this->readyToLoadBerkas = true;
    }
    public function updateSyarat(): void
    {
        if($this->pengajuan_id){
            $this->berkas=\App\Models\Berkas::where('pengajuan_id',$this->pengajuan_id)->get();
            $this->berkas_not_null=\App\Models\Berkas::where('pengajuan_id',$this->pengajuan_id)
            ->where('link','!=',null)->get();
        }
    }
    public function mount(){
        
        $this->izin_id;
    }

    public function selectItem($itemId,$itemIdPengajuan,$action)
    {
       
       $this->selectedItem=$itemId;
       $this->selectedItemPengajuan=$itemIdPengajuan;
       switch ($action){
            case 'delete':
                $mod=\App\Models\Pengajuan::findOrFail($this->selectedItem);
                $this->name_delete=$mod->izins->nama_izin;
                $this->dispatchBrowserEvent('openDeleteModal');
                break;
            case 'edit':
                $this->emit('getModelId',$this->selectedItem);
                $this->dispatchBrowserEvent('openModalEdit'); 
                break;
            case 'upload':
                $this->emit('getModelId',$this->selectedItem,$this->selectedItemPengajuan);
                $this->dispatchBrowserEvent('openModalUpload'); 
                $model= \App\Models\Berkas::find($this->selectedItem);
                $this->syarat_name=$model->syarats->nama_syarat;
                break;
       }
       
    }
    public function firstStepSubmit()
    {
        
        $validatedData = $this->validate([
            'izin_id' => 'required',
            'pemohon_id' => 'required',
           
        ]); 
       \DB::transaction(function () {
             
                    if($this->pengajuan_id){
                        $this->alert('warning', 'Hai!', [
                            'position' =>  'top-center', 
                            'timer' =>  3000,  
                            'toast' =>  true, 
                            'text' =>  'Anda sudah menginputkan pengajuan sebelumnnya silahkan hapus terlebih dahulu', 
                            'confirmButtonText' =>  'Ok', 
                            'cancelButtonText' =>  'Close', 
                            'showCancelButton' =>  true, 
                            'showConfirmButton' =>  false, 
                      ]);
                    } else{
                        try{  
                        $syaratss=\App\Models\Syarat::where('izin_id',$this->izin_id)->get();
                        $new = new \App\Models\Pengajuan;
                        $new->izin_id=$this->izin_id;
                        $new->pemohon_id=$this->pemohon_id;
                        $new->created_by=\Auth::user()->id;
                        $new->syarat_count=count($syaratss);
                        $new->verified_kasi=false;
                        $new->verified_kadis=false;
                        $new->status='Pemeriksaan Berkas';
                        $new->save();
                        $this->pengajuan_id=$new->id;
                        //if(isset($this->tmp_master) && count($this->tmp_master) > 0) {
                        //}
                        foreach($syaratss as $item){
                            $brks = \App\Models\Berkas::create(
                                ['pengajuan_id' =>  $this->pengajuan_id,
                                'syarat_id' => $item->id,
                                'created_by' => \Auth::user()->id,
                                'verified'=>false
                                 ],
                               
                            );
                        }
                        
        
                        
                          \DB::commit();
                        
                          $this->alert('success', 'Hai!', [
                            'position' =>  'top-end', 
                            'timer' =>  3000,  
                            'toast' =>  true, 
                            'text' =>  'Pengajuan berhasil ditambahkan silahkan lengkapi berkas', 
                            'confirmButtonText' =>  'Ok', 
                            'cancelButtonText' =>  'Close', 
                            'showCancelButton' =>  true, 
                            'showConfirmButton' =>  false, 
                      ]);
                       $this->currentStep = 2;
            
                            }catch (\Exception $e){
                                \DB::rollback();
                                $this->currentStep = 1;
                                    $this->alert('error', 'Yah!', [
                                        'position' =>  'top-end', 
                                        'timer' =>  3000,  
                                        'toast' =>  true, 
                                        'text' =>  'Data Gagal diinput'.$e, 
                                        'confirmButtonText' =>  'Ok', 
                                        'cancelButtonText' =>  'Close', 
                                        'showCancelButton' =>  true, 
                                        'showConfirmButton' =>  false, 
                                ]);
                            }
                
                    } 
                
                
                });
                  
    }
  
    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {

  
        $this->currentStep = 3;
    }
  
    /**
     * Write code on Method
     */
    public function submitForm()
    {
  
  try{
    $n = \App\Models\Pengajuan::findOrFail($this->pengajuan_id);
    $n->status='Pemeriksaan Berkas';
    $n->save();
    $this->clearForm();
    $this->currentStep = 1;

    $this->alert('success', 'Hai!', [
        'position' =>  'top-end', 
        'timer' =>  3000,  
        'toast' =>  true, 
        'text' =>  'Pengajuan akan di periksa oleh bagian loket', 
        'confirmButtonText' =>  'Ok', 
        'cancelButtonText' =>  'Close', 
        'showCancelButton' =>  true, 
        'showConfirmButton' =>  false, 
  ]);
     }catch(\Execption $e){
         dd($e);
                $this->alert('error', 'Yah!', [
                    'position' =>  'top-end', 
                    'timer' =>  3000,  
                    'toast' =>  true, 
                    'text' =>  'Data gagal diproses'.$e, 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Close', 
                    'showCancelButton' =>  true, 
                    'showConfirmButton' =>  false, 
            ]);
    }
        
    }

    
  
    /**
     * Write code on Method
     */
    public function back($step)
    {
        $this->currentStep = $step;    
    }

    public function clearForm()
    {
        $this->izin_id = '';
        $this->pemohon_id = '';
        $this->pengajuan_id = '';
 
    }

    public function Delete(){
        try{
        $model=\App\Models\Berkas::where('pengajuan_id',$this->pengajuan_id)->get();
        foreach($model as $item){
            if($item->link && file_exists(storage_path('app/public/' . $item->link))){
                \Storage::delete('public/'.$item->link);
            }
            $item->delete();
        }
       
        $mod_peng=\App\Models\Pengajuan::find($this->pengajuan_id);
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
      $this->clearForm();
      return redirect()->to('/sip-admin/pendaftaran/pengajuan');
      \DB::commit();
        
       
        }catch(\Execption $e){
            \DB::rollback();
            $this->currentStep = 2;
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


    public function render()
    {
        if($this->izin_id){
           
            $this->izins= \App\Models\Izin::with('syarats')->get();
            $this->syarats= \App\Models\Syarat::where('izin_id',$this->izin_id)->get();
            if($this->pengajuan_id){
                $this->pengajuan=\App\Models\Pengajuan::find($this->pengajuan_id);
                $this->berkas=\App\Models\Berkas::where('pengajuan_id',$this->pengajuan_id)->get();
                $this->berkas_not_null=\App\Models\Berkas::where('pengajuan_id',$this->pengajuan_id)
            ->where('link','!=',null)->get();
                
            }
            
        }else{
            $this->izins= \App\Models\Izin::with('syarats')->get();
        }
       
        if($this->pemohon_id){
            $this->profil=\App\Models\Pemohon::find($this->pemohon_id);
            
            
        }
       
        $this->pemohons=\App\Models\Pemohon::get();
        return view('livewire.pendaftaran.pengajuan.index',['izins'=>$this->izins,'pemohons'=>$this->pemohons,'syarats'=>$this->syarats]);
    }
}
