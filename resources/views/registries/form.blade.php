@extends('template.base')
@section('title'){{isset($registry->id) ? "Registro de Equipamentos: $registry->id"  : 'Novo Registro'}} @endsection
@section('content')
<form action="{{ isset($registry) ? route('registros.atualizar') : route('registros.equipamento.incluir')}}" method="{{ isset($registry) ? 'POST' : 'GET'}}">

    @if(isset($registry->id))
    <input type="hidden" value="{{$registry->id}}" name="id">
    @csrf
    @endif

    <div class="row p-2 border rounded-3 mb-4 shadow-sm">

        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2"> {{isset($registry->id) ? "Registro: $registry->id" : 'Novo Registro'}} </h1>
        </div>

        <div class="col-md-4 text-wrap float-end my-2">

            @if(Route::is('registros.incluir'))
            <div class="d-flex align-items-center float-end">

                <a class="btn btn-outline-danger d-flex align-items-center me-2" href="{{route('registros')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                    </svg>Cancelar</a>

                <button class="btn btn-outline-success d-flex align-items-center" type="submit"> Equipamentos <svg class="bi ms-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#arrow-right-square')}}" />
                    </svg></button>
            </div>
            @else(Route::is('cadastros.cliente.mostrar'))

            <div class="d-flex flex-wrap align-items-center float-end">

                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href="{{url()->previous()}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Voltar</a>
                </div>

                <div class="my-1">
                    <button class="btn btn-outline-success d-flex align-items-center" type="submit"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                        </svg>Gravar</button>
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

    <div class="row justify-content-around p-3 border rounded-3 my-4 shadow-sm">

        <div class="row my-2 border rounded-3 py-4">

            <div class="d-inline-flex align-items-center mb-4">
                <svg class="bi me-3 " width="22px" height="22px" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#person-square')}}" />
                </svg>
                <h2 class="h5 my-0">Cliente:</h2>
            </div>

            <div class="form-group col-lg-6">
                <label for="cliente">Cliente<span class="text-danger"> *</span></label>
                <select name="cliente" id="cliente" class="cliente form-select mb-2" required>
                    <option value=""></option>
                    @if(old('cliente'))
                    <option value="{{old('cliente')}}"></option>
                    @endif
                </select>
            </div>

            <div class="form-group col-lg-4">
                <label for="nome">Nome<span class="text-danger"> *</span></label>
                <input type="text" name="nome" id="nome" class="form-control my-2" placeholder="Quem entregou equipamento(s)." minlength="3" maxlength="40" value="{{old('nome')}}{{session('registry')['nome'] ?? ''}}{{$registry->nome ?? ''}}" required>
            </div>

            <div class="form-group col-lg-2">
                <label for="telefone">Telefone<span class="text-danger my-2"> *</span></label>
                <input type="text" name="telefone" id="telefone" class="form-control my-2" onkeypress="return onlyNumbers(event)" placeholder="Ex: 6133330000" minlength="10" maxlength="11" value="{{old('telefone')}}{{session('registry')['telefone'] ?? ''}}{{$registry->telefone ?? ''}}" required>
            </div>

        </div>

        <div class="row m-0 p-0 justify-content-between">
            <div class="col mx-auto border rounded-3 p-4 my-2">

                <div class="d-inline-flex align-items-center mb-4">
                    <svg class="bi me-3 " width="22px" height="22px" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#calendar-event')}}" />
                    </svg>
                    <h2 class="h5 my-0">Datas:</h2>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="dt_entrada">Data/Hora da entrada<span class="text-danger"> *</span></label>
                        <input type="datetime-local" name="dt_entrada" id="dt_entrada" class="form-control my-2" value="{{old('dt_entrada') ? old('dt_entrada') : substr(str_replace(' ', 'T', now()), 0, -3)}}" readonly required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="dt_previsao">Previsão de entrega</label>
                        <input type="datetime-local" name="dt_previsao" id="dt_previsao" class="form-control my-2"  value="{{old('dt_previsao')}}{{session('registry')['dt_previsao'] ?? ''}}" >
                    </div>
                </div>

            </div>

            <div class="col ms-md-3 border rounded-3 p-4 my-2">

                <div class="d-inline-flex align-items-center mb-4">
                    <svg class="bi me-3 " width="22px" height="22px" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#wrench')}}" />
                    </svg>
                    <h2 class="h5 my-0">Técnico:</h2>
                </div>

                <div class="row">
                    <div class="form-group col-12">
                        <label for="Responsavel">Responsável<span class="text-danger"> *</span></label>
                        <select name="responsavel" id="responsavel" class="responsavel form-select mb-2"  required>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12">
                        <label for="prioridade">Prioridade<span class="text-danger"> *</span></label>
                        <select name="prioridade" id="prioridade" class="form-select my-2" required>
                            <option value="1" >Baixa</option>
                            <option value="2" selected >Média</option>
                            <option value="3" >Alta</option>
                            <option value="4" class="text-danger">Crítica</option>
                        </select>
                    </div>
                </div>

            </div>

        </div>

    </div>

</form>

@endsection

@section('scripts')
@include('registries.scripts')
@endsection