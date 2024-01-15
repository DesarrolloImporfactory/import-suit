<table class="table table-bordered table-striped text-center table-sm">
    <thead class="thead-dark">
        <tr>
            <th style="cursor: pointer;" wire:click="order('id')">ID
                @if ($sort == 'id')
                    @if ($direction == 'desc')
                        <i class="fa-solid fa-arrow-up-wide-short float-right"></i>
                    @else
                        <i class="fa-solid fa-arrow-down-wide-short float-right"></i>
                    @endif
                @else
                    <i class="fa-solid fa-sort float-right"></i>
                @endif
            </th>
            <th style="cursor: pointer;" wire:click="order('usuario_id')">PRODUCTO
                @if ($sort == 'usuario_id')
                    @if ($direction == 'desc')
                        <i class="fa-solid fa-arrow-up-wide-short float-right"></i>
                    @else
                        <i class="fa-solid fa-arrow-down-wide-short float-right"></i>
                    @endif
                @else
                    <i class="fa-solid fa-sort float-right"></i>
                @endif
            </th>
            <th>PROVEEDOR</th>
            <th>CATEGORIA</th>
            <th>ESTADO</th>
            <th>IMAGEN</th>
            <th>STOCK</th>
            <th>P.V.P</th>
            <th>OPTION</th>
        </tr>
    </thead>
    <tbody>
        @if ($productos->count())
            @foreach ($productos as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->proveedores->name }}</td>
                    <td>{{ $item->categorias->name }}</td>
                    <td><span
                            class="badge rounded-pill {{ $item->estado === 'Activo' ? 'text-bg-success' : 'text-bg-danger' }}">
                            {{ $item->estado }}
                        </span></td>
                    <td>
                        <a href="#" class="avatar rounded-circle mr-3" data-toggle="tooltip"
                            data-original-title="{{ $item->name }}">
                            <img alt="foto" src="../../storage/{{ $item->photo }}" class="rounded-circle"
                                width="50" height="50">
                        </a>
                    </td>
                    <td>{{ $item->stock }}</td>
                    <td>${{ $item->price_public }} USD</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a type="button" class="btn btn-xs btn-default text-success mx-1 shadow" href="{{route('products.update',$item)}}"><i class="fa-regular fa-eye"></i></a>
                            <button class="btn btn-xs btn-default text-danger mx-1 shadow"
                                wire:click="$emit('deleteProduct',{{ $item->id }})" type="button"><i
                                    class="fa-solid fa-trash"></i></button>
                            <button class="btn btn-xs btn-default text-danger mx-1 shadow" data-bs-toggle="modal"
                                data-bs-target="#multimedia" wire:click="multimedia({{ $item->id }})"
                                type="button"><i class="fa-solid fa-photo-film"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <div class="alert alert-danger">No existe registros</div>
            </tr>
        @endif
    </tbody>
</table>
@push('js')
    <script>
        Livewire.on('deleteProduct', userId => {
            Swal.fire({
                title: 'Seguro deseas eliminar el producto?',
                text: "No habrá forma de revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('products.admin-products', 'delete', userId);
                }
            })
        });
        Livewire.on('estado', data => {

            $('#estado').on('change', function(e) {
                @this.set('estado', e.target.value);
            });
            $('#tipo').on('change', function(e) {
                @this.set('tipo', e.target.value);
            });
            $('#cliente').on('change', function(e) {
                @this.set('cliente', e.target.value);
            });
            console.log(data);

            function setDropValues() {

                $('#estado').val(data.estado);
                $('#estado').trigger('change');
                $('#tipo').val(data.tipo);
                $('#tipo').trigger('change');
                $('#cliente').val(data.cliente);
                $('#cliente').trigger('change');

            }

            setDropValues();

        })
    </script>
@endpush
