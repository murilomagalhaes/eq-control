@extends('template.base')
@section('title')
@if(isset($equipment))
Edição de Equipamento
@elseif(isset($customer->id))
Registro de Equipamentos
@else
Novo Registro > Equipamento
@endif
@endsection
@section('content')

<style>
    .was-validated .form-select:invalid+.select2 .select2-selection {
        border-color: #dc3545 !important;
    }

    .was-validated .form-select:valid+.select2 .select2-selection {
        border-color: #1e7b34 !important;
    }

    *:focus {
        outline: 0px;
    }
</style>


<form action="{{isset($equipment) ? route('registros.equipamentos.atualizar') : route('registros.gravar')}}" method="POST" id="registry_form" novalidate>
    @csrf

    <div class="row p-2 border rounded-3 mb-4 shadow-sm">

        @if(session('registry_id'))
        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2">Registro: {{session('registry_id')}} > Equipamento </h1>
        </div>

        @elseif(isset($equipment))
        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2">Registro: {{$equipment->registry_id}} > {{$equipment->descricao}} </h1>
        </div>

        @else
        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2">Novo Registro > Equipamento </h1>
        </div>
        @endif


        <div class="col-md-4 text-wrap float-end my-2">

            @if(Route::is('registros.equipamento.incluir'))
            <div class="d-flex align-items-center float-end">

                @if(session('registry_id'))
                <div class="me-2 my-1">
                    <a class="btn btn-outline-danger d-flex align-items-center" href="{{route('registros')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Cancelar</a>
                </div>
                @else
                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href="{{url()->previous()}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Voltar</a>
                </div>
                @endif

                <div class="dropdown">
                    <button class="btn btn-outline-success dropdown-toggle" type="button" id="actions" data-bs-toggle="dropdown" aria-expanded="false">
                        Gravar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="actions">

                        <!--O script submitForm recebe os parametros (stop, e print)
                            O stop para adição de um novo registro, e apenas o grava com seu estado atual.
                            O print é usado para imprimir o comprovante de entrada.                
                            Esses parâmetros são enviados para o back end para validação condicional das ações.                        
                        -->
                        @if(session('registry_id'))
                        <li><a type="submit" class="dropdown-item" href="#" onclick="submitForm(true, false)"><svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                                </svg>Gravar</a></li>
                        @else
                        <li><button type="submit" class="dropdown-item"><svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                                </svg>Gravar</button></li>
                        @endif
                        <li><a class="dropdown-item" href="#" onclick="submitForm(true, true)"><svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#printer')}}" />
                                </svg>Gravar e Imprimir Comprovante</a></li>

                        <li><a class="dropdown-item" href="#" onclick="submitForm(false, false)"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus-square')}}" />
                                </svg>Gravar e Adicionar Outro Equipamento</a></li>
                    </ul>
                </div>


            </div>
            @elseif(isset($equipment))

            <input type="hidden" name="id" id="id" value="{{$equipment->id}}">

            <div class="d-flex flex-wrap align-items-center float-end">

                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href="{{route('registros.mostrar', $equipment->registry_id)}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Voltar</a>
                </div>

                <div class="my-1">
                    <button class="btn btn-outline-primary d-flex align-items-center" type="submit"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
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
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#laptop')}}" />
                </svg>
                <h2 class="h5 my-0">Equipamento:</h2>
            </div>


            <div class="col-lg-5">

                <div class="form-group col-lg-12">
                    <label for="tipo">Tipo<span class="text-danger"> *</span></label>
                    <select name="tipo" id="tipo" class="tipo form-select mb-2" required>
                    </select>
                </div>

                <div class="form-group col-lg-12">
                    <label for="marca">Marca<span class="text-danger"> *</span></label>
                    <select name="marca" id="marca" class="marca form-select mb-2" required>
                    </select>
                </div>


                <div class="form-group col-lg-12">
                    <label for="descricao">Descrição <span class="text-danger"> *</span></label>
                    <input type="text" name="descricao" id="descricao" placeholder="Ex: Computador branco." class="form-control my-2" value="{{old('descricao')}}{{$equipment->descricao ?? ''}}" required>
                </div>

            </div>

            <div class="col-lg-7">
                <div class="form-group col-lg-12">
                    <label for="serie">Num. de Série</label>
                    <input type="text" name="serie" id="serie" class="form-control my-2" value="{{old('serie')}}{{$equipment->num_serie ?? ''}}">
                </div>

                <div class="form-group">
                    <label for="problemas">Problemas Apresentados <span class="text-danger"> *</span></label>
                    <textarea name="problemas" id="problemas" placeholder="Descreva brevemente o motivo da entrega do equipamento." rows="5" class="form-control my-2" required>{{old('problemas')}}{{$equipment->problemas ?? ''}}</textarea>
                </div>


            </div>

        </div>

    </div>



</form>

@endsection

@section('scripts')
@include('registries.equipments.scripts')


@endsection