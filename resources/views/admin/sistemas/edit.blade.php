<div wire:ignore.self class="modal fade" id="editSistema" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-shield-halved"></i> Editar producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='update' action="">
                <div class="modal-body">

                    <div class="form-group">
                        <p>Nombre del producto:</p>
                        <input wire:model='name' class="form-control" type="text">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Tipo de producto:</p>
                        <select class="form-select" wire:model='tipo' id="">
                            <option value="">Seleccionar....</option>
                            <option value="sistema"> Sistema </option>
                            <option value="curso"> Curso</option>
                        </select>
                        @error('tipo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Ruta del producto:</p>
                        <input wire:model='ruta' class="form-control" type="text">
                        @error('ruta')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>
    </div>

</div>
