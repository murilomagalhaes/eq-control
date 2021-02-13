<table class="table" style=" border: 1px solid black">
    <thead>
        <tr style="color: yellowgreen;">
            <th scope="col" style="background-color: yellowgreen;">ID</th>
            <th scope="col" style="background-color: yellowgreen;">Cliente</th>
            <th scope="col" style="background-color: yellowgreen;">Entregue Por</th>
            <th scope="col" style="background-color: yellowgreen;">Entrada</th>
            <th scope="col" style="background-color: yellowgreen;">Previsao</th>
            <th scope="col" style="background-color: yellowgreen;">Entrega</th>
        </tr>
    </thead>
    <tbody>
    <tr><td colspan="6"></td></tr>
        @foreach($registries as $i => $registry)
        <tr>
            <th scope="row">{{$i + 1}}</th>
            <td>{{$registry->customer->nome}}</td>
            <td>{{$registry->nome}}</td>
            <td>{{$registry->getFormatedDateTime('dt_entrada')}}</td>
            <td>{{$registry->getFormatedDateTime('dt_previsao')}}</td>
            <td>{{$registry->getFormatedDateTime('dt_entrega')}}</td>
        </tr>

        <tr></tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <th colspan="6" style="font-weight: bold; ">Equipamentos:</th>
                    </tr>

                    <tr>
                        @foreach($registry->equipments as $equipment)
                        <td>{{$equipment->descricao}}</td>
                        @endforeach
                    </tr>

                </table>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>