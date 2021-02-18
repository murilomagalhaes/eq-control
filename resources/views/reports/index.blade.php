@extends('template.base')
@section('title') Relatórios @endsection
@section('content')

<div class="bg-light shadow p-4 border rounded-3">
    <div>
        <h1 class="h4 my-3"> Relatórios </h1>
    </div>
    <form action="{{route('relatorios.processar')}}" method="GET" id="report_form">
        
        <div class="row">
            <div class="col-lg-4 p-2">
                <select name="periodo" id="periodo" class="form-select my-2">
                    <option value="" selected disabled>Período: </option>
                    <option></option>
                    <option value="dt_entrada">Entrada</option>
                    <option value="dt_previsao">Previsao</option>
                    <option value="dt_entrega">Entrega</option>
                </select>
                <div class="input-group my-3">
                    <span class="input-group-text">De</span>
                    <input type="date" id="periodo_de" name="periodo_de" class="form-control" value="{{old('periodo_de')}}">
                </div>

                <div class="input-group my-3">
                    <span class="input-group-text">Até</span>
                    <input type="date" id="periodo_ate" name="periodo_ate" class="form-control" value="{{old('periodo_ate')}}">
                </div>
            </div>

            <div class="col-lg-8 p-2">
                <select name="cliente" id="cliente" class="cliente form-select"></select>
                <select name="responsavel" id="responsavel" class="responsavel form-select"></select>

                <div class="input-group my-2">
                    <select name="prioridade" id="prioridade" class="form-select me-3">
                        <option value="" selected disabled>Prioridade</option>
                        <option>Todos</option>
                        <option value="1" class="text-primary">Baixa</option>
                        <option value="2">Média</option>
                        <option value="3" style="color: orange">Alta</option>
                        <option value="4" class="text-danger">Crítica</option>
                    </select>

                    <select name="status" id="status" class="form-select">
                        <option value="" selected disabled>Status</option>
                        <option>Todos</option>
                        <option value="entregue" class="text-success">Entregues</option>
                        <option value="pendente" style="color: orange;">Pendentes e Atrasados</option>
                        <option value="atrasado" class="text-danger">Atrasados</option>
                    </select>


                </div>
            </div>

            <div class="row d-flex justify-content-between">

                <div class="col-md-4">
                    <button class="btn btn-outline-primary m-2 w-100 p-2 d-flex align-items-center justify-content-center" onclick="sendReportForm('view')">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#search')}}" />
                        </svg> Visualizar
                    </button>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-outline-primary m-2 w-100 p-2 d-flex align-items-center justify-content-center" onclick="sendReportForm('print')">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#printer')}}" />
                        </svg>
                        Imprimir
                    </button>
                </div>

                <div class="col-md-4">
                    <button  class="btn btn-outline-primary m-2 w-100 p-2 d-flex align-items-center justify-content-center" onclick="sendReportForm('excel')">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#table')}}" />
                        </svg>
                        Exportar p/ Excel
                    </button>
                </div>

            </div>
        </div>

    </form>

</div>

@endsection

@section('scripts')
@include('registries.search_scripts')
@include('reports.scripts')
@endsection