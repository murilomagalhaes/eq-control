@extends('template.base')
@section('title') Novo Cliente @endsection
@section('content')

<div class="row p-2 border rounded-3 mb-4 shadow-sm">

    <div class="col-md-9 d-flex align-items-center">
        <h1 class="h4 my-2"> Novo cliente </h1>
    </div>

    <div class="col-md-3 float-end my-2">

        @if(Route::is('cadastros.cliente.novo'))

        <div class="d-flex align-items-center float-end">

            <a class="btn btn-outline-danger d-flex align-items-center me-2" href="{{url()->previous()}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                </svg>Cancelar</a>

            <a class="btn btn-outline-success d-flex align-items-center" href="#"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                </svg>Gravar</a>
        </div>

        @else()
        <a class="btn btn-outline-primary d-flex align-items-center" href="{{route('cadastros.cliente.novo')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus')}}" />
            </svg>Incluir</a>

        @endif

    </div>



</div>

<div class="row">

    <form action="{{route('cadastros.cliente.novo')}}" method="POST">
        @csrf

        <div class="row mb-2">
            <div class="form-group col-lg-6">
                <label for="nome">Nome Fantasia</label>
                <input type="text" name="nome" id="nome" class="form-control my-2" maxlength="60">
            </div>

            <div class="form-group col-lg-6">
                <label for="razao">Razão Social</label>
                <input type="text" name="razao" id="razao" class="form-control my-2" maxlength="">
            </div>
        </div>

        <div class="row mb-2">
            <div class="form-group col-lg-3">
                <label for="cpf_cnpj">CPF/CNPJ</label>
                <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control my-2" placeholder="CPF ou CNPJ" minlength="11" maxlength="14">
            </div>

            <div class="form-group col-lg-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control my-2" placeholder="">
            </div>

            <div class="form-group col-lg-3">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control my-2" placeholder="Ex: 61999999999" maxlength="11">
            </div>
        </div>

        <div class="row mb-2">

            <div class="form-group col-lg-2">
                <label for="cep">CEP</label>
                <input type="cep" name="cep" id="cep" class="form-control my-2" placeholder="" minlength="8" maxlength="9">
            </div>

            <div class="form-group col-lg-2">
                <label for="uf">Estado</label>
                <select name="uf" class="form-select my-2">
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </div>

            <div class="form-group col-lg-4">
                <label for="cidade">Cidade</label>
                <input type="cidade" name="cidade" id="cidade" class="form-control my-2" placeholder="" minlength="4" maxlength="60">
            </div>

            <div class="form-group col-lg-4">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" class="form-control my-2" minlength="4" maxlength="60">
            </div>
        </div>
    </form>

    <hr class="my-4">

</div>

@endsection