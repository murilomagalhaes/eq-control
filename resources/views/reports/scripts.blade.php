<script>
    function sendReportForm(arg) {
        // Arg = view, excel, print

        let form = document.getElementById('report_form');

        let action = document.createElement("input");
        action.name = 'action';
        action.type = "hidden";
        action.value = arg;

        form.appendChild(action);   
        form.submit();    

        

    }
</script>