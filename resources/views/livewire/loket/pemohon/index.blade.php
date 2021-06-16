<div>
    
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div id="modalFormAdd" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title">Tambah Pemohon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @livewire('pendaftaran.pemohon.add')
                </div>

            </div>
        </div>
    </div>
    <div id="modalFormEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Pemohon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @livewire('pendaftaran.pemohon.edit')
                </div>

            </div>
        </div>
    </div>
    <div id="modalFormUpload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Photo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @livewire('pendaftaran.pemohon.upload')
                </div>

            </div>
        </div>
    </div>
    <div id="modalFormDelete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-trash h1 text-warning"></i>
                        <h4 class="mt-2">Information</h4>
                        <p class="mt-3">Hapus data pemohon <h5><b>{{$name_delete}} </b></h5> dari tabel ?
                        </p>
                        <button type="button" wire:click="delete" class="btn btn-warning my-2"
                            data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" wire:init="loadSums">
            @if($readyToSum)
            @foreach ($sum as $item)
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary">
                                <i class="fe-tag font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">

                                <h3 class="text-dark mt-1"><span
                                        data-plugin="counterup">{{count($item->pemohons)}}</span>
                                </h3>
                                <p class="text-muted mb-1 text-truncate">{{$item->nama_kelurahan}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            @endforeach
            @else
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box br">
                    <div class="row">
                        <div class="col-6">
                            <div class="profilePic animate din rounded-circle bg-soft-primary">
    
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
    
                                <div class="comment br animate"></div>
                                <div class="comment br animate"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box br">
                    <div class="row">
                        <div class="col-6">
                            <div class="profilePic animate din rounded-circle bg-soft-primary">
    
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
    
                                <div class="comment br animate"></div>
                                <div class="comment br animate"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box br">
                    <div class="row">
                        <div class="col-6">
                            <div class="profilePic animate din rounded-circle bg-soft-primary">
    
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
    
                                <div class="comment br animate"></div>
                                <div class="comment br animate"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box br">
                    <div class="row">
                        <div class="col-6">
                            <div class="profilePic animate din rounded-circle bg-soft-primary">
    
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
    
                                <div class="comment br animate"></div>
                                <div class="comment br animate"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
    
            @endif

        
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <button type="button" data-toggle="modal" data-target="#modalFormAdd"
                    class="btn btn-sm btn-blue waves-effect waves-light float-right">
                    <i class="mdi mdi-plus-circle"></i> Tambah Pemohon
                </button>
                <h4 class="header-title mb-4">Manage Pemohon</h4>

                <div id="tickets-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table
                                class="table table-hover m-0 table-centered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed"
                                id="tickets-table" role="grid" aria-describedby="tickets-table_info">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">No</th>
                                        <th style="text-align: center; vertical-align: middle;">#ID</th>
                                        <th style="text-align: center; vertical-align: middle;">Nama</th>
                                        <th style="text-align: center; vertical-align: middle;">Phone</th>
                                        <th style="text-align: center; vertical-align: middle;">Kelurahan</th>
                                        <th style="text-align: center; vertical-align: middle;">Alamat</th>
                                        <th style="text-align: center; vertical-align: middle;">
                                            Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <tbody wire:init="loadPosts">

                                    @if($readyToLoad)
                                    @foreach ($pemohons as $key=>$item)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">{{$loop->iteration}}
                                        </td>
                                        <td>{{$item->id}}</td>
                                        <td><a href="javascript: void(0);">
                                                <img src="{{asset ('assets/images/users/user-10.jpg')}}"
                                                    alt="contact-img" title="contact-img"
                                                    class="rounded-circle avatar-xs">
                                            </a>
                                            {{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->kelurahans['nama_kelurahan']}}</td>
                                        <td>{{$item->address}}</td>
                                        <td style="text-align: center; vertical-align: middle;">

                                            <a href="javascript:void(0);"
                                                wire:click="selectItem('{{$item->id}}','edit')" class="action-icon"> <i
                                                    class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);"
                                                wire:click="selectItem('{{$item->id}}','upload')" class="action-icon">
                                                <i class="mdi mdi-camera"></i></a>
                                            <a href="javascript:void(0);"
                                                wire:click="selectItem({{$item->id}},'delete')" class="action-icon"> <i
                                                    class="mdi mdi-delete"></i></a>



                                        </td>
                                    </tr>

                                    @endforeach


                                    @else
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;" colspan="7">
                                            <div class="button-list">

                                                <button class="btn btn-primary" type="button" disabled="">
                                                    <span class="spinner-border spinner-border-sm mr-1" role="status"
                                                        aria-hidden="true"></span>
                                                    Loading...
                                                </button>
                                            </div>

                                        </td>
                                    </tr>

                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="tickets-table_paginate">
                                <ul class="pagination pagination-rounded">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    

    <!-- shimer 

    <div class="row">
       

    </div>
   

    <div class="row">
        <div class="col-12">
            <div class="card-box br">

                <h4 class="tulisan br animate w50 mb-4"></h4>
                <h4 class="tulisan br animate w60 mb-4"></h4>
                <h4 class="tulisan br animate w80 mb-4"></h4>

                <div id="tickets-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    <div class="row">
                        <div class="col-sm-12">

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers">
                                <ul class="pagination pagination-rounded">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->


</div>
