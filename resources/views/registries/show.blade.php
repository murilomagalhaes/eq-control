@extends('template.base')
@section('title') Registro: {{$registry->id}}@endsection

@section('content')

<div class="row p-2 border rounded-3 mb-4 shadow-sm">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="h4 my-3 me-3"> Registro: {{$registry->id}} </h1>

            <div class="d-flex">
                <a class="btn btn-outline-secondary d-flex me-2 align-items-center" href="{{url()->previous()}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                    </svg> Voltar </a>

                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Ações
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Editar</a></li>
                        <li><a class="dropdown-item" target="_blank" href="{{route('imprimir', $registry)}}">Imprimir</a></li>
                        <li><a class="dropdown-item" href="#">Imprimir</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row d-flex justify-contents-around align-items-center">

    <div class="col-lg-4">
        <div class="border rounded-3 my-2 p-3 shadow-sm">
            <div class="d-inline-flex align-items-center mb-2">
                <svg class="bi me-3 " width="22px" height="22px" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#person-square')}}" />
                </svg>
                <h2 class="h5 my-0">Cliente</h2>
            </div>
            <div class="p-2">
                <div class="d-flex justify-content-between"> <span class="fw-bold"> Cliente: </span> {{$registry->customer->nome}}</div>
                <div class="d-flex justify-content-between"> <span class="fw-bold"> Nome: </span> {{$registry->nome}}</div>
                <div class="d-flex justify-content-between"> <span class="fw-bold"> Telefone: </span> {{$registry->telefone}}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="border rounded-3 my-2 p-3 shadow-sm">
            <div class="d-inline-flex align-items-center mb-2">
                <svg class="bi me-3 " width="22px" height="22px" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#calendar-event')}}" />
                </svg>
                <h2 class="h5 my-0">Datas</h2>
            </div>
            <div class="p-2">
                <div class="d-flex justify-content-between"> <span class="fw-bold"> Entrada: </span> {{$registry->getFormatedDateTime('dt_entrada')}}</div>
                <div class="d-flex justify-content-between"> <span class="fw-bold"> Previsão: </span> {{$registry->getFormatedDateTime('dt_previsao')}}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="border rounded-3 my-2 p-3 shadow-sm">
            <div class="d-inline-flex align-items-center mb-2">
                <svg class="bi me-3 " width="22px" height="22px" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#wrench')}}" />
                </svg>
                <h2 class="h5 my-0">Técnico</h2>
            </div>

            <div class="p-2">
                <div class="d-flex justify-content-between"> <span class="fw-bold"> Responsável: </span> {{$registry->responsavel->nome}}</div>
                <div class="d-flex justify-content-between"> <span class="fw-bold"> Prioridade: </span>

                    @if($registry->prioridade == 1)
                    <span class="text-primary">Baixa</span>
                    @endif

                    @if($registry->prioridade == 2)
                    <span class="text-secondary">Média</span>
                    @endif

                    @if($registry->prioridade == 3)
                    <span class="fw-bold text-warning">Alta</span>
                    @endif

                    @if($registry->prioridade == 4)
                    <span class="fw-bold text-danger">Crítica</span>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<hr>

@foreach($registry->equipments as $i => $equipment)
<div class="row p-0 m-0">

    <div class="col-12 border rounded-3 my-2 m-auto p-3 shadow-sm">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-inline-flex align-items-center">
                <svg class="bi me-3 " width="22px" height="22px" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#laptop')}}" />
                </svg>
                <h2 class="h5 my-0">Equipamento {{$i + 1}}: <span class="text-primary">{{$equipment->descricao}}</span></h2>
            </div>

            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Ações
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Editar</a></li>
                    <li><a class="dropdown-item" href="#">Apagar</a></li>
                    <li><a class="dropdown-item" href="#">Imprimir</a></li>
                </ul>
            </div>
        </div>

        <div class="p-2">
            <div> <span class="fw-bold"> Tipo: </span>{{$equipment->type->nome}}</div>
            <div> <span class="fw-bold"> Marca: </span> {{$equipment->brand->nome}}</div>
            <div> <span class="fw-bold"> Num. de Série: </span> {{$equipment->num_serie}}</div>
            <hr>
            <span class="fw-bold"> Probleamas: </span>
            <div> {{$equipment->problemas}}</div>
        </div>

    </div>
</div>
@endforeach





@endsection