<div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" wire:ignore>
                    <label for="field-4" class="control-label">Pilih Izin</label>
                    <select class="form-control select1" id="select1" wire:model="izin_id">
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
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-3" class="control-label">Persyaratan Pelayanan</label>
                    <input type="text" class="form-control" placeholder="Masukan Persyaratan Pelayanan" wire:model="nama_syarat">
                    @if ($errors->has('nama_syarat'))
                    <p style="color: red;">{{$errors->first('nama_syarat')}}</p>
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

        $(document).ready(function () {
            $('#select1').select2({
                placeholder: 'Select an option',
            });

            $(document).on('change', '#select1', function (e) {
                @this.set('izin_id', e.target.value);
                
            });

            document.addEventListener("livewire:load", function (event) {
            window.livewire.hook('afterDomUpdate', () => {
                $('#select1').select2({
                    placeholder: 'Select an option',
                    
                });
                
            });
          });
        });
    </script>

    @endpush
</div>