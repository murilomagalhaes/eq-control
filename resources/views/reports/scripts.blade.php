<script>
    function sendReportForm(arg) {
        // Arg = view, excel, print

        let form = document.getElementById('report_form');

        let action = document.createElement("input");
        action.name = 'action';
        action.type = "hidden";
        action.value = arg;

        if (arg == 'view' || arg == 'print') {
            form.target = '_blank';
        } else {
            form.target = '';
        }

        form.appendChild(action);
        form.submit();



    }
</script>