@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Str;
@endphp

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
                                @can("acceso-sistema",3)
                                <img style="width: 315px;" src="{{ asset('iconos/1.png') }}" alt="logo4">
                                <a type="button" target="_blank" href="{{ route('redirect.infoaduana') }}" class="btn">
                                    <span class="m-1 letter-spacing" style="white-space: nowrap;">INFOADUANA <i
                                            class="fa fa-arrow-right ms-1"></i></span>
                                </a>
                                @else
                                <img style="width: 315px; filter: grayscale(100%);" src="{{ asset('iconos/1.png') }}"
                                    alt="logo4">

                                <a type="button" href="#" class="btn">
                                    <span class="m-1 letter-spacing" style="white-space: nowrap;">NO DISPONIBLE</span>
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
                                    @can("acceso-sistema",1)
                                    <img style="width: 315px;" src="{{ asset('iconos/2.png') }}" alt="logo4">
                                    <a type="button" target="_blank" href="{{ route('redirect.app.create') }}" class="btn">
                                        <span class="m-1 letter-spacing" style="white-space: nowrap;">COTIZADOR <i
                                                class="fa fa-arrow-right ms-1"></i></span>
                                    </a>
                                    @else
                                    <img style="width: 315px; filter: grayscale(100%);"
                                        src="{{ asset('iconos/2.png') }}" alt="logo4">

                                    <a type="button" href="#" class="btn">
                                        <span class="m-1 letter-spacing" style="white-space: nowrap;">NO
                                            DISPONIBLE</span>
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
                                    @can("acceso-sistema",10)
                                    <img style="width: 315px;" src="{{ asset('iconos/6.png') }}" alt="logo4">
                                    <a type="button" href="https://new.imporsuitpro.com" target="_blank" class="btn">
                                        <span class="m-1 letter-spacing" style="white-space: nowrap;">TIENDA <i
                                                class="fa fa-arrow-right ms-1"></i></span>
                                    </a>
                                    {{-- <a type="button" href="http://108.181.168.234/importshop/" class="btn">
                                                <span class="m-1 letter-spacing" style="white-space: nowrap;">TIENDA <i
                                                        class="fa fa-arrow-right ms-1"></i></span>
                                            </a> --}}

                                    @else
                                    <img style="width: 315px;  filter: grayscale(100%);"
                                        src="{{ asset('iconos/6.png') }}" alt="logo4">

                                    <a type="button" href="#" class="btn">
                                        <span class="m-1 letter-spacing" style="white-space: nowrap;">NO
                                            DISPONIBLE</span>
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
                                    @can("acceso-sistema",9)
                                    <img style="width: 315px;" src="{{ asset('iconos/5.png') }}" alt="logo4">
                                    <a type="button" target="_blank" href="https://proveedores.imporsuitpro.com/"
                                        class="btn" disabled>
                                        <span class="m-1 letter-spacing" style="white-space: nowrap;">PROVEEDORES <i
                                                class="fa fa-arrow-right ms-1"></i></span>
                                    </a>
                                    @else
                                    <img style="width: 315px; filter: grayscale(100%);  "
                                        src="{{ asset('iconos/5.png') }}" alt="logo4">
                                    <a type="button" href="#" class="btn">
                                        <span class="m-1 letter-spacing" style="white-space: nowrap;">NO
                                            DISPONIBLE</span>
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

                                    @if(auth()->user()->url)
                                    <img style="width: 315px;" src="{{ asset('iconos/7.png') }}" alt="logo4">
                                    @php
                                    $userUrl = auth()->user()->url;
                                    $finalUrl = Str::contains($userUrl, 'registro.imporsuit') ? $userUrl : $userUrl;
                                    @endphp
                                    <a type="button" href="https://new.imporsuitpro.com" target="_blank" class="btn">
                                        <!-- Tu texto o ícono aquí -->
                                        <span class="m-1 letter-spacing" style="">CONSTRUCTOR <i
                                                class="fa fa-arrow-right ms-1"></i></span>
                                    </a>
                                    @else
                                    <img style="width: 315px; filter: grayscale(100%);  "
                                        src="{{ asset('iconos/7.png') }}" alt="logo4">
                                    <a type="button" href="#" class="btn">
                                        <span class="m-1 letter
                                                -spacing" style="white-space: nowrap;">NO DISPONIBLE</span>
                                    </a>

                                    @endif
                                    {{-- <a type="button" href="http://108.181.168.234/importshop/sysadmin" class="btn"
                                                disabled>
                                                <span class="m-1 letter-spacing" style="">FACTURACIÓN ELECTRONICA <i
                                                        class="fa fa-arrow-right ms-1"></i></span>
                                            </a> --}}

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
    @if ($suscripcion != '0' && $suscripcion->dias > 0)
    <div class="alert alert-success">
        {{ $suscripcion->nombre }}
        <span>Le quedan {{ $suscripcion->dias }} días para que su suscripción termine.</span>
    </div>
    @endif
    @if($suscripcion != '0' && $suscripcion->dias <= 0) <div class="alert alert-danger ">
        <span>¿Observa que algunas herramientas aparecen en gris y están marcadas como 'no disponibles'?
            <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
                data-bs-target="#subscriptionExpiredModal">Averiguar ¿Por qué?</button>
        </span>
</div>

@endif
</div>
<!-- Modal -->
<div class="modal fade" id="subscriptionExpiredModal" tabindex="-1" aria-labelledby="subscriptionExpiredModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-body">
                <h5 class="modal-title text-center fw-bold" id="subscriptionExpiredModalLabel">Suscripción Caducada</h5>
                <hr>
                <span class="">
                    Estimado usuario, <br>

                    Hemos notado que su suscripción a nuestros servicios ha llegado a su término. <br>

                    Durante el período de su suscripción, esperamos que haya disfrutado de las ventajas y beneficios
                    exclusivos que ofrecemos. Su acceso a herramientas premium, contenido especializado y soporte
                    prioritario ha sido suspendido temporalmente debido a la caducidad de su suscripción. <br>

                    En ImporFactory, estamos comprometidos a ofrecer la mejor experiencia y valor a nuestros
                    suscriptores. Renovar su suscripción no solo le permitirá recuperar el acceso inmediato a todas las
                    herramientas y servicios que ha estado disfrutando, sino que también asegurará que continúe
                    recibiendo las últimas actualizaciones, mejoras de seguridad y soporte exclusivo que vienen con su
                    membresía. <br>

                    Le invitamos cordialmente a renovar su suscripción para restablecer su acceso completo y continuar
                    beneficiándose de las características y servicios exclusivos que ofrecemos. Si tiene alguna pregunta
                    o necesita asistencia adicional con el proceso de renovación, no dude en contactarnos. <br>

                    Apreciamos su comprensión y esperamos continuar teniéndolo como parte de nuestra comunidad.
                </span>

            </div>
            <a href="https://wa.link/11dgle" class="btn btn-primary" target="_blank">Renovar Ahora</a>

        </div>
    </div>
</div>

<style>
.letter-spacing {
    letter-spacing: 0.05em;
}
</style>
@endsection