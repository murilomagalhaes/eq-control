<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3">
    <div class="container-fluid">
        <a class="navbar-brand display-6 border-end pe-4 text-primary" href="/">EQ Control</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{Route::is('dashboard') ? 'active' : ''}}" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{strpos(Request::path(), 'cadastros') !== false ? 'active' : ''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cadastros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="mb-2">
                            <span class="m-3 fw-bold">Pessoas:</span>
                        </li>
                        <li><a class="dropdown-item {{strpos(Request::path(), '/cliente') ? 'active' : ''}}" href="{{route('cadastros.cliente')}}">Cliente</a></li>
                        <li><a class="dropdown-item {{strpos(Request::path(), '/usuario') ? 'active' : ''}}" href="{{route('cadastros.usuario')}}">Usuário</a></li>
                        <li class="mb-2">
                            <hr class="dropdown-divider"> <span class="m-3 fw-bold">Equipamentos:</span>
                        </li>
                        <li><a class="dropdown-item {{strpos(Request::path(), '/marca') ? 'active' : ''}}" href="{{route('cadastros.marca')}}">Marca</a></li>
                        <li><a class="dropdown-item {{strpos(Request::path(), '/tipo') ? 'active' : ''}}" href="{{route('cadastros.tipo')}}">Tipo</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{strpos(Request::path(), 'registros') !== false ? 'active' : ''}}" aria-current="page" href="{{route('registros')}}">Registros</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{Route::is('relatorios') ? 'active' : ''}}" aria-current="page" href="#" onclick="alert('Em desenvolvimento')">Relatórios</a>
                </li>
            </ul>

            <li class="navbar-nav mb-2 mb-lg-0 dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center text-primary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg class="bi me-2" width="24" height="24" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#person-circle')}}" />
                    </svg> {{auth()->user()->nome}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item text-decoration-none me-2" href="{{route('cadastros.usuario.buscar')}}/?q={{auth()->user()->nome}}">Cadastro</a></li>
                    <li>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="dropdown-item link-danger text-decoration-none me-2" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>



        </div>
    </div>
</nav>