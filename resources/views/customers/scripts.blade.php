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
    function destroy() {

        let action = confirm('Ao deletar esse cliente, todos os registros associados a ele também serão deletados. \n\nVocê tem certeza?');

        if (action == true) {
            form = document.getElementById('delete_form');
            form.submit();
        }

    }

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
        save_edit_div.innerHTML = "<button class='dropdown-item d-flex align-items-center' type='submit' id='edit-btn'>" +
            "<svg class='bi me-2' width='20' height='20' fill='currentColor'>" +
            "<use xlink:href='{{asset('dist/icons/bootstrap-icons.svg#save')}}' />" +
            "</svg>Gravar</button>";

    }
</script>

@if(Route::is('cadastros.cliente.mostrar') && !$errors->any())
<script>
    // Desabilita inputs ao mostrar cadastro.
    var inputs = document.getElementsByTagName("input");
    for (i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'hidden') {
            inputs[i].disabled = true;
        }
    }
</script>
@elseif($errors->any())
<script>
    // Habilita inputs.
    enableInputs();
</script>
@endif