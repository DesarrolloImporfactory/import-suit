<div class="navbar-collapse justify-content-end px-0" id="navbarNav">
    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" data-bs-toggle="dropdown" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <p class="fs-3 mr-2">{{ $favoritos->count() }}</p>
            </a>
            <div class="dropdown-menu p-4 dropdown-menu-center dropdown-menu-lg dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="message-body">
                    @foreach ($favoritos as $item)
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <img src="{{ Storage::url($item->productos->photo) }}" alt="" width="50" height="50" class="rounded-circle">
                            <p class="mb-0 fs-4 ml-3">{{ $item->productos->name }}</p>
                        </a>
                    @endforeach
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Listado favoritos</a>
                </div>
            </div>
        </li>
    </ul>
</div>

