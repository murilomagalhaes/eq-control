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

<!-- I don't remember why i did this nested if, will check out later -->
@if(old('cliente') || isset(session('registry')['cliente']) || old('responsavel') || isset(session('registry')['responsavel']) || isset($registry->responsavel_id) )
@if(old('cliente') || isset(session('registry')['cliente']) || isset($registry->customer_id))
<script>
    // Busca o cliente antigo e adiciona no select.
    let customerSelect = $('.cliente');

    let url_cliente

    // If the registry is on edit mode ...
    if ("{{isset($registry->customer_id) ?? ''}}") {
        url_cliente = "{{route('cadastros.cliente.ajax', $registry->customer_id ?? '')}}";
    } else {
        url_cliente = "{{route('cadastros.cliente.ajax', session('registry')['cliente'] ?? old('cliente'))}}"
    }

    $.ajax({
        type: 'GET',
        url: url_cliente
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

@if(old('responsavel') || isset(session('registry')['responsavel']) || isset($registry->responsavel_id))
<script>
    // Busca o responsavel antigo e adiciona no select.
    let userSelect = $('.responsavel');

    let url_responsavel;

    if ("{{isset($registry->responsavel_id)}}") {
        url_responsavel = "{{route('cadastros.usuario.ajax', $registry->responsavel_id ?? '')}}"
    } else {
        url_responsavel = "{{route('cadastros.usuario.ajax', session('registry')['responsavel'] ?? old('responsavel'))}}"
    }

    $.ajax({
        type: 'GET',
        url: url_responsavel
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

@if(isset($registry))
<script>
    let dt_previsao = "{{$registry->dt_previsao}}";
    document.getElementById('dt_previsao').value = dt_previsao.replace(' ', 'T');

    let dt_entrada = "{{$registry->dt_entrada}}";
    document.getElementById('dt_entrada').value = dt_entrada.replace(' ', 'T');
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

</script>

@if(old('prioridade') || isset(session('registry')['prioridade']) || isset($registry->prioridade))
<script>
    // Seleciona prioridade ao abrir formulario.
    let prioridade = "{{old('prioridade')}}" || "{{session('registry')['prioridade'] ?? ''}}" || "{{$registry->prioridade}}"

    let prioridade_options = document.getElementById('prioridade').options;

    for (i = 0; i < prioridade_options.length; i++) {
        if (prioridade_options[i].value == prioridade) {
            prioridade_options[i].setAttribute('selected', 'selected');
        }
    }
</script>
@endif