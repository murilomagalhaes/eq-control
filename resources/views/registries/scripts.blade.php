<!-- Include Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Include Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- Starting Select2 -->
<script>
    $(document).ready(function() {
        $('.responsavel').select2();
        $('.responsavel').select2({
            placeholder: "Técnico/usuário cadastrado.",
            ajax: {
                url: "{{route('cadastros.usuario.ajax')}}",
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

        $('.cliente').select2();
        $('.cliente').select2({
            placeholder: "Cliente/empresa cadastrada.",
            ajax: {
                url: "{{route('cadastros.cliente.ajax')}}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.cpf_cnpj + ' - ' + item.nome,
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


@if(old('cliente') || isset(session('registry')['cliente']) || old('responsavel') || isset(session('registry')['responsavel']) )

@if(old('cliente') || isset(session('registry')['cliente']))
<script>
    // Busca o cliente antigo e adiciona no select.
    let customerSelect = $('.cliente');

    $.ajax({
        type: 'GET',
        url: "{{route('cadastros.cliente.ajax', session('registry')['cliente'] ?? old('cliente'))}}"
    }).then(function(data) {
        // create the option and append to Select2
        let option = new Option(data.cpf_cnpj + ' - ' + data.nome, data.id, true, true);
        customerSelect.append(option).trigger('change');

        // manually trigger the `select2:select` event
        customerSelect.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        });
    });
</script>
@endif

@if(old('responsavel') || isset(session('registry')['responsavel']))
<script>
    // Busca o responsavel antigo e adiciona no select.
    let userSelect = $('.responsavel');


    $.ajax({
        type: 'GET',
        url: "{{route('cadastros.usuario.ajax', session('registry')['responsavel'] ?? old('responsavel'))}}"
    }).then(function(data) {
        // create the option and append to Select2
        let option = new Option(data.nome, data.id, true, true);
        userSelect.append(option).trigger('change');

        // manually trigger the `select2:select` event
        userSelect.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        });
    });
</script>

@php
Session::forget('registry')
@endphp

@endif
@endif

<script>
    // Permitir apenas numeros em inputs
    function onlyNumbers(evt) {
        let charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
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

@if(old('prioridade') || isset(session('registry')['prioridade']))
<script>
    // Seleciona prioridade ao abrir formulario.
    let prioridade = "{{old('prioridade')}}" || "{{session('registry')['prioridade'] ?? ''}}"

    let prioridade_options = document.getElementById('prioridade').options;

    for (i = 0; i < prioridade_options.length; i++) {
        if (prioridade_options[i].value == prioridade) {
            prioridade_options[i].setAttribute('selected', 'selected');
        }
    }
</script>
@endif

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