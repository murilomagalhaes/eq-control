@extends('template.base')
@section('title') {{isset($customer->id) ? 'Registro de Equipamentos' : 'Novo Registro > Equipamento'}} @endsection
@section('content')

<form action="{{route('registros.gravar')}}" method="POST" id="customer_form">
    @csrf

    @if(isset($customer->id))
    <input type="hidden" value="{{$customer->id}}" name="id">
    @endif

    <div class="row p-2 border rounded-3 mb-4 shadow-sm">

        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2"> {{isset($customer->id) ? $customer->nome : 'Novo Registro > Equipamento'}} </h1>
        </div>

        <div class="col-md-4 text-wrap float-end my-2">

            @if(Route::is('registros.equipamento.incluir'))
            <div class="d-flex align-items-center float-end">

                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href="{{url()->previous()}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Voltar</a>
                </div>

                <div class="dropdown">
                    <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Gravar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <li><button type="submit" class="dropdown-item"><svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                                </svg>Gravar</button></li>

                        <li><a class="dropdown-item" href="#"><svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#printer')}}" />
                                </svg>Gravar e Imprimir Comprovante</a></li>


                        <li><a class="dropdown-item" href="#"><svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus-square')}}" />
                                </svg>Gravar e Adicionar Outro Equipamento</a></li>
                    </ul>
                </div>


            </div>
            @elseif(Route::is('equipmentos.registro.mostrar'))

            <div class="d-flex flex-wrap align-items-center float-end">

                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href=""> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Voltar</a>
                </div>

                <div id="save-edit-div" class="me-2 my-1">
                    <button class="btn btn-outline-primary d-flex align-items-center" type="button" id="edit-btn" onclick="enableInputs()">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#pencil-square')}}" />
                        </svg>Editar</button>
                </div>

                <div class="my-1">
                    <button class="btn btn-outline-danger d-flex align-items-center" type="button"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#eraser')}}" />
                        </svg>Deletar</button>
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
                <h2 class="h5 my-0">Equipamentos:</h2>
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
                    <input type="text" name="descricao" id="descricao" placeholder="Ex: Computador branco." class="form-control my-2">
                </div>

            </div>

            <div class="col-lg-7">
                <div class="form-group col-lg-12">
                    <label for="serie">Num. de Série</label>
                    <input type="text" name="serie" id="serie" class="form-control my-2">
                </div>

                <div class="form-group">
                    <label for="problemas">Problemas Apresentados <span class="text-danger"> *</span></label>
                    <textarea name="problemas" id="problemas" placeholder="Descreva brevemente o motivo da entrega do equipamento." rows="5" class="form-control my-2"></textarea>
                </div>


            </div>

        </div>

    </div>



</form>

@endsection

@section('scripts')
@include('registries.equipments.scripts')
@endsection