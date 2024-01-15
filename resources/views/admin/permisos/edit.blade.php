<div wire:ignore.self class="modal fade" id="editPermiso" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-shield-halved"></i> Editar Rol
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='update' action="">
                <div class="modal-body">
                    <div class="form-group">
                        <p>Nombre del permiso:</p>
                        <input wire:model='name' class="form-control" type="text">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Descripción del permiso:</p>
                        <input wire:model='descripcion' class="form-control" type="text">
                        @error('descripcion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                            <p>¿A qué sistema pertenece? </p> 
                            <select class="form-select" name="sistema_id" id="sistema_id" wire:model="sistema_id">
                                <option value="">Seleccione una opcion.....</option>
                                @foreach ($sistemas as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('sistema_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

</div>
