<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div id="modalFormUpload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Persyaratan {{$syarat_name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @if($izin_id)
                    @livewire('pendaftaran.pengajuan.add-berkas')
                    @endif
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
                        <p class="mt-3">Batalkan pengajuan <h5><b>{{$name_delete}} </b><br> membatalkan pengajuan dapat menghapus berkas yang sudah diupload</h5> ?
                        </p>
                        <button type="button" wire:click="Delete" class="btn btn-warning my-2"
                            data-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card-box">

                <h4 class="header-title mb-4">Lengkapi data dibawah ini</h4>

                <ul class="nav nav-tabs nav-bordered nav-justified">
                    <li class="nav-item">
                        <a href="#step-1" data-toggle="tab" aria-expanded="{{ $currentStep != 1 ? '' : 'true'  }}"
                            class="nav-link {{ $currentStep != 1 ? ' ' : 'active' }}">
                            Pilih Izin 
                            @if ($currentStep == 2 || $currentStep ==3 )
                            <button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-check-all"></i></button>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-2" data-toggle="tab" aria-expanded="{{ $currentStep != 2 ? '' : 'true' }}"
                            class="nav-link {{ $currentStep != 2 ? '' : 'active'  }}">
                            Lengkapi Berkasi
                            @if ($currentStep == 3)
                            <button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-check-all"></i></button>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#step-3" data-toggle="tab" aria-expanded="{{ $currentStep != 3 ? '' : 'true' }}"
                            class="nav-link {{ $currentStep != 3 ? '' : 'active' }}">
                            Confrim
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane {{ $currentStep != 1 ? '' : 'active' }}" id="step-1">
                       
                        <div class="col-md-12">

                            <div class="form-group" wire:ignore>
                                <label for="field-4" class="control-label">Pilih Pemohon</label>
                                <select class="form-control select1" id="select1" wire:model="pemohon_id">
                                    <option></option>
                                    @foreach($pemohons as $tag)
                                    <option value="{{ $tag->id}}">{{ $tag->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('pemohon_id'))
                                <p style="color: red;">{{$errors->first('pemohon_id')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12" wire:ignore>
                            <div class="form-group">
                                <label for="field-4" class="control-label">Pilih Izin</label>
                                <select class="form-control select2" id="select2" wire:model="izin_id">
                                    <option></option>
                                    @foreach($izins as $tag)
                                    <option value="{{ $tag->id}}">{{ $tag->nama_izin}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('izin_id'))
                                <p style="color: red;">{{$errors->first('izin_id')}}</p>
                                @endif
                            </div>
                        </div>
                        <button type="button" wire:click="firstStepSubmit"
                            class="btn btn-info waves-effect waves-light">Simpan</button>
                       
                    </div>
                    <div class="tab-pane {{ $currentStep != 2 ? ' ' : 'active' }}" id="step-2">
                        <div class="table-responsive">
                            @if($pengajuan_id)
                            <div class="progress mb-2 progress-xl">
                                <div class="progress-bar @php
                                $prog=count($berkas_not_null)/$pengajuan->syarat_count*100;
                                $count_nn=count($berkas_not_null);
                                switch ($prog) {
                                    case $prog < 30 :
                                        echo'bg-danger';
                                        break;
                                    case $prog > 30 && $prog < 90 :
                                        echo'bg-warning';
                                        break;
                                    case $prog > 90 && $prog = 90 :
                                        echo'bg-success';
                                        break;
                                }
                            @endphp" role="progressbar"
                                    style="width: {{count($berkas_not_null)/$pengajuan->syarat_count*100}}%;"
                                    aria-valuenow="{{count($berkas_not_null)/$pengajuan->syarat_count*100}}"
                                    aria-valuemin="0"
                                    aria-valuemax="{{$pengajuan->syarat_count/$pengajuan->syarat_count*100}}">
                                    {{ceil(count($berkas_not_null)/$pengajuan->syarat_count*100)}}%</div>

                            </div>



                            <tbody>
                                @foreach ($berkas as $key=>$item)
                                @if($item->link==null)
                                <td>
                                    <div class="card mb-1 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar-sm">
                                                        <span
                                                            class="avatar-title badge-soft-primary text-primary rounded">
                                                            File
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col pl-0">
                                                    <a href="javascript:void(0);"
                                                        class="text-muted font-weight-bold">{{$item->syarats->nama_syarat}}</a>

                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->

                                                    <a href="javascript:void(0);"
                                                        wire:click="selectItem('{{$item->id}}','{{$pengajuan_id}}','upload')"
                                                        class="btn btn-link font-16 text-muted">
                                                        <i class="dripicons-upload"></i>
                                                        Upload File
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @else
                                <td>
                                    <div class="card mb-1 shadow-none border">
                                        <div class="p-2 btn-soft-success waves-effect waves-light">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar-sm">
                                                        <span
                                                            class="avatar-title badge-soft-primary text-primary rounded">
                                                            File
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col pl-0">
                                                    <a href="javascript:void(0);"
                                                        class="text-muted font-weight-bold">{{$item->syarats->nama_syarat}}</a>

                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <button type="button"
                                                        class="btn btn-warning btn-rounded waves-effect waves-light"
                                                        wire:click="selectItem('{{$item->id}}','{{$pengajuan_id}}','upload')">
                                                        <span class="btn-label"><i class="mdi mdi-check-all"></i></span>
                                                        Ubah File
                                                    </button>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @endforeach
                            </tbody>



                            @if(count($berkas_not_null)/$pengajuan->syarat_count*100 == 100)
                            <div class="mt-2">
                                <button type="button" wire:click="secondStepSubmit"
                                    class="btn btn-info waves-effect waves-light">Lanjutkan</button>
                            </div>
                            @endif
                            <div >
                                <button type="button" 
                                wire:click="selectItem('{{$pengajuan_id}}','{{$pengajuan_id}}','delete')" class="btn btn-danger waves-effect waves-light">Batalkan Pengajuan</button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane {{ $currentStep != 3 ? ' ' : 'active' }}" id="step-3">
                        @if($pengajuan_id)
                        <div class="text-center">
                            <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                            <h3 class="mt-0">Silahkan Proses!</h3>

                            <p class="w-75 mb-2 mx-auto">Tekan proses, pengajuan Anda Akan diperiksa oleh bagian loket.
                            </p>

                            <div class="mb-3">
                                <button type="button" wire:click="submitForm"
                                    class="btn btn-success btn-rounded waves-effect waves-light">
                                    Proses<span class="btn-label-right"><i class="mdi mdi-check-all"></i></span>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

        <div class="col-xl-4 col-lg-4">
            <div class="card">
                <div class="card-body">
                    @if($pemohon_id)
                    <div class="media mb-3">

                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="contacts-profile.html" class="text-reset">{{$profil->name}}</a>
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-14">
                                <small class="mdi mdi-circle text-success"></small> {{$profil->status}}
                            </p>
                        </div>
                        <div>
                            @if($pengajuan_id)
                            <a href="javascript: void(0);" class="text-reset font-19 py-1 px-2 d-inline-block"
                                data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="Batalkan Pengajuan">
                                <i class="fe-trash-2"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <li class="list-group-item">
                                <i class="fe-home text-success"></i> &nbsp{{$profil->address}}
                            </li>
                            <li class="list-group-item">
                                <i class="fe-home text-success"></i> &nbsp{{$profil->kelurahans->nama_kelurahan}}
                            </li>
                            <li class="list-group-item">
                                <i class="fe-trending-up text-success"></i> &nbsp{{$profil->nik}}
                            </li>
                            <li class="list-group-item">
                                <i class="fe-phone text-success"></i> &nbsp{{$profil->phone}}
                            </li>
                        </div>
                    </div>
                    @endif

                    <!-- start search box -->

                    <!-- end search box -->

                    <h6 class="font-13 text-muted text-uppercase mt-3">Pengajuan Baru</h6>

                    <div class="row">
                        <div class="col">
                            @if($pengajuan_id)
                            <li class="list-group-item">
                                <i class="fe-briefcase text-success"></i> &nbsp{{$pengajuan->izins->nama_izin}}
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
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
    $('#select1').select2({
        placeholder: 'Select an option',
    });

    $(document).on('change', '#select1', function (e) {
        @this.set('pemohon_id', e.target.value);
        
    });
    $('#select2').select2({
        placeholder: 'Select an option',
    });

    $(document).on('change', '#select2', function (e) {
        @this.set('izin_id', e.target.value);
        
    });


});
                  
</script>

@endpush