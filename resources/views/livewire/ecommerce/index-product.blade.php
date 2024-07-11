<div>
    <div class="bg-light-subtle shadow rounded px-4">
        <p class="fw-bold fs-4 py-3">LISTADO DE PRODUCTOS</p>
    </div>
    <div class="bg-light-subtle shadow rounded px-4 py-2 mt-2">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" wire:model='search' />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="float-end">
                    <div wire:ignore class="input-group">
                        <select class="my-select" name="" id="categoria_id" data-style="btn-primary"
                            title="Filtrar por categoria">
                            <option value="">TODO</option>
                            @foreach ($categorias as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        @foreach ($productos as $item)
            <div class="col-sm-6 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="position-relative">
                        <a href=""><img src="{{ Storage::url($item->photo) }}" class="card-img-top rounded-0"
                                alt="..."></a>
                        <a href="javascript:void(0)"
                            class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i
                                class="ti ti-basket fs-4"></i></a>
                    </div>
                    <div class="card-body pt-3 p-4">
                        <h6 class="fw-semibold fs-4">{{ $item->name }}</h6>
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="fw-semibold fs-4 mb-0">${{ $item->price_public }}<span
                                    class="ms-2 fw-normal text-muted fs-3"><del>${{ $item->price_china }}</del></span>
                            </h6>
                            <ul class="list-unstyled d-flex align-items-center mb-0">
                                <li><a class="me-1" href="javascript:void(0)"><i
                                            class="ti ti-star text-warning"></i></a>
                                </li>
                                <li><a class="me-1" href="javascript:void(0)"><i
                                            class="ti ti-star text-warning"></i></a>
                                </li>
                                <li><a class="me-1" href="javascript:void(0)"><i
                                            class="ti ti-star text-warning"></i></a>
                                </li>
                                <li><a class="me-1" href="javascript:void(0)"><i
                                            class="ti ti-star text-warning"></i></a>
                                </li>
                                <li><a class="" href="javascript:void(0)"><i
                                            class="ti ti-star text-warning"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-grid gap-2 mt-2">
                            <a href="{{route('ecommerce.productos.show',$item)}}" class="btn btn-danger" type="button">Más información</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-md-6">
                {{ $productos->links() }}
            </div>
            <div class="col-md-6">
                <div class="float-end">
                    Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }}
                    del total de {{ $productos->total() }} registros
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('.my-select').selectpicker();

            $('#categoria_id').on('change', function(e) {
                @this.set('categoria_id', e.target.value);
            });

        });
    </script>
@endpush
