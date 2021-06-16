
        window.addEventListener('closeModalAdd', event => {
            $('#modalFormAdd').modal('hide');
        })
        window.addEventListener('openModalAdd', event => {
            $('#modalFormAdd').modal('show');
        })

        window.addEventListener('closeModalEdit', event => {
            $('#modalFormEdit').modal('hide');
        })
        window.addEventListener('openModalEdit', event => {
            $('#modalFormEdit').modal('show');
        })
        window.addEventListener('openDeleteModal', event => {
            $('#modalFormDelete').modal('show');
        })
        window.addEventListener('closeDeleteModal', event => {
            $('#modalFormDelete').modal('hide');
        })
        window.addEventListener('openModalUpload', event => {
            $('#modalFormUpload').modal('show');
        })
        window.addEventListener('closeModalUpload', event => {
            $('#modalFormUpload').modal('hide');
        })

        $(document).ready(function(){

        $('#modalFormAdd').on('hidden.bs.modal', function(){
            livewire.emit('forcedCloseModal');
        });
        
        $('#modalFormEdit').on('hidden.bs.modal', function(){
            livewire.emit('forcedCloseModal');
        });
        $('#modalFormUpload').on('hidden.bs.modal', function(){
            livewire.emit('forcedCloseModal');
        });

        });

        
        
    
 