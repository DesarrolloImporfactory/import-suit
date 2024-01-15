<nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow copyright fadeIn p-3 fixed-top" data-wow-delay="0.1s">
    <a href="https://imporsuit.com/" class="navbar-brand ms-4 ms-lg-0">
        <div class="d-flex justify-content-center">
            <img style="height: 60px;" src="{{ asset('logos/logo-imporsuit.png') }}" alt="logo4">
        </div>
    </a>
    {{-- <h1 class="display-5 text-primary m-2">IMPOR</h1>
            <h1 class="display-7 mt-3  m-2">SUIT</h1> --}}
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/home') }}" class="nav-item nav-link {{Request::is('/') ? 'active':''}} {{Request::is('home') ? 'active':''}}">Home</a>
            
            {{-- <a href="https://help.imporfactoryusa.com/" class="nav-item nav-link">Tutoriales</a> --}}
            <a href="{{ route('redirect.cursos') }}" class="nav-item nav-link">Cursos</a>
            <a href="{{ route('client.products') }}" class="nav-item nav-link {{Request::is('client/products') ? 'active':''}}">Productos</a>
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('login') ? 'active':''}}" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('register') ? 'active':''}}" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown dropdown-center">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-dark border-light m-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @can('admin.dashboard')
                        <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                            Dashboard
                        </a>
                        @endcan
                    </div>
                </li>
            @endguest
        </div>

    </div>
</nav>
