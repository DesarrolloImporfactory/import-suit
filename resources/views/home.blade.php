@extends('layouts.app')

@section('content')
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="row">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="mb-2 text-center">
                        <h3><span class="m-1 letter-spacing fw-semibold"> MIS HERRAMIENTAS</span></h3>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class=" rounded-3 mt-2">
                            <div class="container-fluid d-flex align-items-center justify-content-center">
                                <div class="row text-center">
                                    @can("infoaduana.view")
                                    <img style="width: 315px;" src="{{ asset('iconos/1.png') }}" alt="logo4">
                                    <a type="button" href="{{ route('redirect.infoaduana') }}" class="btn">
                                        <span class="m-1 letter-spacing" style="white-space: nowrap;">INFOADUANA <i
                                                class="fa fa-arrow-right ms-1"></i></span>
                                    </a>
                                    @else
                                    <img style="width: 315px; filter: grayscale(100%);" src="{{ asset('iconos/1.png') }}" alt="logo4">

                                    <a type="button" href="#" class="btn">
                                        <span class="m-1 letter-spacing"
                                            style="white-space: nowrap;">No disponible</span>
                                    </a>
                                @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class=" rounded-3 mt-2 ">
                            <div class="container-fluid d-flex align-items-center justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="row text-center">
                                        @can("cotizador.view")
                                        <img style="width: 315px;" src="{{ asset('iconos/2.png') }}" alt="logo4">
                                        <a type="button" href="{{ route('redirect.app.create') }}" class="btn">
                                            <span class="m-1 letter-spacing" style="white-space: nowrap;">COTIZADOR <i
                                                    class="fa fa-arrow-right ms-1"></i></span>
                                        </a>
                                        @else
                                        <img style="width: 315px; filter: grayscale(100%);" src="{{ asset('iconos/2.png') }}" alt="logo4">

                                            <a type="button" href="#" class="btn">
                                                <span class="m-1 letter-spacing"
                                                    style="white-space: nowrap;">No disponible</span>
                                            </a>
                                        @endcan

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class=" rounded-3 mt-2 ">
                            <div class="container-fluid d-flex align-items-center justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="row text-center">
                                        <img style="width: 315px;" src="{{ asset('iconos/6.png') }}" alt="logo4">
                                        @can('tienda.view')
                                            <a type="button" href="{{auth()->user()->url}}" target="_blank" class="btn">
                                                <span class="m-1 letter-spacing" style="white-space: nowrap;">TIENDA <i
                                                        class="fa fa-arrow-right ms-1"></i></span>
                                            </a>
                                            {{-- <a type="button" href="http://108.181.168.234/importshop/" class="btn">
                                                <span class="m-1 letter-spacing" style="white-space: nowrap;">TIENDA <i
                                                        class="fa fa-arrow-right ms-1"></i></span>
                                            </a> --}}
                                        @else
                                            <a type="button" href="#" class="btn">
                                                <span class="m-1 letter-spacing"
                                                    style="white-space: nowrap;">PROXIMAMENTE</span>
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class=" rounded-3 mt-2">
                            <div class="container-fluid d-flex align-items-center justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="row text-center">
                                        @can("proveedor.view")
                                        <img style="width: 315px;" src="{{ asset('iconos/5.png') }}" alt="logo4">
                                        <a type="button" href="https://marketplace.imporsuit.com/proveedores_imporsuit.php"
                                            class="btn" disabled>
                                            <span class="m-1 letter-spacing" style="white-space: nowrap;">PROVEEDORES <i
                                                    class="fa fa-arrow-right ms-1"></i></span>
                                        </a>
                                        @else
                                        <img style="width: 315px; filter: grayscale(100%);  " src="{{ asset('iconos/5.png') }}" alt="logo4">
                                        <a type="button" href="#" class="btn">
                                            <span class="m-1 letter-spacing"
                                                style="white-space: nowrap;">No disponible</span>
                                        </a>
                                    @endcan

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class=" rounded-3 mt-2">
                            <div class="container-fluid d-flex align-items-center justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="row text-center">
                                        <img style="width: 315px;" src="{{ asset('iconos/7.png') }}" alt="logo4">
                                        @can('factura.view')
                                            <a type="button" href="{{auth()->user()->url.'/sysadmin/login.php'}}" target="_blank" class="btn"
                                                disabled>
                                                <span class="m-1 letter-spacing" style="">CONSTRUCTOR <i
                                                        class="fa fa-arrow-right ms-1"></i></span>
                                            </a>
                                            {{-- <a type="button" href="http://108.181.168.234/importshop/sysadmin" class="btn"
                                                disabled>
                                                <span class="m-1 letter-spacing" style="">FACTURACIÓN ELECTRONICA <i
                                                        class="fa fa-arrow-right ms-1"></i></span>
                                            </a> --}}
                                        @else
                                            <a type="button" href="#" class="btn" disabled>
                                                <span class="m-1 letter-spacing" style="">PROXIMAMENTE</span>
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {{auth()->user()}} --}}
                    <div class="col-12 col-md-4 col-lg-4">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 pt-5 mt-4">
                <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
                    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="w-100" src="{{ asset('carrusel/cotizador.jpg') }}" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100" src="{{ asset('carrusel/facturacion.jpg') }}" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100" src="{{ asset('carrusel/imporlab.jpg') }}" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100" src="{{ asset('carrusel/infoaduana.jpg') }}" alt="Image">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @if ($suscripcion != '0')
        <div class="alert alert-success">
            <span>Le quedan {{ $suscripcion->dias }} días para que su suscripción termine.</span>
        </div>
    @endif
    </div>
    
    <style>
        .letter-spacing {
            letter-spacing: 0.05em;
        }
    </style>
@endsection
