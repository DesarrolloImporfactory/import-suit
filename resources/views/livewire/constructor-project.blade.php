<div class="row justify-content-center">
    <div class="col-md-8 ">
        <section class="shadow bg-white rounded">
            <header class="px-4 py-4">
                <h3>Constructor de tienda</h3>
            </header>
            <div class="px-4 py-2">
                <form action="" wire:submit.prevent="form">
                    Nombre: <input type="text" wire:model="subdominio" class="form-control"><br>
                    <button type="submit" class="btn btn-dark">Crear tienda</button>
                </form>
                @if ($paso1 == 'ok')
                    <i class="fa-regular fa-circle-right text-success"></i>
                @else
                    <i class="fa-regular fa-circle-right "></i>
                @endif
                <div wire:loading wire:target='form2'>
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@push('js')
    <script>
        Livewire.on('alert1', function(event) {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
            });
            Livewire.emitTo('constructor-project', 'form2', event);
        })
    </script>
@endpush
