@extends('template.base')
@section('title') {{isset($user->id) ? 'Cadastro de Usuarios' : 'Novo Usuario'}} @endsection
@section('content')
<form action="{{route('cadastros.usuario.gravar')}}" method="POST" id="customer_form">
    @csrf

    @if(isset($user->id))
    <input type="hidden" value="{{$user->id}}" name="id">
    @endif

    <div class="row p-2 border rounded-3 mb-4 shadow-sm bg-light">

        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2"> {{isset($user->id) ? $user->nome : 'Novo usuario'}} </h1>
        </div>

        <div class="col-md-4 text-wrap float-end my-2">

            @if(Route::is('cadastros.usuario.incluir'))
            <div class="d-flex align-items-center float-end">

                <a class="btn btn-outline-danger d-flex align-items-center me-2" href="{{route('cadastros.usuario')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                    </svg>Cancelar</a>

                <button class="btn btn-outline-success d-flex align-items-center" type="submit"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                    </svg>Gravar</button>

            </div>
            @else(Route::is('cadastros.usuario.mostrar'))

            <div class="d-flex flex-wrap align-items-center float-end">

                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href="{{route('cadastros.usuario')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Voltar</a>
                </div>

                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Ações
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <div id="save-edit-div">
                                <button class="dropdown-item d-flex align-items-center" type="button" id="edit-btn" onclick="enableInputs()">
                                    <svg class="bi me-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#pencil-square')}}" />
                                    </svg>Editar</button>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" onclick="destroy()"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#eraser')}}" />
                                </svg>Deletar</a>
                        </li>
                    </ul>
                </div>

            </div>
            @endif

        </div>

    </div>

    @if($errors->any())
    <div class="row my-4">
        <div class="alert alert-danger shadow-sm">
            <ul class="m-auto p-auto">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="row justify-content-around">

        <div class="row mb-2">
            <div class="form-group col-lg-4">
                <label for="nome">Nome <span class="text-danger">*</span></label>
                <input type="text" name="nome" id="nome" class="form-control my-2" minlength="4" maxlength="60" value="{{old('nome')}}{{isset($user->nome) && !old('nome') ? $user->nome : ''}}" placeholder="Nome completo" required>
            </div>

            <div class="form-group col-lg-3">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control my-2" onkeypress="return onlyNumbers(event)" minlength="11" maxlength="11" value="{{old('cpf')}}{{isset($user->cpf) && !old('cpf') ? $user->cpf : ''}}">
            </div>

            <div class="form-group col-lg-5">
                <label for="email">Email </label>
                <input type="email" name="email" id="email" class="form-control my-2" placeholder="" value="{{old('email')}}{{isset($user->email) && !old('email') ? $user->email : ''}}">
            </div>
        </div>

        <div class="row mb-2">

            <div class="form-group col-lg-2">
                <label for="telefone">Telefone </label>
                <input type="text" name="telefone" id="telefone" class="form-control my-2" onkeypress="return onlyNumbers(event)" placeholder="Ex: 6133330000" minlength="10" maxlength="11" value="{{old('telefone')}}{{isset($user->telefone) && !old('telefone') ? $user->telefone : ''}}">
            </div>

            <div class="form-group col-lg-4">
                <label for="login">Nome de login <span class="text-danger">*</span></label>
                <input type="text" name="login" id="login" class="form-control my-2" maxlength="30" value="{{old('login')}}{{isset($user->login) && !old('login') ? $user->login : ''}}" placeholder="Nome utilizado para acessar o sistema">
            </div>

            <div class="form-group col-lg-3">
                <label for="email">Senha <span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" class="form-control my-2" placeholder="">
            </div>

            <div class="form-group col-lg-3">
                <label for="password_confirmation">Confirmação de Senha <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control my-2" placeholder="">
            </div>
        </div>

        <div class="row px-4 my-2">
            <div class="form-check">
                @if(isset($user->ativo) && $user->ativo == false)
                <input class="form-check-input" value="1" type="checkbox" id="ativo" name="ativo">
                @else
                <input class="form-check-input" value="1" type="checkbox" id="ativo" name="ativo" checked>
                @endif
                <label class="form-check-label" for="ativo">
                    Cadastro ativo
                </label>
            </div>
        </div>

        <hr class="my-4">

        <div class="d-flex align-items-center">
            <svg class="bi me-2" width="20" height="20" fill="currentColor">
                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#info-circle')}}" />
            </svg>
            <i> Deixe os campos de senha em banco caso não queira altera-la durante a edição do cadastro. </i>
        </div>


        <div class="d-flex align-items-center my-2">
            <svg class="bi me-2" width="20" height="20" fill="currentColor">
                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#info-circle')}}" />
            </svg>
            <i> Cadastros inativos não poderão ser utilizados no registro de entrada de equipamentos. </i>
        </div>
    </div>

</form>

@if(isset($user))
<form action="{{route('cadastros.usuario.deletar')}}" method="POST" id="delete_form">
    @csrf
    <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
</form>
@endif

@endsection

@section('scripts')
@include('users.scripts')
@endsection