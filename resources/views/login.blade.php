@extends('template.base')

@section('login')

<div class="row m-auto w-100 position-absolute top-50 start-50 translate-middle">
    <div class="col-lg-4 border-end p-4 d-flex justify-content-center align-items-center">
        <div class="display-6 text-primary text-center">
            <div class="m-auto"> EQ <strong>Control</strong></div>

            <div>
                <svg class="bi" width="40" height="40" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#laptop')}}" />
                </svg>
            </div>
        </div>



    </div>
    <div class="col-lg-8 p-4 m-auto">

        <form action="{{route('authenticate')}}" class="w-75 m-auto" method="POST">
            @csrf
            <div class="form-group m-auto">

                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert-danger my-4 p-3 rounded-3 d-flex align-items-center shadow-sm">
                    <svg class="bi me-2" width="24" height="24" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#exclamation-triangle')}}" />
                    </svg>
                    {{ $error }}
                </div>
                @endforeach
                @endif

                <div class="form-group my-4">
                    <label for="login" class="mb-1">Usuário/E-mail</label>
                    <input type="text" class="form-control shadow" id="login" name="login" value="{{old('login')}}" required>
                </div>

                <div class="form-group my-4">
                    <label for="senha" class="mb-1">Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control me-4 shadow" id="senha" name="senha" required>
                        <button type="submit" class="btn btn-outline-primary shadow"> Entrar </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection