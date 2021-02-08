@section('title') Dashboard @endsection
@extends('template.base')
@section('content')

@if(session('success'))
<div class="row">
    <div class="alert-success my-4 p-3 rounded-3 d-flex align-items-center">
        <svg class="bi me-2" width="24" height="24" fill="currentColor">
            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#emoji-laughing')}}" />
        </svg>
        {{ session('success') }}
    </div>
</div>
@endif

<div class="row shadow p-4 border rounded-3 mb-4 bg-light">

    <div class="fw-light fs-4 my-2">

        <div class="d-flex align-items-center">
            <svg class="bi me-2" width="24" height="24" fill="currentColor">
                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#bookmark')}}" />
            </svg>
            <div> Ações rápidas:</div>
        </div>

        <hr>
    </div>

    <div class="col-lg-3">
        <a class="btn btn-outline-primary w-100 m-2 p-2" href="{{route('registros.incluir')}}" title="Registrar entrada de equipamentos">
            <div class="d-flex justify-content-center align-items-center">
                <svg class="bi me-2" width="24" height="24" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#clipboard-plus')}}" />
                </svg> Entrada de Equip.
            </div>
        </a>
    </div>

    <div class="col-lg-3">
        <a class="btn btn-outline-dark w-100 m-2 p-2" href="{{route('cadastros.tipo.incluir')}}" title="Adicionar novo tipo de equipamento" >
            <div class="d-flex justify-content-center align-items-center">
                <svg class="bi me-2" width="24" height="24" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus')}}" />
                </svg> <span> Tipo de Equip. </span>
            </div>
        </a>
    </div>

    <div class="col-lg-3">
        <a class="btn btn-outline-dark w-100 m-2 p-2" href="{{route('cadastros.marca.incluir')}}" title="Adicionar nova marca de equipamento">
            <div class="d-flex justify-content-center align-items-center">
                <svg class="bi me-2" width="24" height="24" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus')}}" />
                </svg> Marca de Equip.
            </div>
        </a>
    </div>

    <div class="col-lg-3">
        <a class="btn btn-outline-dark w-100 m-2 p-2" href="{{route('cadastros.cliente.incluir')}}" title="Adicionar novo cliente">
            <div class="d-flex justify-content-center align-items-center">
                <svg class="bi me-2" width="24" height="24" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus')}}" />
                </svg> Cliente
            </div>
        </a>
    </div>

</div>

<div class="row shadow p-4 border rounded-3 bg-light">

    <div class="fw-light fs-4 my-2">

        <div class="d-flex align-items-center">
            <svg class="bi me-2" width="24" height="24" fill="currentColor">
                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#clipboard')}}" />
            </svg>
            <div> Resumo dos registros:</div>
        </div>

        <hr>
    </div>

    <div class="col-md-4 my-2">
        <div class="shadow bg-danger bg-gradient text-mutted p-4 rounded-3 text-center">
            <strong>Atrasados:</strong>
            <div class="fs-2">{{$reg_count['atrasados']}}</div>
            <div>Totalizando <strong> {{$equip_count['atrasados']}} </strong> equipamento(s).</div>
        </div>
    </div>

    <div class="col-md-4 my-2">
        <div class="shadow p-4 bg-warning bg-gradient text-mutted rounded-3 text-center">
            <strong>Pendentes:</strong>
            <div class="fs-2">{{$reg_count['pendentes'] - $reg_count['atrasados']}}</div>
            <div>Totalizando <strong> {{$equip_count['pendentes'] - $equip_count['atrasados']}} </strong> equipamento(s).</div>
        </div>
    </div>

    <div class="col-md-4 my-2">
        <div class="shadow p-4 bg-success bg-gradient text-mutted rounded-3 text-center">
            <strong> Entregues:</strong>
            <div class="fs-2">{{$reg_count['finalizados']}}</div>
            <div>Totalizando <strong> {{$equip_count['finalizados']}} </strong> equipamento(s).</div>

        </div>
    </div>





</div>


@endsection