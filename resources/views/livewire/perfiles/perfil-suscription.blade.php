<div>
    @include('admin.perfiles.edit')
    @section('title', 'Suscription')
    <div class="content-header">
        <div class="card">
            <div class="card-header">
                <b>PLANTILLAS DE SUSCRIPCIONES</b>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="d-flex">
                        <div class="mt-2 flex-grow-1">
                            <div class="input-group">
                                <input wire:model="search" type="text" class="form-control "
                                    placeholder="Buscar.........">
                            </div>
                        </div>
                        <div class="mt-2 ml-3">
                            <div wire:ignore class="input-group">
                                <select class="my-select" name="" id="estadoFilter" title="Filtrar por estado">
                                    <option value="">TODOS</option>
                                    <option value="Activa">Activa</option>
                                    <option value="Caducada">Caducada</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 ml-3 ">
                            @include('admin.perfiles.create')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="table-responsive">
                                @include('admin.perfiles.table')
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ $perfiles->links() }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-end">
                                            Mostrando {{ $perfiles->firstItem() }} a {{ $perfiles->lastItem() }}
                                            del total de {{ $perfiles->total() }} registros
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(document).ready(function() {
                $('.my-select2').selectpicker();
                $('.my-select').selectpicker();

                $('#estadoCreate').on('change', function(e) {
                    @this.set('estado', e.target.value);
                });
                $('#estadoFilter').change(function(e) {
                    @this.set('estadoFilter', e.target.value);
                });

            });
            Livewire.on('modal', data => {
                $('#estadoCreate').val("");
                $('#estadoCreate').trigger('change');
                $('#create').modal('show');
            })

            Livewire.on('update', message => {
                iziToast.success({
                    title: 'OK',
                    position: 'topRight',
                    message: 'Perfil agregado',
                });
            })
        </script>
    @stop
</div>
