<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Entregue Por</th>
            <th scope="col">Equipamentos</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registries as $i => $registry)
        <tr>
            <th scope="row">{{$i + 1}}</th>
            <td>{{$registry->customer->nome}}</td>
            <td>{{$registry->nome}}</td>
            <td>999</td>
        </tr>
        @endforeach

    </tbody>
</table>