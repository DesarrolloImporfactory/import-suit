<div>
    <div class="bg-light-subtle shadow rounded px-4">
        <p class="fw-bold fs-4 py-3"><a href="{{ route('ecommerce.productos.index') }}"><i
                    class="fa-solid fa-caret-left fa-lg"></i></a> DETALLES DEL
            PRODUCTO</p>
    </div>
    <section class="bg-light-subtle shadow rounded">
        <div class="px-4 py-3">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-3">
                            <div class="scroll-container" style="max-height: 300px; overflow-y: auto;">
                                <img src="{{ Storage::url($producto->photo) }}" onclick="myFunction(this)"
                                    class="mt-2 rounded img-fluid custom-cursor" alt="..." width="500">
                                @foreach ($producto->images as $item)
                                    <img src="{{ Storage::url($item->photo) }}" onclick="myFunction(this)"
                                        class="card-img-top rounded mb-2 custom-cursor" alt="...">
                                @endforeach
                            </div>
                        </div>
                        <div class="col-9">
                            <img src="{{ Storage::url($producto->photo) }}" id="imageBox"
                                class="mt-2 rounded img-fluid" alt="..." width="500">
                        </div>

                    </div>
                </div>
                <div class="col-md-5">
                    <h3>{{ $producto->name }}</h3>
                    <p class="fs-3 mt-4"><i class="fa-solid fa-bars"></i> Categoria: {{ $producto->categorias->name }}
                    </p>
                    <p class="fs-3"><i class="fa-solid fa-globe"></i> Enlace: {{ $producto->enlace }}</p>
                    <p class="fs-3"><i class="fa-solid fa-arrow-trend-up"></i> Stock: <i
                            class="{{ $producto->enlace == '0' ? 'fa-solid fa-circle-exclamation text-danger' : 'fa-solid fa-circle-check text-success' }}"></i>
                    </p>
                    <p class="fs-3"><i class="fa-solid fa-coins"></i> P.V.P: ${{ $producto->price_public }} USD</p>
                    <div class="mt-3 px-3 text-center">
                        @if ($favoritos->where('product_id', $producto->id)->count())
                            <button class="btn btn-outline-success"><i
                                    class="fa-solid fa-heart-circle-check text-success"></i> Agregado a mis
                                favoritos</button>
                        @else
                            <button class="btn btn-danger" wire:click='favorito({{ $producto }})'><i
                                    class="fa-regular fa-heart"></i> Mis favoritos</button>
                        @endif
                        <button class="btn btn-primary"><i class="fa-solid fa-shop"></i> Agregar a mi tienda</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-md-4">
            <h4 class="mt-4">Descripción del producto:</h4>
            <div class="bg-light-subtle shadow rounded ">
                @if ($producto->description)
                    <p class="text-justify px-4 py-3">{{ $producto->description }}</p>
                @else
                    <p class="text-justify px-4 py-3">Descripción pendiente.</p>
                @endif
            </div>
            <h4 class="mt-4">Precios del producto:</h4>
            <div class="bg-light-subtle shadow rounded px-4 mt-2">
                <ul class="list-unstyled px-2 py-3">
                    <li class="mb-2"><i class="fas fa-circle mr-2 text-success"></i> Precio en china:
                        ${{ $producto->price_china }} USD</li>
                    <li class="mb-2"><i class="fas fa-circle mr-2 text-success"></i> Precio en latam:
                        ${{ $producto->price_latam }} USD</li>
                    <li class="mb-2"><i class="fas fa-circle mr-2 text-success"></i> Precio al por mayor:
                        ${{ $producto->price_mayor }} USD</li>
                    <li class="mb-2"><i class="fas fa-circle mr-2 text-success"></i> Precio venta al público:
                        ${{ $producto->price_public }} USD</li>
                </ul>

            </div>
            <h4 class="mt-4">Proveedor:</h4>
            <div class="bg-light-subtle shadow rounded px-4 mt-2">
                <div class=" py-3">
                    <p class="text-justify text-primary">{{ $producto->proveedores->name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="bg-light-subtle shadow rounded mt-4">
                <div class="px-3 py-4 overflow-auto">
                    {!! $contenido !!}
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-cursor {
            cursor: pointer;
        }
    </style>
</div>
@push('js')
    <script>
        function myFunction(smallImg) {
            var fulImg = document.getElementById('imageBox');
            fulImg.src = smallImg.src;
        }
    </script>
@endpush
