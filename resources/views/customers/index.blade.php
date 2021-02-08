@section('title') Cadastro de Clientes @endsection
@extends('template.base')
@section('content')

<style>
    /* Adds pointer cursor to 'linkable' table row */
    tr[data-href] {
        cursor: pointer;
    }
</style>

<div class="row p-2 border rounded-3 mb-4 shadow-sm bg-light">
    <div class="col-12">

        <div class="d-flex align-items-center justify-content-between">
            <h1 class="h4 my-3 me-3"> Cadastro de Clientes </h1>
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{route('cadastros.cliente.incluir')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#plus-square')}}" />
                </svg> Incluir</a>
        </div>

        <div class="accordion my-3 bg-white" id="searchAccordion">
            <div class="accordion-item">

                <h2 class="accordion-header" id="headingSearch">
                    <button class="accordion-button {{isset($search) ? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="true" aria-controls="collapseSearch">
                        <div class="d-flex align-items-center">
                            <svg class="bi me-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#search')}}" />
                            </svg>
                            <span> Pesquisar </span>
                        </div>
                    </button>
                </h2>

                <div id="collapseSearch" class="accordion-collapse {{isset($search) ? 'collapse show' : 'collapse'}}" aria-labelledby="headingSearch" data-bs-parent="#searchAccordion">
                    <div class="accordion-body">
                        <form action="{{route('cadastros.cliente.buscar')}}" method="GET">
                            <div class="input-group my-2">
                                <input type="text" name="q" class="form-control me-2" placeholder="Pesquisa por nome, razão social, ou CNPJ" aria-label="Recipient's username" aria-describedby="button-addon2" value="{{isset($search) ? $search : ''}}">
                                <a class="btn btn-outline-secondary float-end d-flex align-items-center" title="Limpar pesquisa" href="{{route('cadastros.cliente')}}"><svg class="bi m-auto" width="20" height="20" fill="currentColor">
                                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#arrow-repeat')}}" />
                                    </svg></a>
                                <button class="btn btn-outline-success" type="submit" id="button-addon2">Pesquisar</button>
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

@if($errors->any())
<div class="row mt-4">
    <div class="alert alert-danger shadow-sm">
        <ul class="m-auto p-auto">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="m-auto">

    <table class="table table-responsive table-hover caption-top ">
        <thead class="thead-light">
            <caption>Listando {{$customers->total()}} registro(s): </caption>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF/CNPJ</th>
                <th scope="col">Telefone</th>
                <th scope="col">Cidade</th>
                <th scope="col">Endereço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $i => $customer)
            <tr data-href="{{route('cadastros.cliente.mostrar', $customer)}}">
                <th scope="row">{{$i+1}}</th>
                <td>{{$customer->nome}}</td>
                <td>{{$customer->cpf_cnpj}}</td>
                <td>{{$customer->telefone}}</td>
                <td>{{$customer->cidade}}</td>
                <td>{{$customer->endereco}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="my-4 d-flex justify-content-center">
    {{$customers->links()}}
</div>

@endsection

@section('scripts')
<script>
    // Adds link to table row
    document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll("tr[data-href]");
        rows.forEach(row => {
            row.addEventListener('click', () => {
                window.location.href = row.dataset.href
            })
        })
    })
</script>
@endsection