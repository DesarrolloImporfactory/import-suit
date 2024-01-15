<div>
    @include('admin.categoria-proveedor.editProvider')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 col-md-8 col-lg-8 mt-2">
                <div class="input-group">
                    <input wire:model="search" type="text" class="form-control form-control-sm"
                        placeholder="Buscar rol.">
                </div>
            </div>
            <div class="col-4 col-md-4 col-lg-4 mt-2">
                @include('admin.categoria-proveedor.createProvider')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
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
                                <th style="cursor: pointer;" wire:click="order('name')">NAME
                                    @if ($sort == 'name')
                                        @if ($direction == 'desc')
                                            <i class="fa-solid fa-arrow-up-wide-short float-right"></i>
                                        @else
                                            <i class="fa-solid fa-arrow-down-wide-short float-right"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-sort float-right"></i>
                                    @endif
                                </th>
                                <th>DIRECCION</th>
                                <th>EMAIL</th>
                                <th>OPTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($proveedores->count())
                                @foreach ($proveedores as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->direccion }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td style="width: 100px;">
                                            <div class="btn-group btn-group-sm" role="group"
                                                aria-label="Basic example">
                                                <button class="btn btn-xs btn-default text-primary mx-1 shadow"
                                                    wire:click="show({{ $item->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#editSistema"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                                <button class="btn btn-xs btn-default text-danger mx-1 shadow"
                                                    wire:click="$emit('deleteProveedor',{{ $item->id }})"
                                                    type="button"><i class="fa-solid fa-trash"></i></button>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <div class="alert alert-danger">No existe coincidencias...</div>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $proveedores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        Livewire.on('deleteProveedor', codigo => {
            Swal.fire({
                title: 'Esta seguro de eliminar?',
                text: "Puede tener registros asociados!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminalo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('categoria.admin-proveedores','delete',codigo);
                }
            })
        })
    </script>
@endpush
