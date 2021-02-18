<table>
    <thead>
         <tr>
            <th scope="col" style="background-color: lightgray;">ID</th>
            <th scope="col" style="background-color: lightgray;">Cliente</th>
            <th scope="col" style="background-color: lightgray;">Entregue Por</th>
            <th scope="col" style="background-color: lightgray;">Entrada</th>
            <th scope="col" style="background-color: lightgray;">Previsao</th>
            <th scope="col" style="background-color: lightgray;">Entrega</th>
        </tr>
        <tr>
            <th colspan="6"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($registries as $i => $registry)
        <tr>
            <th scope="row" style="border-top: 1px solid #000000;">{{$registry->id}}</th>
            <td style="border-top: 1px solid #000000;">{{$registry->customer->nome}}</td>
            <td style="border-top: 1px solid #000000;">{{$registry->nome}}</td>
            <td style="border-top: 1px solid #000000;">{{$registry->getFormatedDateTime('dt_entrada')}}</td>
            <td style="border-top: 1px solid #000000;">{{$registry->getFormatedDateTime('dt_previsao')}}</td>
            <td style="border-top: 1px solid #000000;">{{$registry->getFormatedDateTime('dt_entrega')}}</td>
        </tr>

        <tr></tr>
        
        <tr>
            <td>
                <table>
                    <tr>
                        <th colspan="6" style="font-weight: bold; border-top: 1px solid #000000;">Equipamentos:</th>
                    </tr>

                    <tr>
                        @foreach($registry->equipments as $equipment)
                        <td>{{$equipment->descricao}}</td>
                        @endforeach
                    </tr>

                    <tr>
                        <td colspan="6" style="border-top: 1px solid #000000;"></td>
                    </tr>

                </table>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>