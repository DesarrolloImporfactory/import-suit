<div wire:ignore.self class="modal fade" id="showProducto" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $name }}/ <span
                        class="text-danger">{{ $categoria }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="ml-3 col-md-12">
                        <h5>Proveedor: <a href="{{ $enlace }}">{{ $proveedor }}</a></h5>
                        <hr>
                        <span>Precio en china: ${{ $price_china }} USD</span>
                        <hr>
                        <span>Precio en Latam: ${{ $price_latam }} USD</span>
                        <hr>
                        <span>Precio al por mayor: ${{ $price_mayor }} USD</span>
                        <hr>
                        <span>Precio al publico: ${{ $price_public }} USD</span>
                        <hr>
                        <div class="text-center">
                            <video controls>
                                <source src="https://www.youtube.com/watch?v=IRtJ86mnSdk" type="video/mp4">
                                Tu navegador no admite la reproducción de videos.
                            </video>

                        </div>
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="position-relative bg-light overflow-hidden" style="height: 200px;">
                            <img class="img-fluid w-100" src="../../storage/{{ $imagen }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <i class="fa-solid fa-bars"> DESCRIPCIÓN:</i>
                        <p class="text-justify">{{ $description }}</p>
                        @if (count($archivos) > 0)
                            <table class="table table-bordered table-sm text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>ARCHIVO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($archivos as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td><a href="../../storage/{{ $item->archivo }}" download>Descargar archivo
                                                    RAR
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-primary" role="alert">
                                No existe archivos
                            </div>
                        @endif
                        <button class="btn btn-light float-left mt-4 btn-sm">CODIGO DE PRODUCTO:
                            {{ $codigo }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
