
<button type="button" class="btn btn-primary float-right rounded-circle" data-bs-toggle="modal" data-bs-target="#create">
    <i class="fa-solid fa-plus"></i>
</button>
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear categoria de productos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='create' action="">
                <div class="modal-body">
                    <div class="form-group">
                        <p>Nombre:</p>
                        <input type="text" class="form-control" wire:model='name'>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
