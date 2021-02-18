<script>
    function destroy() {

        let action = confirm('Ao deletar esse usuário, todos os registros que ele tenha criado, atualizado, ou tenha sido selecionado como um responsável também serão deletados. \n\nVocê tem certeza?');

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

    // Habilita inputs
    function enableInputs() {

        let inputs = document.getElementsByTagName("input");

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

@if(Route::is('cadastros.usuario.mostrar') && !$errors->any())
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
    enableInputs();
</script>
@endif