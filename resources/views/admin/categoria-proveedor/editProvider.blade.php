<div wire:ignore.self class="modal fade" id="editSistema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear categoria de productos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='update' action="">
                <div class="modal-body">
                    <div class="form-group">
                        <p>Nombre:</p>
                        <input type="text" class="form-control" wire:model='name'>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Dirección:</p>
                        <input type="text" class="form-control" wire:model='direccion'>
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Email:</p>
                        <input type="text" class="form-control" wire:model='email'>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr='disabled'>Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>