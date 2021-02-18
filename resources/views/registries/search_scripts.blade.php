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
            placeholder: "Responsável técnico",
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
            placeholder: "Cliente",
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


@if(old('cliente'))
<script>
    // Busca o cliente antigo e adiciona no select.
    let customerSelect = $('.cliente');

    $.ajax({
        type: 'GET',
        url: "{{route('cadastros.cliente.ajax',     old('cliente'))}}"
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

@if(old('responsavel'))
<script>
    // Busca o responsavel antigo e adiciona no select.
    let userSelect = $('.responsavel');


    $.ajax({
        type: 'GET',
        url: "{{route('cadastros.usuario.ajax', old('responsavel'))}}"
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
@endif

@if(old('prioridade'))
<script>
    // Seleciona prioridade ao abrir formulario.
    let prioridade = "{{old('prioridade')}}";

    let prioridade_options = document.getElementById('prioridade').options;

    for (i = 0; i < prioridade_options.length; i++) {
        if (prioridade_options[i].value == prioridade) {
            prioridade_options[i].setAttribute('selected', 'selected');
        }
    }
</script>
@endif

@if(old('status'))
<script>
    // Seleciona status ao abrir formulario.
    let status = "{{old('status')}}";

    let status_options = document.getElementById('status').options;

    for (i = 0; i < status_options.length; i++) {
        if (status_options[i].value == status) {
            status_options[i].setAttribute('selected', 'selected');
        }
    }
</script>
@endif

@if(old('periodo'))
<script>
    console.log('AM HERE')
    // Seleciona prioridade ao abrir formulario.
    let periodo = "{{old('periodo')}}";

    let periodo_options = document.getElementById('periodo').options;

    for (i = 0; i < periodo_options.length; i++) {
        if (periodo_options[i].value == periodo) {
            periodo_options[i].setAttribute('selected', 'selected');
        }
    }
</script>
@endif



