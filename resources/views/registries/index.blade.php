@section('title') Registros de Equipamentos @endsection
@extends('template.base')
@section('content')

<style>
    tr[data-href] {
        cursor: pointer;
    }

    #registry:hover {
       opacity:0.6
    }
</style>

<div class="row p-2 border rounded-3 mb-4 shadow-sm">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="h4 my-3 me-3"> Registros de Equipamentos </h1>
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{route('registros.incluir')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus-square')}}" />
                </svg> Incluir</a>

        </div>
        <div class="accordion my-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button {{isset($search) ? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="d-flex align-items-center">
                            <svg class="bi me-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#search')}}" />
                            </svg>
                            <span> Pesquisar </span>
                        </div>

                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse {{isset($search) ? 'collapse show' : 'collapse'}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{route('cadastros.cliente.buscar')}}" method="GET">

                            <div class="input-group my-2">
                                <input type="text" name="q" class="form-control me-2" placeholder="<EM DESENVOLVIMENTO...>" aria-label="Recipient's username" aria-describedby="button-addon2" value="{{isset($search) ? $search : ''}}">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Pesquisar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@if(!empty(session('store_success')))
<div class="row mt-4">
    <div class="alert alert-success shadow-sm">
        {{session('store_success')}}
    </div>
</div>
@endif

<div class="row">

    @foreach($registries as $registry)
    <div class="col-lg-4">

        <div class="card p-0 my-3 shadow">
            <a href="{{route('registros.mostrar', $registry)}}" class="text-decoration-none text-dark" id="registry">
                <div class="card-body">
                    <h5 class="card-title m-1 text-center">{{$registry->customer->nome}}</h5>
                    <hr>
                    <p class="card-text m-1 d-flex align-items-center">
                        <svg class="bi me-2" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#person-square')}}" />
                        </svg>
                        {{$registry->nome}}
                    </p>
                    <p class="card-text m-1 d-flex align-items-center">
                        <svg class="bi me-2" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#telephone')}}" />
                        </svg> {{$registry->telefone}}
                    </p>

                    <p class="card-text m-1 d-flex align-items-center">
                        <svg class="bi me-2" width="18" height="18" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#laptop')}}" />
                        </svg> {{$registry->equipments->count()}} equipamento(s).
                    </p>

                    <hr>

                    <p class="card-text m-1 d-flex align-items-center justify-content-between">
                        <span class="d-flex align-items-center"> <svg class="bi me-2" width="18" height="18" fill="currentColor">
                                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#calendar-plus')}}" />
                            </svg> Entrada:</span>
                        <span class="fw-bold"> {{$registry->getFormatedDateTime('dt_entrada')}} </span>
                    </p>

                    <p class="card-text m-1 d-flex align-items-center justify-content-between">
                        <span class="d-flex align-items-center"> <svg class="bi me-2" width="18" height="18" fill="currentColor">
                                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#calendar-check')}}" />
                            </svg> Previsão:</span>
                        <span class="fw-bold"> {{$registry->getFormatedDateTime('dt_previsao')}} </span>
                    </p>

                </div>


                @if($registry->prioridade == 1)
                <div class="card-footer bg-secondary">
                    <small class="text-light d-flex justify-content-between"> <span class="fw-bold"><span class="fw-bold">ID: {{$registry->id}} </span> Prioridade: Baixa</small>
                </div>
                @endif
                @if($registry->prioridade == 2)
                <div class="card-footer bg-primary">
                    <small class="text-light d-flex justify-content-between"><span class="fw-bold">ID: {{$registry->id}}</span> Prioridade: Média</small>
                </div>
                @endif
                @if($registry->prioridade == 3)
                <div class="card-footer bg-warning">
                    <small class="text-dark d-flex justify-content-between"><span class="fw-bold">ID: {{$registry->id}}</span> Prioridade: Alta</small>
                </div>
                @endif
                @if($registry->prioridade == 4)
                <div class="card-footer bg-danger">
                    <small class="text-light d-flex justify-content-between"><span class="fw-bold">ID: {{$registry->id}}</span> Prioridade: Crítica</small>
                </div>
                @endif
            </a>
        </div>

    </div>

    @endforeach


</div>



@endsection