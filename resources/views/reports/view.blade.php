<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Relatório de Registros</title>
</head>

<body>

    @if(isset($print))
    <style>
        * {
            font-size: 0.9em;
        }
    </style>
    @else
    <style>
        * {
            font-size: 0.95em;
        }
    </style>
    @endif

    <div class="{{isset($print) ? 'm-0' : 'm-4'}}">

        <div class="text-center fw-bold border-bottom border-dark pb-2">RELATÓRIO DE REGISTROS</div>
        <div class="text-center fw-bold pt-2">Emitido em: {{date('d/m/Y : H:i')}}</div>

        <div class="text-end my-2">
            <div><span class="fw-bold">Listando: {{$registries->count()}} registro(s).</span></div>
            <div><span>Totalizando </span> <span class="fw-bold"> {{$equip_count}} </span> Equipamento(s) </div>
        </div>

        @foreach($registries as $registry)
        <div class="border border-dark p-2 my-3">
            <div class="row">
                <div class="col-3">
                    <div> <span class="fw-bold">Registro: </span> {{$registry->id}} </div>
                    <div> <span class="fw-bold">Cliente:</span> {{$registry->customer->nome}} </div>
                    <div> <span class="fw-bold">Entregue por:</span> {{$registry->nome}} </div>
                    <div> <span class="fw-bold">Equipamentos:</span> {{$registry->equipments_count}} </div>
                </div>

                <div class="col-3">
                    <div> <span class="fw-bold">Entrada: </span> {{$registry->getFormatedDateTime('dt_entrada')}} </div>
                    <div> <span class="fw-bold">Previsão:</span> {{$registry->getFormatedDateTime('dt_previsao')}} </div>
                    <div> <span class="fw-bold">Entrega:</span> {{$registry->getFormatedDateTime('dt_entrega')}} </div>
                    <div> <span class="fw-bold">Prioridade:</span> {{$prioridades[$registry->prioridade - 1]}} </div>
                </div>

                <div class="col-3">
                    <div> <span class="fw-bold">Equipamentos: </span></div>
                    <ul>
                        @foreach($registry->equipments as $equipment)
                        <li>{{$equipment->descricao}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-3 border-start px-3">
                    <div> <span class="fw-bold">Procedimentos realizados: </span>

                        <div class="text-break">
                            {{$registry->procedimentos}} Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

                        </div>
                    </div>

                </div>

            </div>
        </div>
        @endforeach

    </div>


    @if(isset($print))
    <script>
        (function() {

            window.print();
            window.onafterprint = function() {
                window.close();
            }

        })();
    </script>
    @endif


    </script>

</body>

</html>