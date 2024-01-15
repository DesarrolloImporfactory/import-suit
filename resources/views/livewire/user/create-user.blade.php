<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-right btn-sm" data-bs-toggle="modal" data-bs-target="#createUser">
        Crear Usuario
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="createUser" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear nuevo usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='createUser'>
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
                        <div class="form-group d-flex">
                            <div class="">
                                <p>Asignar rol:</p>
                                <x-adminlte-select2 class="form-select mr-2" name="rol" id="rol" wire:model="rol">
                                    <option value="">Seleccione una opcion.....</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>
                            <div class="flex-grow-1">
                                <p>Asignar perfil:</p>
                                <select class="form-select" name="perfil" id="perfil"
                                    wire:model="perfil">
                                    <option value="">Seleccione una opcion.....</option>
                                    @foreach ($perfiles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
</div>
