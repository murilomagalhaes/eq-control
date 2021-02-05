@extends('template.base')
@section('title')
Registro de Saída: Registro {{$registry->id}}
@endsection
@section('content')

<form action="{{route('registros.saida.gravar')}}" method="POST" id="exit_form" name="exit_form">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$registry->id}}">
    <div class="row p-2 border rounded-3 mb-4 shadow-sm">

        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2"> Registro de Saída: Registro {{$registry->id}} </h1>
        </div>

        <div class="col-md-4 text-wrap float-end my-2">

            <div class="d-flex flex-wrap align-items-center float-end">

                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href="{{url()->previous()}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                        </svg>Voltar</a>
                </div>

                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Ações
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <button class="dropdown-item d-flex align-items-center" type="submit">
                                <svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                                </svg>Gravar</button>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" onclick="submitForm()"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                                    <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#printer')}}" />
                                </svg>Gravar e Imprimir Comprovante</a>
                        </li>
                    </ul>
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
                    <div class="d-flex justify-content-between pb-4"> <span class="fw-bold"> </span> </div>
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
                    <div class="d-flex justify-content-between"> <span class="fw-bold">Responsável: </span> {{$registry->responsavel->nome}}</div>
                    <div class="d-flex justify-content-between"> <span class="fw-bold">Prioridade: </span>

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
                    <div class="d-flex justify-content-between"> <span class="fw-bold">Equipamentos: </span>{{$registry->equipments->count()}}</div>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
    <div class="row my-3">

        <div class="alert alert-danger shadow-sm">
            <ul class="m-auto p-auto">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    </div>
    @endif

    <div class="form-group my-3">
        <label for="procedimentos" class="mb-4 border-start border-4 px-3">Procedimentos realizados:</label>
        <textarea name="procedimentos" id="procedimentos" cols="30" rows="7" class="form-control" placeholder="Informe aqui os procedimentos realizados" required></textarea>
    </div>

</form>
@endsection

@section('scripts')

<script>
    // Envia formulário com instrução para imprimir
    function submitForm() {

        let form = document.getElementById('exit_form')

        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
            document.getElementById('actions').click()
            return false;
        }

        let print = document.createElement("input");
        print.name = "print";
        print.type = "hidden";
        print.value = 1;

        form.appendChild(print);

        form.submit();
    }
</script>

@endsection