@extends('template.base')
@section('title') {{isset($customer->id) ? 'Registro de Equipamentos' : 'Novo Registro'}} @endsection
@section('content')

<style>
    .select2-selection__rendered {
        line-height: 38px !important;
        margin-top: 0.5em;

    }

    .select2-container .select2-selection--single {
        height: 38px !important;
        margin-top: 0.5em;
    }

    .select2-selection__arrow {
        height: 38px !important;
        margin-top: 0.5em;
    }
</style>

<form action="{{route('cadastros.cliente.gravar')}}" method="POST" id="customer_form">

    @csrf

    @if(isset($customer->id))
    <input type="hidden" value="{{$customer->id}}" name="id">
    @endif

    <div class="row p-2 border rounded-3 mb-4 shadow-sm">

        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2"> {{isset($customer->id) ? $customer->nome : 'Novo Registro'}} </h1>
        </div>

        <div class="col-md-4 text-wrap float-end my-2">

            @if(Route::is('registros.incluir'))

            <div class="d-flex align-items-center float-end">

                <a class="btn btn-outline-danger d-flex align-items-center me-2" href="{{route('cadastros.cliente')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace')}}" />
                    </svg>Cancelar</a>

                <button class="btn btn-outline-success d-flex align-items-center" type="submit"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#save')}}" />
                    </svg>Gravar</button>
            </div>

            @else(Route::is('cadastros.cliente.mostrar'))

            <div class="d-flex flex-wrap align-items-center float-end">

                <div class="me-2 my-1">
                    <a class="btn btn-outline-secondary d-flex align-items-center" href="{{route('cadastros.cliente')}}"> <svg class="bi me-2" width="20" height="20" fill="currentColor">
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

    <div class="row my-4">
        @if($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="m-auto p-auto">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="row justify-content-around">

        <div class="row mb-2">
            <div class="form-group col-lg-3">
                <label for="dt_entrada">Data da entrada<span class="text-danger"> *</span></label>
                <input type="datetime-local" name="dt_entrada" id="dt_entrada" class="form-control my-2" minlength="4" maxlength="40" value="{{old('dt_entrada')}}{{isset($equipment_type->dt_entrada) && !old('dt_entrada') ? $equipment_type->dt_entrada : ''}}" placeholder="Ex: Computadores" required>
            </div>

            <div class="form-group col-lg-3">
                <label for="dt_previsao">Previsão de entrega<span class="text-danger"> *</span></label>
                <input type="datetime-local" name="dt_previsao" id="dt_previsao" class="form-control my-2" minlength="4" maxlength="40" value="{{old('dt_previsao')}}{{isset($equipment_type->dt_previsao) && !old('dt_previsao') ? $equipment_type->dt_previsao : ''}}" placeholder="Ex: Computadores" required>
            </div>

            <div class="form-group col-lg-6">
                <label for="cliente">Cliente<span class="text-danger"> *</span></label>
                <select name="cliente" id="cliente" name="cliente" class="form-select m-auto    ">
                    <option value="" id></option>

                </select>
            </div>
        </div>

        <hr class="my-4">

    </div>



</form>

@endsection

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.form-select').select2();

        $('.form-select').select2({
            width: "resolve",
            ajax: {
                url: "{{route('cadastros.clientes.ajax')}}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nome,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>


<script>
    // Permitir apenas numeros em inputs
    function onlyNumbers(evt) {
        let charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    // API ViaCEP ----------------------------------------------------
    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('uf').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('endereco').value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('uf').value = (conteudo.uf);
            document.getElementById('endereco').value = (conteudo.logradouro + ' ' + conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisaCep(valor) {

        //Nova variável "cep" somente com dígitos.
        let cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            let validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('uf').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('endereco').value = "...";

                //Cria um elemento javascript.
                let script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }

    // Habilita inputs

    function enableInputs() {

        let inputs = document.getElementsByTagName("input");

        document.getElementById('uf').disabled = false;
        for (i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }

        document.getElementById('edit-btn').remove()

        let save_edit_div = document.getElementById('save-edit-div');
        save_edit_div.innerHTML = "<button class='btn btn-outline-success d-flex align-items-center' type='submit' id='edit-btn'>" +
            "<svg class='bi me-2' width='20' height='20' fill='currentColor'>" +
            "<use xlink:href='{{asset('dist/icons/bootstrap-icons.svg#save')}}' />" +
            "</svg>Gravar</button>";

    }
</script>

@if(Route::is('cadastros.cliente.mostrar') && !$errors->any())
<script>
    // Desabilita inputs ao mostrar cadastro.
    var inputs = document.getElementsByTagName("input");
    document.getElementById('uf').disabled = true;
    for (i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }
</script>
@elseif($errors->any())
<script>
    enableInputs();
</script>
@endif


@endsection