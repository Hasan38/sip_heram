<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div id="modalFormAdd" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title">Tambah Persyaratn Izin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @livewire('admin.setting.persyaratan-izin.add')
                </div>

            </div>
        </div>
    </div>
    <div id="modalFormEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Persyaratan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @livewire('admin.setting.persyaratan-izin.edit')
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
                        <p class="mt-3">Hapus data persyaratan <h5><b>{{$name_delete}} </b></h5> dari tabel ?
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
                        <div class="col-lg-6">
                            <form class="search-bar form-inline text-lg-left">
                                <div class="position-relative form-group mb-2">
                                    <label for="inputPassword2" class="sr-only">Search</label>
                                    <input type="text" wire:model.debounce.300ms="search" class="form-control"
                                        id="inputPassword2" placeholder="Search...">
                                    <span class="mdi mdi-magnify"></span>


                                </div>
                                <div class="position-relative form-group mb-2">


                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-lg-right">

                                <a href="#" type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"
                                    data-toggle="modal" data-target="#modalFormAdd"><i
                                        class="mdi mdi-plus-circle mr-1"></i>Tambah Data</a>
                                <button type="button" class="btn btn-light waves-effect mb-2"><i
                                        class="mdi mdi-file-pdf-box"></i>Export</button>

                            </div>
                            <div wire:ignore>
                                <select class="select5" id="select5" wire:model="izin_id">
                                    <option></option>
                                    @foreach($izins as $tag)
                                    <option value="{{ $tag->id}}">{{ $tag->nama_izin}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">No</th>
                                    <th>Nama Izin</th>
                                    <th>Persyaratan Pelayanan</th>
                                    <th style="text-align: center; vertical-align: middle;">
                                        Action</th>
                                </tr>

                            </thead>
                            <tbody wire:init="loadPosts">

                                @if($readyToLoad)
                                @foreach ($syarat as $key=>$item)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">{{$loop->iteration}}
                                    </td>
                                    <td>{{$item->izins['nama_izin']}}</td>
                                    <td>{{$item->nama_syarat}}</td>

                                    <td style="text-align: center; vertical-align: middle;">

                                        <a href="javascript:void(0);" wire:click="selectItem({{$item->id}},'edit')"
                                            class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="javascript:void(0);" wire:click="selectItem({{$item->id}},'delete')"
                                            class="action-icon"> <i class="mdi mdi-delete"></i></a>



                                    </td>
                                </tr>

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
                    <ul class="pagination pagination-rounded justify-content-end my-2">
                        @if($readyToLoad)
                        {{ $syarat->links('livewire.livewire-pagination') }}
                        @endif
                    </ul>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
            $('#select5').select2({
                placeholder: 'Select an option',
            });

            $(document).on('change', '#select5', function (e) {
                @this.set('izin_id', e.target.value);
                
            });
        });
</script>
@endpush