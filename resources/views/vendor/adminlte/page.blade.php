@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    
    <style>
        .slim-alert {
            width: auto;
            /* Ajusta el ancho según tus necesidades */
            padding: 2px;
            /* Ajusta el relleno según tus necesidades */
            margin: 0 auto;
            /* Centra la alerta horizontalmente */
        }
    </style>
    @yield('css')

@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Preloader Animation --}}
        @if ($layoutHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if ($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if (!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if (config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    <script>
        Livewire.on('alert', message => {
            $("#createUser").modal('hide');
            $("#modalEdit").modal('hide');
            $("#createRol").modal('hide');
            $("#createPermiso").modal('hide');
            $("#editPermiso").modal('hide');
            $("#editSistema").modal('hide');
            $("#createSistema").modal('hide');
            $("#create").modal('hide');
            $("#edit").modal('hide');

            iziToast.success({
                title: 'OK',
                position: 'topRight',
                message: message,
            });
        })
        
    </script>
    @yield('js')
@stop
