@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Ordenes de compras</h1>
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
            <th scope="col">Envio</th>
            <th scope="col">Direccion</th>
            <th scope="col">Productos</th>
            <th scope="col">Precio final</th>
            <th scope="col">Observaciones</th>
            <th scope="col">
            </th>
        </tr>
        </thead>
        <tr>

            @foreach($orders as $order)
                <td>{{$order->delivery->name}}</td>
                <td>{{ $order->direction }}</td>
                <td>
                    <ul>
                    @foreach($order->details as $detail)
                        <li>{{ $detail->getQuantity() }} {{ $detail->product->name }} a ${{ $detail->getUnitPrice() }} c/u</li>
                    @endforeach
                    </ul>
                </td>
                <td>${{$order->finalPrice}}</td>
                <td>{{$order->observation}}</td>
                <td>
                    <a class="btn btn-danger" onclick="return ConfirmDelete();"
                       href="{{route('PurchaseOrderController@delete', $order->id)}} ">
                        <i class="fa fa-trash"></i></a>
                </td>

        </tr>
        @endforeach
    </table>

    <script>
        function ConfirmDelete()
        {
            var x = confirm("Seguro que desea borrar la orden?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

@stop
