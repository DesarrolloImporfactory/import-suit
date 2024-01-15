<div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='update' action="">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <p>Precio en china:</p>
                            <input type="text" id="precio1" wire:model='price_china' class="form-control form-control-sm">
                            @error('price_china')
                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <p>Precio en latam:</p>
                            <input type="text" id="precio2" wire:model='price_latam' class="form-control form-control-sm">
                            @error('price_latam')
                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <p>P.P.M:</p>
                            <input type="text" id="precio3" wire:model='price_mayor' class="form-control form-control-sm">
                            @error('price_mayor')
                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <p>P.V.P:</p>
                            <input type="text" id="precio4" wire:model='price_public' class="form-control form-control-sm">
                            @error('price_public')
                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>Nombre del producto: </p>
                                <input type="text" class="form-control" wire:model='name'>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p>* Descripción: </p>
                                <input type="text" class="form-control" wire:model='description'>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p>Enlace del producto: </p>
                                <input type="text" class="form-control" wire:model='enlace'>
                                @error('enlace')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p>Estado</p>
                                <div wire:ignore>
                                    <select class="my-select" name="" data-width="100%" id="estadoEdit"
                                        title="Choose one of the following..." data-style="btn-success">
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                                @error('estado')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p>Enlace al video: </p>
                                <input type="text" class="form-control" wire:model='video'>
                                @error('video')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>Proveedor</p>
                                <div wire:ignore>
                                    <select class="my-select" name="" data-style="btn-warning" id="proveedorEdit"
                                        data-width="100%" title="Choose one of the following...">
                                        @foreach ($proveedores as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('proveedor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p>Imagen del producto</p>
                                <input type="file" class="form-control form-control-sm" id="{{ $codigo }}"
                                    wire:model='photo'>
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                @if ($photo)
                                    <div class="text-center">
                                        <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail" width="150">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="../../storage/{{ $imagen }}" class="img-thumbnail"
                                            width="150">
                                    </div>
                                @endif

                                <div wire:loading wire:target='photo' class="alert alert-dark alert-dismissible mb-0"
                                    role="alert">
                                    Cargando imagen.......
                                </div>
                            </div>
                            <div class="form-group">
                                <p>Categoría:</p>
                                <div wire:ignore>
                                    <select class="my-select" name="" data-width="100%" id="categoriaEdit"
                                        title="Choose one of the following...">
                                        @foreach ($categorias as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('categoria')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
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
@push('js')
    <script>
        Livewire.on('selects', data => {
            $('#proveedorEdit').val(data.proveedor);
            $('#proveedorEdit').trigger('change');
            $('#estadoEdit').val(data.estado);
            $('#estadoEdit').trigger('change');
            $('#categoriaEdit').val(data.categoria);
            $('#categoriaEdit').trigger('change');
        });

        $(document).ready(function() {
            $('.my-select').selectpicker();
            $('#proveedorEdit').on('change', function(e) {
                @this.set('proveedor', e.target.value);
            });
            $('#categoriaEdit').on('change', function(e) {
                @this.set('categoria', e.target.value);
            });
            $('#estadoEdit').on('change', function(e) {
                @this.set('estado', e.target.value);
            });
        });
    </script>
@endpush
