@extends('layouts.admin')
@section('title') Data Pemohon @endsection 
@section('content')

<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
         <div class="col-12">
             <div class="page-title-box">
                 <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="/sip-admin/home">SIP</a></li>
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Petugas Loket</a></li>
                         <li class="breadcrumb-item active">Pemohon</li>
                     </ol>
                 </div>
                 <h4 class="page-title">Data Pemohon</h4>
             </div>
         </div>
     </div>     
     <!-- end page title --> 

 @livewire('loket.pemohon.index')

@endsection