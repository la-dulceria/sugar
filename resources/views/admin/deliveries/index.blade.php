@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Envios</h1>
@stop

@section('content')
    <p>Lista</p>

        <style>
            #customers {
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                border-collapse: collapse;
                color: darkblue;
                width: 100%;
            }

            #customers td, #customers th {
                border: 1px solid black;
                padding: 8px;
            }

            #customers tr:nth-child(even) {
                background-color: #F4E8E8;
            }

            #customers tr:hover {
                background-color: wheat;
            }

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #081000;
                color: white;
            }
        </style>

    @include('message')

        <table id="customers">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha</th>
                <th scope="col">
                </th>
            </tr>
            </thead>
            <tr>

                @foreach($deliveries as $delivery)
                    <td>{{$delivery->name}}</td>
                    <td>{{$delivery->getDate()->format('d/m/Y')}}</td>
                    <td>
                        <a class="btn btn-danger" onclick="return ConfirmDelete();"
                           href="{{route('DeliveryController@delete', $delivery->getId())}} ">
                            <i class="fa fa-trash"></i></a>
                        <a class="btn btn-success"
                           href="{{route('DeliveryController@edit',['id' => $delivery->getId()])}}">
                            <i class="fas fa-edit"></i>
                        </a>

                    </td>

            </tr>
            @endforeach
        </table>

    <script>
        function ConfirmDelete()
        {
            var x = confirm("Seguro que desea borrar el Envio?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

@stop
