<!-- Button trigger modal -->
<button type="button" class="btn btn-primary float-right rounded-circle" wire:click="resetear">
    <i class="fa-solid fa-plus"></i>
</button>

<div wire:ignore.self class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear plantilla de suscripción</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="p-2" x-data="{ open: false }">
                <button @click="open = !open" class="btn btn-primary btn-sm">Agregar perfil</button>

                <div class="bg-light shadow  rounded mt-4" x-show="open">
                    <div class="px-4 py-2">
                        <form action="" wire:submit.prevent='perfilCreate'>
                            <div class="row">
                                <div class="col">
                                    <label for="">Nombre de perfil</label>
                                    <input type="text" class="form-control" wire:model='name'>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Precio</label>
                                    <input type="text" class="form-control" wire:model='precio'>
                                    @error('precio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm mt-2" type="submit">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 form-group">
                        <div class="flex">
                            <div>
                                <p>Seleccionar perfil</p>
                                <div class="form flex-grow-1">
                                    <select class="form-select" name="name_id" wire:model="name_id">
                                        <option value="">Seleccionar perfil...</option>
                                        @foreach ($clientes as $item)
                                            <option value="{{ $item->id }}">{{ $item->id . ': ' . $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('name_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 form-group">
                        <p>Estado suscripción</p>
                        <div wire:ignore class="form">
                            <select class="my-select" data-width="100%" name=""
                                title="Seleccionar una opción....." id="estadoCreate">
                                <option value="Activa">Activa</option>
                                <option value="Caducada">Caducada</option>
                            </select>
                        </div>
                        @error('estado')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <p>Días</p>
                        <input type="number" class="form-control" wire:model='dias'>
                        @error('dias')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    {{-- <div class="col-md-6">
                        <p>Tipo suscripción</p>
                        <div wire:ignore class="form">
                            <select class="my-select" data-width="100%" name=""
                                title="Seleccionar una opción....." id="tipoCreate">
                                @foreach ($tipos as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('tipo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    {{-- <div class="col-md-6">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="form-group">
                                    <p>Fecha de inicio</p>
                                    <input type="date" class="form-control" wire:model='fecha_inicio'>
                                    @error('fecha_inicio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="ml-2">
                                <div class="form-group">

                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="form-group">
                    <div class="alert alert-success text-center slim-alert">
                        <p class="mt-2"><i class="fa-solid fa-eye-slash"></i> Seleccionar Sistemas</p>
                    </div>
                    <div class="row">
                        @foreach ($sistemas->where('tipo', 'sistema') as $key => $item)
                            <div class="col-md-6">
                                <div class="ml-3 mt-2 form-check">
                                    <input class="form-check-input" type="checkbox"
                                        wire:model="sistems.{{ $key }}" value="{{ $item->id }}">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <div class="alert alert-warning text-center slim-alert">
                        <p class="mt-2"><i class="fa-solid fa-eye-slash"></i> Seleccionar curso</p>
                    </div>
                    <div class="row">
                        @foreach ($sistemas->where('tipo', 'curso') as $key => $item)
                            <div class="col-md-6">
                                <div class="ml-3 mt-2 form-check">
                                    <input class="form-check-input" type="checkbox"
                                        wire:model="sistems.{{ $key }}" value="{{ $item->id }}">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('sistems')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click='create' class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
