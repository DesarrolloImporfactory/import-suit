<!-- Button trigger modal -->
<button type="button" class="btn btn-primary float-right rounded-circle" wire:click="resetear">
    <i class="fa-solid fa-plus"></i>
</button>

<div wire:ignore.self class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Suscripción</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" wire:submit.prevent='create'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <p>Seleccionar Cliente</p>
                            <div wire:ignore class="form">
                                <select class="my-select" name="" data-width="100%" data-live-search="true"
                                    id="clienteCreate" title="Seleccionar una opción....." data-size="10">
                                    @foreach ($clientes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('cliente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                            <p class="mt-2"><i class="fa-solid fa-eye-slash"></i> Seleccionar Curso</p>
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
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
