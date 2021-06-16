<div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Nama Izin</label>
                <input type="text" class="form-control" placeholder="Masukan Nama Izin" wire:model="nama_izin">
                @if ($errors->has('nama_izin'))
                <p style="color: red;">{{$errors->first('nama_izin')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Waktu Pelayanan</label>
                <input type="text" class="form-control" placeholder="Contoh: 1 (satu) jam" wire:model="waktu_pelayanan">
                @if ($errors->has('waktu_pelayanan'))
                <p style="color: red;">{{$errors->first('waktu_pelayanan')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Biaya/Tarif</label>
                <input type="text" class="form-control" placeholder="Contoh: Gratis/Tidak dipungut bayaran"
                    wire:model="biaya">
                @if ($errors->has('biaya'))
                <p style="color: red;">{{$errors->first('biaya')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Produk Pelayanan</label>
                <textarea class="form-control" wire:model="produk_pelayanan" rows="5" placeholder="Masukan alamat"></textarea>

                @if ($errors->has('produk_pelayanan'))
                <p style="color: red;">{{$errors->first('produk_pelayanan')}}</p>
                @endif
            </div>
        </div>
    </div>
    <!--<div class="col-md-12" wire:ignore>
                <div class="form-group">
                    <label for="field-3" class="control-label">Cover</label>
                    <input type="file" id="covers" wire:model="cover" name="covers" class="form-control-file">
                </div>
            </div>-->


<div class="modal-footer">
    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
    <button type="button" wire:click="Save" class="btn btn-info waves-effect waves-light">Simpan</button>
</div>


@push('scripts')
<script>
    /*const inputElement=document.querySelector('input[id="covers"]');
        const pond=FilePond.create( inputElement );
        FilePond.setOptions({
                server:{
                url:'/sip-admin/upload',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token()}}'
                }
            }
        });

        $(document).on('change', '#covers', function (e) {
                @this.set('cover', e.target.value);
                
            });
            */
</script>

@endpush
</div>