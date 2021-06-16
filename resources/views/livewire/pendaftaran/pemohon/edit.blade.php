<div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Nama Pemohon</label>
                <input type="text" class="form-control" placeholder="Masukan nama pemohon" wire:model="name">
                @if ($errors->has('name'))
                <p style="color: red;">{{$errors->first('name')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">No. Hp</label>
                <input type="number" class="form-control" placeholder="Masukan no hp pemohon" wire:model="phone">
                @if ($errors->has('phone'))
                <p style="color: red;">{{$errors->first('phone')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Nik</label>
                <input type="number" class="form-control" placeholder="Masukan nik pemohon" wire:model="nik">
                @if ($errors->has('nik'))
                <p style="color: red;">{{$errors->first('nik')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Em@il</label>
                <input type="email" class="form-control" placeholder="Masukan email pemohon" wire:model="email">
                @if ($errors->has('email'))
                <p style="color: red;">{{$errors->first('email')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12" wire:ignore>
            <div class="form-group">
                <label for="field-4" class="control-label">Jenis Kelamin</label>
                <select class="form-control selectJK" id="selectJK" wire:model="jk">
                    <option></option>

                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>

                </select>
                @if ($errors->has('jk'))
                <p style="color: red;">{{$errors->first('jk')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-4" class="control-label">Tanggal Lahir</label>
                <input type="text" id="basic-" wire:model="tgl_lahir" class="form-control flatpickr-input active"
                    placeholder="Tanggal Lahir Pemohon" readonly="readonly">
                @if ($errors->has('tgl_lahir'))
                <p style="color: red;">{{$errors->first('tgl_lahir')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" wire:ignore>
                <label for="field-4" class="control-label">Pilih Kelurahan</label>
                <select class="form-control select1" id="select1" wire:model="kelurahan_id">
                    <option></option>
                    @foreach($kelurahans as $tag)
                    <option value="{{ $tag->id}}">{{ $tag->nama_kelurahan}}</option>
                    @endforeach
                </select>
                @if ($errors->has('kelurahan_id'))
                <p style="color: red;">{{$errors->first('kelurahan_id')}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Alamat</label>

                <textarea wire:model="address" class="form-control" id="field-7"
                    placeholder="Masukan Alamat Pemohon"></textarea>
                @if ($errors->has('address'))
                <p style="color: red;">{{$errors->first('address')}}</p>
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
            @this.set('kelurahan_id', e.target.value);
            
        });

        $("#basic-").flatpickr({
           
            disableMobile: "true"
        });

        document.addEventListener("livewire:load", function (event) {
        window.livewire.hook('afterDomUpdate', () => {
            $('#basic-').flatpickr();
        });
    }); 
    });

    
    </script>

    @endpush
</div>