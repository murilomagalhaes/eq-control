<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- Starting Select2 -->
<script>
    $(document).ready(function() {
        $('.tipo').select2();
        $('.tipo').select2({
            placeholder: "Tipo de equipamento.",
            ajax: {
                url: "{{route('cadastros.tipo.ajax')}}",
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

        $('.marca').select2();
        $('.marca').select2({
            placeholder: "Marca do equipamento.",
            ajax: {
                url: "{{route('cadastros.marca.ajax')}}",
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

@if(old('marca'))
<script>
    // Busca a marca antigad e adiciona no select.
    let brandSelect = $('.marca');
    $.ajax({
        type: 'GET',
        url: "{{route('cadastros.marca.ajax', old('marca'))}}"
    }).then(function(data) {
        console.log(data);
        // create the option and append to Select2
        let option = new Option(data.nome, data.id, true, true);
        brandSelect.append(option).trigger('change');

        // manually trigger the `select2:select` event
        brandSelect.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        });
    });
</script>
@endif

@if(old('tipol'))
<script>
    // Busca o tipo antigo e adiciona no select.
    let typeSelect = $('.tipo');
    $.ajax({
        type: 'GET',
        url: "{{route('cadastros.tipo.ajax', old('tipo'))}}"
    }).then(function(data) {
        console.log(data);
        // create the option and append to Select2
        let option = new Option(data.nome, data.id, true, true);
        typeSelect.append(option).trigger('change');

        // manually trigger the `select2:select` event
        typeSelect.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        });
    });
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