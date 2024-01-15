<div>
    @section('title', 'Crear')
    <div class="d-flex py-3">
        <h4 class="flex-grow-1 mb-2">Crear producto</h4>
        <a href="{{ route('products') }}" class="btn btn-secondary float-end"><i
                class="fa-solid fa-caret-left mr-2"></i>Volver</a>
    </div>
    <div class="">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="create" action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <p>Precio en china:</p>
                                <input type="text" wire:model='price_china' id="precio1"
                                    class="form-control form-control-sm">
                                @error('price_china')
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <p>Precio en latam:</p>
                                <input type="text" wire:model='price_latam' id="precio2"
                                    class="form-control form-control-sm">
                                @error('price_latam')
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <p>P.P.M:</p>
                                <input type="text" wire:model='price_mayor' id="precio3"
                                    class="form-control form-control-sm">
                                @error('price_mayor')
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <p>P.V.P:</p>
                                <input type="text" wire:model='price_public' id="precio4"
                                    class="form-control form-control-sm">
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
                                        <select class="my-select" name="" data-width="100%" id="estado"
                                            title="Choose one of the following...">
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
                                        <select class="my-select" name="" id="proveedor" data-width="100%"
                                            title="Choose one of the following...">
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
                                    <input type="file" class="form-control form-control-sm"
                                        id="{{ $identificador }}" wire:model='photo'>
                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group text-center">
                                    @if ($photo)
                                        <div class="text-center">
                                            <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail"
                                                width="150">
                                        </div>
                                    @else
                                        <div wire:loading.remove wire:target='photo' class="alert alert-light"
                                            style="height: 90px;">
                                            <p>View photo</p>
                                        </div>
                                    @endif
                                    <div wire:loading wire:target='photo'
                                        class="alert alert-dark alert-dismissible mb-0" role="alert">
                                        Cargando imagen.......
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p>Categoría:</p>
                                    <div wire:ignore>
                                        <select class="my-select" name="" data-width="100%" id="categoria"
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
                                <div class="form-group">
                                    <p>Stock:</p>
                                    <input type="number" wire:model='stock' class="form-control">
                                    @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <label>Imagenes adicionales</label>
                                <input type="file" class="form-control form-control-sm" wire:model='files'
                                    multiple>
                                @error('files.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                @if ($files)
                                    @foreach ($files as $file)
                                        <img src="{{ $file->temporaryUrl() }}" class="img-thumbnail" width="150">
                                    @endforeach
                                @else
                                    <div wire:loading.remove wire:target='files' class="alert alert-light"
                                        style="height: 90px;">
                                        <p>View photos</p>
                                    </div>
                                @endif
                                <div wire:loading wire:target='files' class="alert alert-dark alert-dismissible mb-0"
                                    role="alert">
                                    Cargando imagenes.......
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div wire:ignore>
                                    <label for="">Descripción avanzada</label>
                                    <div id="paint">
                                        {!! $paint !!}
                                    </div>
                                </div>
                                @error('paint')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#paint').summernote({
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('paint', contents);
                    }
                }
            });
        });
    </script>
    <script>
        $('#precio1, #precio2, #precio3,#precio4').on('input', function() {
            // Remover caracteres no permitidos y sustituir comas por puntos
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/,/g, '.');

            // Limitar a un solo punto decimal
            var countDots = (this.value.match(/\./g) || []).length;
            if (countDots > 1) {
                this.value = this.value.replace(/\./g, '');
            }

            // Limitar a dos decimales
            var decimalIndex = this.value.indexOf('.');
            if (decimalIndex !== -1 && this.value.length - decimalIndex > 3) {
                this.value = this.value.slice(0, decimalIndex + 3);
            }
        });

        $(document).ready(function() {
            $('.my-select').selectpicker();
            $('#categoria').on('change', function(e) {
                @this.set('categoria', e.target.value);
            });
            $('#estado').on('change', function(e) {
                @this.set('estado', e.target.value);
            });
            $('#proveedor').on('change', function(e) {
                @this.set('proveedor', e.target.value);
            });
        });
    </script>
@endpush
