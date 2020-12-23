@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Orden de compra</h1>
@stop

@section('content')
    <p>Nueva Orden de compra</p>

<style>
    input[type=text], select {
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

<script>
    function agregarFila(){
        document.getElementById("tablaprueba").insertRow(-1).innerHTML = '<td></td><td></td><td></td><td></td>';
    }

    function eliminarFila(){
        var table = document.getElementById("tablaprueba");
        var rowCount = table.rows.length;
        //console.log(rowCount);

        if(rowCount <= 1)
            alert('No se puede eliminar el encabezado');
        else
            table.deleteRow(rowCount -1);
    }
</script>

<div class="container">
    <div class="row">
        <table border="1" class="table" id="tablaprueba">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Ap Paterno</th>
                <th>Ap Materno</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="form-group">
            <button type="button" class="btn btn-primary mr-2" onclick="agregarFila()">Agregar Fila</button>
            <button type="button" class="btn btn-danger" onclick="eliminarFila()">Eliminar Fila</button>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#select2').select2();
    });
</script>

<script>
    var names=document.getElementsByName('product');

    function InsertIntoTable()
    {
        var TableRow="<tr>=</tr>";
        for(key=0; key < names.length; key++)
            TableRow = TableRow.substring(0,TableRow.length-5) + "<td>" + names[key].value + "</td>" + TableRow.substring(TableRow.length-5);

        var TrElement = document.createElement("tr");
        TrElement.innerHTML = TableRow;
        document.getElementById("TableBody").appendChild(TrElement);
    }
</script>

<select class="form-control select2-container input-lg step2-select" style="width: 50%" id="select" name="product">
    <option disabled selected></option>
    @foreach( $products as $product)
        <option value="{{ $product->getId() }}"> {{ $product->getName() }}</option>
    @endforeach
</select>
<input type="button" value="Insert" onclick="InsertIntoTable()">

<table>
    <thead>
    <tr>
        <th>Producto</th>

    </tr>
    </thead>
    <tbody id="TableBody">
    </tbody>
</table>


<select class="form-control select2-container input-lg step2-select" style="width: 50%" id="select2" name="product_id">
    <option disabled selected></option>
    @foreach( $products as $product)
        <option value="{{ $product->getId() }}"> {{ $product->getName() }}</option>
    @endforeach
</select>
</body>

<form action="{{route('PurchaseOrderController@create' )}}" method="POST">

    @csrf
<label for="name">Direccion:</label>
<input type="text" name="direction" placeholder="Ingrese la direccion del envio">
<label for="name">Obsevaciones:</label>
<br>
<textarea type="textarea" name="observation" placeholder="Observaciones"></textarea>
<br>
<label for="name">Selecciona un envio:</label>
<select class="form-control select2-container input-lg step2-select" style="width: 50%" id="select2" name="delivery_id">
    <option disabled selected></option>
    @foreach( $deliveries as $delivery)
        <option value="{{ $delivery->getId() }}"> {{ $delivery->getName() }}</option>
    @endforeach
</select>

<button class="btn btn-primary btn-block" type="sumbit">Guardar orden de compra</button>
</form>
@stop
