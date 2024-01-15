<div wire:ignore.self class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='updateUser'>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Nombre de usuario:</p>
                        <input type="text" class="form-control" wire:model="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Email:</p>
                        <input type="text" class="form-control" wire:model="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Password temporal:</p>
                        <input type="password" class="form-control" wire:model="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:ignore.self class="form-group">
                        <p>Asignar rol:</p>
                        <x-adminlte-select2 class="form-select" name="rol" id="rol" wire:model="rol">
                            <option value="">Seleccione una opcion.....</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-adminlte-select2>
                    </div>
                    <div class="form-group">
                        <p>Enlace:</p>
                        <input type="text" class="form-control" wire:model="url" placeholder="www.enlace.com">
                        @error('url')
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
