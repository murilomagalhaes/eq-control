@extends('template.base')
@section('title') {{isset($customer->id) ? 'Cadastro de Clientes' : 'Novo Cliente'}} @endsection
@section('content')
<form action="{{route('cadastros.cliente.gravar')}}" method="POST" id="customer_form">

    @csrf

    @if(isset($customer->id))
    <input type="hidden" value="{{$customer->id}}" name="id">
    @endif

    <div class="row p-2 border rounded-3 mb-4 shadow-sm">

        <div class="col-md-8 d-flex align-items-center">
            <h1 class="h4 my-2"> {{isset($customer->id) ? $customer->nome : 'Novo cliente'}} </h1>
        </div>

        <div class="col-md-4 text-wrap float-end my-2">

            @if(Route::is('cadastros.cliente.incluir'))

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
            <div class="form-group col-lg-6">
                <label for="nome">Nome Fantasia <span class="text-danger">*</span></label>
                <input type="text" name="nome" id="nome" class="form-control my-2" minlength="4" maxlength="60" value="{{old('nome')}}{{isset($customer->nome) && !old('nome') ? $customer->nome : ''}}" required>
            </div>

            <div class="form-group col-lg-6">
                <label for="razao">Razão Social <span class="text-danger">*</span></label>
                <input type="text" name="razao" id="razao" class="form-control my-2" minlength="4" maxlength="60" value="{{old('razao')}}{{isset($customer->razao) && !old('razao') ? $customer->razao : ''}}" required>
            </div>
        </div>

        <div class="row mb-2">
            <div class="form-group col-lg-3">
                <label for="cpf_cnpj">CPF/CNPJ <span class="text-danger">*</span></label>
                <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control my-2" onkeypress="return onlyNumbers(event)" placeholder="CPF ou CNPJ" minlength="11" maxlength="14" value="{{old('cpf_cnpj')}}{{isset($customer->cpf_cnpj) && !old('cpf_cnpj') ? $customer->cpf_cnpj : ''}}" required>
            </div>

            <div class="form-group col-lg-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control my-2" placeholder="" value="{{old('email')}}{{isset($customer->email) && !old('email') ? $customer->email : ''}}">
            </div>

            <div class="form-group col-lg-3">
                <label for="telefone">Telefone <span class="text-danger">*</span></label>
                <input type="text" name="telefone" id="telefone" class="form-control my-2" onkeypress="return onlyNumbers(event)" placeholder="Ex: 6133330000" minlength="10" maxlength="11" value="{{old('telefone')}}{{isset($customer->telefone) && !old('telefone') ? $customer->telefone : ''}}" required>
            </div>
        </div>

        <div class="row mb-2">

            <div class="form-group col-lg-2">
                <label for="cep">CEP</label>
                <input type="text" name="cep" id="cep" class="form-control my-2" onkeypress="return onlyNumbers(event)" onblur="pesquisaCep(this.value)" placeholder="Ex: 72000000" minlength="8" maxlength="8" value="{{old('cep')}}{{isset($customer->cep) && !old('cep') ? $customer->cep : ''}}">
            </div>

            <div class="form-group col-lg-2">
                <label for="uf">Estado <span class="text-danger">*</span> </label>
                <select name="uf" class="form-select my-2" id="uf" required>
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
                <label for="cidade">Cidade <span class="text-danger">*</span></label>
                <input type="cidade" name="cidade" id="cidade" class="form-control my-2" placeholder="" minlength="4" maxlength="60" value="{{old('cidade')}}{{isset($customer->cidade) && !old('cidade') ? $customer->cidade : ''}}" required>
            </div>

            <div class="form-group col-lg-4">
                <label for="endereco">Endereço <span class="text-danger">*</span></label>
                <input type="text" name="endereco" id="endereco" class="form-control my-2" minlength="4" maxlength="60" value="{{old('endereco')}}{{isset($customer->endereco) && !old('endereco') ? $customer->endereco : ''}}" required>
            </div>
        </div>


        <hr class="my-4">

    </div>

</form>

@endsection

@section('scripts')
@if(old('uf') || isset($customer->uf))
<script>
    // Seleciona UF do cadastro ao abrir formulario.
    let uf = "{{old('uf')}}" || "{{$customer->uf ?? ''}}"

    let uf_options = document.getElementById('uf').options;

    for (i = 0; i < uf_options.length; i++) {
        if (uf_options[i].value == uf) {
            uf_options[i].setAttribute('selected', 'selected');
        }
    }
</script>
@endif


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