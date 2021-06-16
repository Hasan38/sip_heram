<div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-3" class="control-label">Masukan File</label>
                
                <input type="file" wire:model="link" id="link" class="form-control" />
                @if ($errors->has('link'))
                <p style="color: red;">{{$errors->first('link')}}</p>
                @endif
                
            </div>
            
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
        <button type="button" wire:click="uploadBerkas" class="btn btn-info waves-effect waves-light">Simpan</button>
    </div>

</div>

@push('scripts')
<script>

</script>
@endpush