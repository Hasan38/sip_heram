<div>
    
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-3" class="control-label">Nama Kelurahan</label>
                    <input type="text" class="form-control" placeholder="Masukan Nama Kelurahan" wire:model="nama_kelurahan">
                    @if ($errors->has('nama_kelurahan'))
                    <p style="color: red;">{{$errors->first('nama_kelurahan')}}</p>
                    @endif
                </div>
            </div>
            <!--<div class="col-md-12" wire:ignore>
                <div class="form-group">
                    <label for="field-3" class="control-label">Cover</label>
                    <input type="file" id="covers" wire:model="cover" name="covers" class="form-control-file">
                </div>
            </div>-->
        </div>
       

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