<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/iziToast/dist/css/iziToast.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="{{ asset('vendor/iziToast/dist/js/iziToast.min.js') }}"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    IMPORSUIT
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <a href="{{ url('/home') }}"
                            class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }} {{ Request::is('home') ? 'active' : '' }}">Home</a>

                        {{-- <a href="https://help.imporfactoryusa.com/" class="nav-item nav-link">Tutoriales</a> --}}
                        <a href="{{ route('redirect.cursos') }}" class="nav-item nav-link">Cursos</a>
                        @can('admin.dashboard')
                            <a href="{{ route('client.products') }}"
                                class="nav-item nav-link {{ Request::is('client/products') ? 'active' : '' }}">Productos</a>
                        @endcan
                        <a href="https://mstr.ly/tutoriales-imporsuit" class="nav-item nav-link">Tutoriales</a>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @can('admin.dashboard')
                                        <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                            Dashboard
                                        </a>
                                    @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        @if (session('mensaje'))
            <script>
                iziToast.warning({
                    title: 'Caution',
                    message: '{{ session('mensaje') }}',
                });
            </script>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    @livewireScripts
    <script>
        $('select').selectpicker();
    </script>
    {{-- <script>
        function simulateServerError() {
            throw new Error('Error occurred 500 Internal Server Error');
        }

        function simulateErrorEveryMinute() {
            try {
                simulateServerError();
            } catch (error) {
                alert('Error occurred: ' + error.message);
                // Puedes agregar aquí código adicional para redirigir a una página de error, por ejemplo:
                // window.location.href = '/error-page.html';
            } finally {
                // Establecer el temporizador para llamar a la función cada minuto (60,000 milisegundos)
                setTimeout(simulateErrorEveryMinute, 120000);
            }
        }

        // Iniciar la simulación del error
        simulateErrorEveryMinute();
    </script> --}}
    @stack('js')
</body>

</html>
