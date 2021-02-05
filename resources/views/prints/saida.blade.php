<?php //include public_path() . '/prints/ENTREGA.HTML'; 
?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Comprovante de Saída/Devolução de Equipamentos</title>
</head>

<body>

    <style>
        * {
            font-size: 0.9em;
        }
    </style>

    <div class="text-center fw-bold border-bottom border-dark pb-2">REGISTRO DE SAÍDA/DEVOLUÇÃO DE EQUIPAMENTOS</div>

    <div class="text-end my-2">
        <div><span class="fw-bold">Registro: {{$registry->id}}</span></div>
        <div><span class="fw-bold">{{$registry->equipments->count()}}</span> <span>Equipamento(s) </span> </div>
        <div><span class="fw-bold">Prioridade:</span> <span>{{$prioridades[$registry->prioridade - 1]}} </span></div>
    </div>

    <div class="border border-dark p-2 my-3 fs-4">
        <div class="d-flex justify-content-between">
            <span class="text-start"><span class="fw-bold">Data da Entrada:</span> {{$registry->getFormatedDateTime('dt_entrada')}}</span>
            <span class="text-end"> <span class=fw-bold>Data da Entrega: </span> {{$registry->getFormatedDateTime('dt_entrega')}}</span>
        </div>
    </div>

    <div class="border border-dark p-2">
        <div> <span class="fw-bold">Razão Social:</span> {{$registry->customer->razao}} </div>
        <div> <span class="fw-bold">CPF/CNPJ:</span> {{$registry->customer->cpf_cnpj}} </div>
        <div> <span class="fw-bold">Entregue por:</span> {{$registry->nome}} </div>
        <div> <span class="fw-bold">Telefone:</span> {{$registry->telefone}} </div>
    </div>
   

    @foreach($registry->equipments as $i => $equipment)
    <div class="border border-dark p-2 my-3">
        <div class="border-bottom border-dark pb-2"> <span class="fw-bold"> Equipamento {{$i + 1}}: {{$equipment->descricao}} </span></div>
        <div> <span class="fw-bold">Tipo: </span>{{$equipment->type->nome}}</div>
        <div> <span class="fw-bold">Marca: </span>{{$equipment->brand->nome}}</div>
        <div> <span class="fw-bold">Num. Série: </span>{{$equipment->num_serie ?? 'Nenhum.'}}</div>
        <div class="fw-bold border-top border-dark pt-1">Problemas:</div>
        <div>{{$equipment->problemas}}</div>
    </div>

    <div class="border border-dark p-2">
        <div class="fw-bold">Procedimentos Realizados:</div>
        <div>{{$registry->procedimentos}}</div>
    </div>

    @if($loop->last)

    <div class="row mt-4 pt-4">

        <div class="col-6 mt-4 pt-4">
            <div class="mx-2 border-top border-dark"></div>
            <div class="text-center">Assinatura do Cliente/Recebedor</div>
        </div>

        <div class="col-6 mt-4 pt-4">
            <div class="mx-2 border-top border-dark"></div>
            <div class="text-center">Assinatura da Loja</div>
        </div>

    </div>

    @endif


    @endforeach


    <script>
        (function() {

            window.print();
            window.onafterprint = function() {
                window.close();
            }

        })();
    </script>
</body>

</html>