@extends('template.base')
@section('title') {{isset($brand->id) ? 'Cadastro de Marcas' : 'Nova Marca'}} @endsection
@section('content')
<form action="{{route('cadastros.marca.gravar')}}" method="POST" id="customer_form">
    @csrf

    @if(isset($brand->id))
    <input type="hidden" value="{{$brand->id}}" name="id">
    @endif

    <div class="row p-2 border rounded-3 mb-4 shadow-sm bg-light">

        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2"> {{isset($brand->id) ? $brand->nome : 'Nova marca'}} </h1>
        </div>

        <div class="col-md-4 text-wrap float-end my-2">

            @if(Route::is('cadastros.marca.incluir'))
            <div class="d-flex align-items-center float-end">

                <a class="btn btn-outline-danger d-flex align-items-center me-2" href="{{route('cadastros.marca')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                    </svg>Cancelar</a>

                <button class="btn btn-outline-success d-flex align-items-center" type="submit"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                    </svg>Gravar</button>
            </div>
            @else(Route::is('cadastros.marca.mostrar'))

            <div class="d-flex flex-wrap align-items-center float-end">

                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href="{{route('cadastros.marca')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Voltar</a>
                </div>

                <div id="save-edit-div">
                    <button class="btn btn-outline-primary d-flex align-items-center" type="button" id="edit-btn" onclick="enableInputs()">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#pencil-square')}}" />
                        </svg>Editar</button>
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
            <div class="form-group col-lg-12">
                <label for="nome">Nome da marca <span class="text-danger">*</span></label>
                <input type="text" name="nome" id="nome" class="form-control my-2" minlength="2" maxlength="60" value="{{old('nome')}}{{isset($brand->nome) && !old('nome') ? $brand->nome : ''}}" placeholder="Ex: Epson" required>
            </div>
        </div>

        <hr class="my-4">

    </div>

</form>

@endsection

@section('scripts')
@include('brands.scripts')
@endsection