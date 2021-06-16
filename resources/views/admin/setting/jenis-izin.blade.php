@extends('layouts.admin')
@section('title') Jenis Izin @endsection 
@section('content')

<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
         <div class="col-12">
             <div class="page-title-box">
                 <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="/home">SIP</a></li>
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>
                         <li class="breadcrumb-item active">Jenis Izin</li>
                     </ol>
                 </div>
                 <h4 class="page-title">Data Jenis Izin</h4>
             </div>
         </div>
     </div>     
     <!-- end page title --> 

 @livewire('admin.setting.jenis-izin.index')

@endsection