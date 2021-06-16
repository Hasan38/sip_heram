<?php

namespace App\Http\Livewire\Pendaftaran\Pemohon;

use Livewire\Component;
use App\Models\Kelurahan;
use App\Models\Pemohon;



class Add extends Component
{
    public $name,
    $phone,
    $nik,
    $email,
    $jk,
    $tgl_lahir,
    $kelurahan_id,
    $address,$avatar;
    
    public $iteration;

    protected $listeners=[
        'forcedCloseModal',
        
    ];

    public function forcedCloseModal(){
        $this->clean();
        $this->resetErrorBag();
        $this->resetValidation();
        
    }
    public function Save(){

        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'jk' => 'required',
            'tgl_lahir' => 'required',
            'kelurahan_id' => 'required',
            'address' => 'required'
            
        ]);
        try{

           
        
            $new = new \App\Models\Pemohon;
            $new->name=$this->name;
            $new->phone=$this->phone;
            $new->nik=$this->nik;
            $new->email=$this->email;
            $new->jk=$this->jk;
            $new->tgl_lahir=$this->tgl_lahir;
            $new->kelurahan_id=$this->kelurahan_id;
            $new->address=$this->address;
            $new->password=\Hash::make($this->phone);
            $new->avatar='NULL';
            $new->created_by=\Auth::user()->id;
            
            $new->save();
    
            $this->emit('refreshParent');
            $this->dispatchBrowserEvent('closeModalAdd');
            $this->alert('success', 'Hai!', [
                'position' =>  'top-end', 
                'timer' =>  3000,  
                'toast' =>  true, 
                'text' =>  'Data Pemohon '.$this->name.' berhasil diinput', 
                'confirmButtonText' =>  'Ok', 
                'cancelButtonText' =>  'Close', 
                'showCancelButton' =>  true, 
                'showConfirmButton' =>  false, 
          ]);
    
            $this->clean();
            $this->iteration++;

            }catch (\Exception $e) {

                dd($e);
            }

    }

    public function clean(){
        $this->name=null;
        $this->kelurahan_id=null;
    }
    public function render()
    {
        return view('livewire.pendaftaran.pemohon.add',['kelurahans'=>Kelurahan::get()]);
    }
    
}
