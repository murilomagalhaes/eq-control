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

<!-- -->

<script>
    let form = document.getElementById('registry_form');

    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
    })
</script>

<!-- Script to manually submit form -->
<script>
    function submitForm(stop, print) {

        let form = document.getElementById('registry_form')

        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
            document.getElementById('actions').click()
            return false;
        }

        let add_more = document.createElement("input");
        add_more.name = "add_more";
        add_more.type = "hidden";

        if (stop == true) {
            add_more.value = 0;
        } else {
            add_more.value = 1;
        }

        if (print == true) {
            let print = document.createElement("input");
            print.name = "print";
            print.type = "hidden";
            print.value = 1;

            form.appendChild(print);
        }

        form.appendChild(add_more);

        form.submit();
    }
</script>

@if(old('marca') || isset($equipment))
<script>
    // Busca a marca antigad e adiciona no select.
    let brandSelect = $('.marca');
    $.ajax({
        type: 'GET',
        url: "{{route('cadastros.marca.ajax', old('marca') ?? $equipment->brand_id)}}"
    }).then(function(data) {
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

@if(old('tipo') || isset($equipment))
<script>
    // Busca o tipo antigo e adiciona no select.
    let typeSelect = $('.tipo');
    $.ajax({
        type: 'GET',
        url: "{{route('cadastros.tipo.ajax', old('tipo') ?? $equipment->type_id)}}"
    }).then(function(data) {
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
</script>