@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Orden de compra</h1>
@stop

@section('content')
    <p>Nueva Orden de compra</p>

<style>

    #tabla_productos {
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        border-collapse: collapse;
        color: darkblue;
        width: 100%;
    }

    #tabla_productos td, #tabla_productos th {
        border: 1px solid black;
        padding: 8px;
    }

    #tabla_productos tr:nth-child(even) {
        background-color: #F4E8E8;
    }

    #tabla_productos tr:hover {
        background-color: wheat;
    }

    #tabla_productos th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #081000;
        color: white;
    }

    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>

    @include('message')
    @include('errors')

    <form role="form" id="form-orden" class="form-horizontal" action="{{route('PurchaseOrderController@create' )}}" method="POST">
        @csrf
        <div class="box-body">
            <div class="alert alert-danger" hidden>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>¡Error!</strong> Debe agregar productos a la orden.
            </div>

                <label for="direccion" class="col-sm-2 control-label">Dirección</label>
                <input type="text" id="direccion" name="direction"/>

                <label for="observation" class="col-sm-2 control-label">Observaciones</label>
                <textarea type="text" id="observation" name="observation" placeholder="Observaciones"></textarea>

                <label for="select2">Selecciona un envio:</label>
                <select class="form-control select2-container input-lg step2-select" style="width: 50%" id="select2" name="delivery_id">
                    @foreach( $deliveries as $delivery)
                        <option value="{{ $delivery->getId() }}"> {{ $delivery->getName() }}</option>
                    @endforeach
                </select>

                <hr>
                <label for="producto"
                       class="col-sm-2 control-label">Productos</label>
                <select class="form-control select2" id="product_id" style="width: 100%">
                    <option disabled selected value="">Seleccione un producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->getId() }}">
                            {{ $product->getName() }}
                        </option>
                    @endforeach
                </select>

                <input type="number" class="form-control" id="quantity" name="quantity"
                       placeholder="Cantidad"
                       value="{{ old('quantity') ?? 1}}">

                <input type="text" class="form-control" id="unitPrice"
                       name="unitPrice"
                       placeholder="Precio unitario"
                       value="{{ old('unitPrice') }}">

                    <a id="agregar_producto"
                       class="btn bg-green pull-right">Agregar</a>

<br><br>
            <table id="tabla_productos">
                <thead>
                <tr>
                    <th class="text-center" style="width: 20%">
                        ID
                    </th>
                    <th class="text-center" style="width: 50%">
                        Producto
                    </th>
                    <th class="text-center" style="width: 10%">
                        Cantidad
                    </th>
                    <th class="text-center" style="width: 15%">
                        Precio cada 100 gr.
                    <th class="text-center"
                        style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;"
                        style="width: 5%">
                    </th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <hr>

            <label for="total">Total: $</label>
            <input type="text" class="form-control" id="total" name="total"
                   placeholder="Importe total"
                   value="{{ old('total') }}">
        </div>

        <div class="box-footer">
            <button type="button" id="btn-guardar" class="btn btn-info btn-block">
                Guardar
            </button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {

            $('#product_id').change(function () {
                var productId = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: '/admin/products/info/' + productId,
                    contentType: "application/json; charset=utf-8",
                    dataType: "JSON",
                    success: function (result) {
                        $('#unitPrice').val(result.price);
                    },
                });
            });

            $("#btn-guardar").click(function () {
                var rowCount = $('#tabla_productos >tbody >tr').length;
                if (rowCount > 0) {
                    $("#form-orden").submit();
                }
                else {
                    alert("Debes agregar productos")
                }
            });

            $("#agregar_producto").click(function () {
                $("#tabla_productos").show();


                if (!$("#product_id option:selected").val()) {
                    alert("¡Debe seleccionar un producto!")
                }

                else {
                    var rowCount = $('#tabla_productos >tbody >tr').length;

                    var idProducto = $("#product_id option:selected").val();
                    var nombreProducto = $("#product_id option:selected").text();

                    var cantidad = $('#quantity').val();
                    var precio_unitario = $('#unitPrice').val();

                    console.log($('#unitPrice').val());

                    var id = rowCount;

                    var cadena = '<tr id=' + id + '>';
                    cadena += '<td>';
                    cadena += '<input type="text" name="products[]" value="' + idProducto + '" class="form-control" id="id-' + id + '" readonly/>';
                    cadena += '</td>';
                    cadena += '<td data-name="name">';
                    cadena += '<input type="text" value="' + nombreProducto + '" class="form-control" disabled/>';
                    cadena += '</td>';
                    cadena += '<td>';
                    cadena += '<input type = "text" name = "quantities[]" value="' + cantidad + '" class = "form-control" id="cantidad-' + id + '"/>';
                    cadena += '</td>';
                    cadena += '<td>';
                    cadena += '<input type = "text" name = "prices[]" value="' + precio_unitario + '" class = "form-control"  id="precio-' + id + '"/>';
                    cadena += '</td>';
                    cadena += '<td>';
                    cadena += '<button id="del' + id + '" class= "btn btn-danger glyphicon glyphicon-remove row-remove">X</button>';
                    cadena += '</td>';
                    cadena += '</tr>';

                    $('#tabla_productos tbody').append(cadena);

                    $('#del' + id + '').on("click", function () {
                        $(this).closest("tr").remove();
                        actualizarImporte();
                    });

                    $('#cantidad-' + id + '').bind('input', function () {
                        actualizarImporte();
                    });

                    $('#precio-' + id + '').bind('input', function () {
                        actualizarImporte();
                    });

                    actualizarImporte();
                }
            });

            function actualizarImporte() {
                var importe = 0;

                $("#tabla_productos tbody tr").each(function () {
                    cantidad = $('#cantidad-' + this.id + '').val();
                    precio = $('#precio-' + this.id + '').val();

                    importe += cantidad * precio;
                });

                $('#total').val(importe);
            }
        });
    </script>

@stop
