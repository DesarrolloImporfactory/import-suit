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
            <th style="cursor: pointer;" wire:click="order('usuario_id')">USUARIO
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
            <th>ESTADO</th>
            <th>FECHA INICIO</th>
            <th>FECHA FIN</th>
            <th>DIAS</th>
            <th>OPTION</th>
        </tr>
    </thead>
    <tbody>
        @if ($suscripciones->count())
            @foreach ($suscripciones as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->usuarios->name ?? '' }}</td>
                    <td><span
                            class="badge rounded-pill {{ $item->estado === 'Activa' ? 'text-bg-success' : 'text-bg-danger' }}">
                            {{ $item->estado }}
                        </span></td>
                    <td>{{ $item->fecha_inicio }}</td>
                    <td>{{ $item->fecha_fin }}</td>
                    <td>{{ $item->dias}}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <button class="btn btn-xs btn-default text-success mx-1 shadow"
                                wire:click="show({{ $item->id }})" type="button" data-bs-toggle="modal"
                                data-bs-target="#edit"><i class="fa-regular fa-eye"></i></button>
                            <button class="btn btn-xs btn-default text-danger mx-1 shadow"
                                wire:click="$emit('deleteSus',{{ $item->usuario_id }})" type="button"><i
                                    class="fa-solid fa-trash"></i></button>
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
        Livewire.on('deleteSus', userId => {
            iziToast.show({
                theme: 'dark',
                icon: 'icon-person',
                title: 'Hey',
                message: 'Estas seguro de eliminar?',
                position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: 'rgb(0, 255, 184)',
                buttons: [
                    ['<button>Ok</button>', function(instance, toast) {
                        Livewire.emitTo('suscripcion.user-suscription', 'destroy', userId);
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
        Livewire.on('estado', data => {

            $('#estado').on('change', function(e) {
                @this.set('estado', e.target.value);
            });
            $('#cliente').on('change', function(e) {
                @this.set('cliente', e.target.value);
            });
            function setDropValues() {

                $('#estado').val(data.estado);
                $('#estado').trigger('change');
                $('#cliente').val(data.cliente);
                $('#cliente').trigger('change');
            }

            setDropValues();

        })
    </script>
@endpush
