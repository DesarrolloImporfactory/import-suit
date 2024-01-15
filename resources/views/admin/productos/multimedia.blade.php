<div wire:ignore.self class="modal fade" id="multimedia" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar videos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store" action="">
                <div class="modal-body">
                    <div class="text-center">
                        <!-- Agregar la clase "text-center" al contenedor -->
                        <button wire:loading class="btn btn-light mb-2" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                    <div class="">
                        <p>Archivo subido previamente:</p>
                        @if (count($archivos) > 0)
                            <table class="table table-bordered table-sm text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>ARCHIVO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($archivos as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td><a href="../../storage/{{ $item->archivo }}" download>Descargar archivo
                                                    RAR
                                                </a></td>
                                            <td><button class="btn btn-xs btn-default text-danger mx-1 shadow" wire:click="destroy({{ $item->id }})" type="button"><i
                                                        class="fa-solid fa-trash"></i></button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-primary" role="alert">
                                No existe contenido
                            </div>
                        @endif
                        <hr>
                        <p>Subir video del producto:</p>
                        <input type="hidden" class="form-control" wire:model='idProducto''>
                        <input type="file" class="form-control" wire:model="archivo" accept=".rar">

                    </div>
                    @error('archivo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
@push('js')
    <script></script>
@endpush
