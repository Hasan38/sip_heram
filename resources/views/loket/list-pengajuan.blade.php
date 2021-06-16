@extends('layouts.admin')
@section('title') Data Pengajuan @endsection 
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
                         <li class="breadcrumb-item active">Data Pengajuan</li>
                     </ol>
                 </div>
                 <h4 class="page-title">Data Pengajuan</h4>
             </div>
         </div>
     </div>     
     <!-- end page title --> 

 @livewire('loket.list-pengajuan.index')

@endsection