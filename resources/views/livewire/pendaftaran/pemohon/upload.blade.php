<div>
    <div class="row">
        <div class="col-md-12">

            <div class="col-md-12" wire:ignore>
                <div class="form-group">
                    <label for="field-3" class="control-label">Pilih Photo 
                       
                    </label>
                
                    <input type="text" id="id_pem" wire:model="id_pemohon" name="id_pem" class="form-control">
                    <input type="file" id="avatar" wire:model="avatar" name="avatar" class="form-control-file">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" wire:click="Save" class="btn btn-info waves-effect waves-light">Simpan</button>
            </div>


            @push('scripts')
            <script>
                /*const inputElement=document.querySelector('input[id="avatar"]');
                const pond=FilePond.create( inputElement );
                FilePond.setOptions({
                        server:{
                        url:'/sip-admin/upload',
                        headers:{
                            'X-CSRF-TOKEN':'{{ csrf_token()}}'
                        }
                    }
                });

                $(document).on('change', '#avatar', function (e) {
                        @this.set('avatar', e.target.value);
                        
                });

                */
            </script>

            @endpush
        </div>