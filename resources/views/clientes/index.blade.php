@section('title') Cadastro de Clientes @endsection
@extends('template.base')
@section('content')

<div class="row p-2 border rounded-3 mb-4 shadow-sm">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="h4 my-3 me-3"> Cadastro de Clientes </h1>
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{route('cadastros.cliente.novo')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus-square')}}" />
                </svg> Incluir</a>

        </div>
        <div class="accordion my-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="d-flex align-items-center">
                            <svg class="bi me-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#search')}}" />
                            </svg>
                            <span> Pesquisar </span>
                        </div>

                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="">

                            <div class="input-group my-2">
                                <input type="text" class="form-control me-2" placeholder="Pesquisa por nome, razão social, ou CNPJ" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Pesquisar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

    </div>

</div>

<div class="m-auto">
    <table class="table table-responsive table-hover caption-top ">
        <thead class="thead-light">
            <caption>Listagem:</caption>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Telefone</th>
                <th scope="col">Cidade</th>
                <th scope="col">Endereço</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Autotec</td>
                <td>00.000.000/0000-00</td>
                <td>61999999999</td>
                <td>Brasília</td>
                <td>QNF 09 Lote 40</td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Autotec</td>
                <td>00.000.000/0000-00</td>
                <td>61999999999</td>
                <td>Brasília</td>
                <td>QNF 09 Lote 40</td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Autotec</td>
                <td>00.000.000/0000-00</td>
                <td>61999999999</td>
                <td>Brasília</td>
                <td>QNF 09 Lote 40</td>
            </tr>
        </tbody>
    </table>
</div>



@endsection