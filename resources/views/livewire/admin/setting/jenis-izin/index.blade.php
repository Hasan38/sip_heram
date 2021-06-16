<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div id="modalFormAdd" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title">Tambah Jenis Izin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @livewire('admin.setting.jenis-izin.add')
                </div>

            </div>
        </div>
    </div>

    <div id="modalFormEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Izin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @livewire('admin.setting.jenis-izin.edit')
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
                        <p class="mt-3">Hapus data izin <h5><b>{{$name_delete}} dari tabel ?</b></h5>
                        </p>
                        <button type="button" wire:click="delete" class="btn btn-warning my-2"
                            data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-8">
                            <form class="search-bar form-inline">
                                <div class="position-relative form-group mb-2">
                                    <label for="inputPassword2" class="sr-only">Search</label>
                                    <input type="text" wire:model.debounce.300ms="search" class="form-control"
                                        id="inputPassword2" placeholder="Search...">
                                    <span class="mdi mdi-magnify"></span>
                                </div>

                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right">
                                <a href="#" type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"
                                    data-toggle="modal" data-target="#modalFormAdd"><i
                                        class="mdi mdi-plus-circle mr-1"></i>Tambah Data</a>
                                <button type="button" class="btn btn-light waves-effect mb-2"><i
                                        class="mdi mdi-file-pdf-box"></i>Export</button>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">No</th>
                                    <th style="text-align: center; vertical-align: middle;">Nama</th>
                                    <th style="text-align: center; vertical-align: middle;">Persyaratan</th>
                                    <th style="text-align: center; vertical-align: middle;">
                                        Action</th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($izins as $item)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">{{$loop->iteration}}</td>
                                    <td>
                                        @if(count($item->syarats)>0)

                                        <button type="button" tabindex=""
                                            class="btn btn-success btn-rounded waves-effect waves-light"
                                            data-toggle="popover" data-placement="top" data-trigger="focus" title=""
                                            data-content="@foreach($item->syarats as $key) {{$key['nama_syarat']}},  @endforeach"
                                            data-original-title="Persyaratan {{$item->nama_izin}}">
                                            <span class="btn-label"><i class="mdi mdi-layers-outline"></i></span>
                                            {{$item->nama_izin}}
                                        </button>

                                        @else
                                        <button type="button"
                                            class="btn btn-primary btn-rounded waves-effect waves-light"
                                            data-toggle="popover" data-placement="top" data-trigger="focus" title=""
                                            data-content="belum ada persyaratan"
                                            data-original-title="Persyaratan {{$item->nama_izin}}">
                                            <span class="btn-label"><i class="mdi mdi-layers-outline"></i></span>
                                            {{$item->nama_izin}}
                                        </button>
                                        @endif

                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        @if(count($item->syarats)>0)
                                        <button type="button" class="btn btn-warning waves-effect waves-light">
                                            {{count($item->syarats)}}
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                            {{count($item->syarats)}}
                                        </button>
                                        @endif

                                    </td>

                                    <td style="text-align: center; vertical-align: middle;">
                                        <a href="javascript:void(0);" wire:click="selectItem({{$item->id}},'edit')"
                                            class="action-icon"><i class="mdi mdi-pencil "></i> </a>

                                        <a href="javascript:void(0);" wire:click="selectItem({{$item->id}},'delete')"
                                            class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <ul class="pagination pagination-rounded justify-content-end my-2">
                        {{ $izins->links('livewire.livewire-pagination') }}
                    </ul>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>
@push('scripts')
<script>

</script>
@endpush