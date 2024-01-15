<div>
    @include('admin.roles.edit')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 col-md-8 col-lg-8 mt-2">
                <div class="input-group">
                    <input wire:model="search" type="text" class="form-control form-control-sm"
                        placeholder="Buscar rol.">
                </div>
            </div>
            <div class="col-4 col-md-4 col-lg-4 mt-2">
                @livewire('roles.create-role')
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
                                <th>OPTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($roles->count())
                                @foreach ($roles as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td style="width: 100px;">
                                            <div class="btn-group btn-group-sm" role="group"
                                                aria-label="Basic example">
                                                <button class="btn btn-xs btn-default text-primary mx-1 shadow"
                                                    wire:click="edit({{ $item->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#modalEdit"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                                <button class="btn btn-xs btn-default text-danger mx-1 shadow"
                                                    wire:click="$emit('deleteRol',{{ $item->id }})"
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
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        Livewire.on('deleteRol', userId => {
            iziToast.show({
                theme: 'dark',
                icon: 'icon-person',
                title: 'Hey',
                message: 'Estas seguro de eliminar?',
                position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: 'rgb(0, 255, 184)',
                buttons: [
                    ['<button>Ok</button>', function(instance, toast) {
                        Livewire.emitTo('roles.table-roles', 'delete', userId);
                    }, true], // true to focus
                    ['<button>Close</button>', function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function(instance, toast, closedBy) {
                                console.info('closedBy: ' +
                                    closedBy
                                ); // The return will be: 'closedBy: buttonName'
                            }
                        }, toast, 'buttonName');
                    }]
                ],
                onOpening: function(instance, toast) {
                    console.info('callback abriu!');
                },
                onClosing: function(instance, toast, closedBy) {
                    console.info('closedBy: ' +
                        closedBy); // tells if it was closed by 'drag' or 'button'
                }
            });
        });
    </script>
@endpush
@push('css')
@endpush
