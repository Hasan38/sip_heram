<div>
    <div id="modalFormUpload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Persyaratan {{$syarat_name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    @livewire('pendaftaran.pengajuan.add-berkas')

                </div>

            </div>
        </div>
    </div>
    <div class="row">

        <!-- Right Sidebar -->
        <div class="col-12">
            <div class="card-box">
                <!-- Left sidebar -->
                <div class="inbox-leftbar">

                    @if($pengajuans->pemohon_id)
                    <div class="media mb-3">

                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-13">
                                <a href="contacts-profile.html" class="text-reset">{{$pengajuans->pemohons->name}}</a>
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-12">
                                <small class="mdi mdi-circle text-success"></small> {{$pengajuans->pemohons->status}}
                            </p>
                        </div>
                        <div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <li class="list-group-item">
                                <i class="fe-home text-success"></i> &nbsp{{$pengajuans->pemohons->address}}
                            </li>
                            <li class="list-group-item">
                                <i class="fe-home text-success"></i>
                                &nbsp{{$pengajuans->pemohons->kelurahans->nama_kelurahan}}
                            </li>
                            <li class="list-group-item">
                                <i class="fe-trending-up text-success"></i> &nbsp{{$pengajuans->pemohons->nik}}
                            </li>
                            <li class="list-group-item">
                                <i class="fe-phone text-success"></i> &nbsp{{$pengajuans->pemohons->phone}}
                            </li>
                        </div>
                    </div>
                    @endif

                    <!-- start search box -->

                    <!-- end search box -->

                    <h6 class="font-12 text-muted text-uppercase mt-3">Pengajuan Baru</h6>

                    <div class="row">
                        <div class="col">
                            @if($pengajuans->id)
                            <li class="list-group-item">
                                <i class="fe-briefcase text-success"></i> &nbsp{{$pengajuans->izins->nama_izin}}
                            </li>
                            @else
                            <li class="list-group-item">
                                <i class="fe-briefcase text-success"></i> &nbsp Belum ada Pengajuan
                            </li>
                            @endif

                        </div>
                    </div>


                    <!-- users -->

                    <!-- end users -->


                </div>
                <!-- End Left sidebar -->

                <div class="inbox-rightbar">
                    

                    <div class="mt-3">
                        <h5 class="mb-2">Berkas Pengajuan {{$pengajuans->izins->nama_izin}}</h5>

                        <div class="row mx-n1 no-gutters">
                            @foreach ($pengajuans->berkas as $item)
                            <div class="col-xl-3 col-lg-6">
                                <div class="card m-1 shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-sm">
                                                    <span
                                                        wire:click="selectItem('{{$item->id}}','{{$item->pengajuan_id}}','upload')"
                                                        class="avatar-title bg-soft-primary text-primary rounded">
                                                        <i class="mdi mdi-folder-zip font-18"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col pl-0">
                                                <a href="#"
                                                    class="text-muted font-weight-bold">{{$item->syarats->nama_syarat}}</a>

                                                <p class="mb-0 font-13">
                                                    @if($item->link != null)
                                                    <a href="{{asset('storage/'.$item->link)}}" target="_blank"
                                                        type="button"
                                                        class="btn btn-soft-success btn-xs btn-rounded waves-effect waves-light">Lihat
                                                        File</a>
                                                    @else
                                                    <button type="button"
                                                        class="btn btn-soft-danger btn-xs btn-rounded waves-effect waves-light">Tidak
                                                        tersedia</button>
                                                    @endif
                                                </p>
                                            </div>
                                        </div> <!-- end row -->
                                    </div> <!-- end .p-2-->
                                </div> <!-- end col -->
                            </div> <!-- end col-->
                            @endforeach

                        </div> <!-- end row-->
                    </div> <!-- end .mt-3-->


                    <div class="mt-3">
                        <h5 class="mb-3">Recent</h5>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">No</th>
                                        <th>Nama Pemohon</th>
                                        <th>Nama Izin</th>
                                        <th style="text-align: center; vertical-align: middle;">Status</th>
                                    </tr>
                                </thead>
                                <tbody wire:init="loadPosts">

                                    @if($readyToLoad)
                                    @foreach ($recents as $key=>$item)
                                    @if($item->id == $pengajuan_id)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">{{$loop->iteration}}
                                        </td>
                                        <td>{{$item->pemohons->name}}<br>
                                            {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }} <small
                                                class="text-muted">{{ Carbon\Carbon::parse($item->created_at)->format('h:i:s A') }}</small>
                                        </td>
                                        <td>{{$item->izins->nama_izin}} <br>
                                            <span class="badge bg-soft-success text-success p-1">Pengajuan Baru</span></td>
                                        <td>{{$item->status}}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">{{$loop->iteration}}
                                        </td>
                                        <td>{{$item->pemohons->name}}<br>
                                            {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }} <small
                                                class="text-muted">{{ Carbon\Carbon::parse($item->created_at)->format('h:i:s A') }}</small>
                                        </td>
                                        <td>{{$item->izins->nama_izin}}</td>
                                        <td>{{$item->status}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @else
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;" colspan="4">
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
                       

                    </div> <!-- end .mt-3-->

                </div>
                <!-- end inbox-rightbar-->

                <div class="clearfix"></div>
            </div> <!-- end card-box -->

        </div> <!-- end Col -->
    </div>
</div>