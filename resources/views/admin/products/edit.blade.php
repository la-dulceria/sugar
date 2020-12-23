@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')
    <p>Editar Producto</p>

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


<script type="text/javascript">
    $(document).ready(function () {
        $('#select2').select2();
    });

</script>

@include('message')
@include('errors')

<form action="{{route('ProductController@update', ['id'=>$products->getId()])}}" method="POST">
    @method('PUT')
    @csrf

    <label for="name">Nombre</label>
    <input type="text" name="name" placeholder="Ingrese el nombre de la categoria"
           value="{{$products->getName()}}">
    <label for="name">Descripcion</label>
    <input type="text" name="description" placeholder="Ingrese la descricion del producto"
           value="{{$products->getDescription()}}">
    <label for="name">Precio</label>
    <input type="text" name="price" placeholder="Ingrese el precio del producto"
           value="{{$products->getPrice()}}">
    <label for="name">Categoria</label>
    <select class="form-control select2-container input-lg step2-select" style="width: 50%" id="select2"
            name="category_id">
        <option disabled selected>Seleccione una categoria</option>
        @foreach($categories as $category)
            <option value="{{ $category->getId() }}"
                {{$category->id === $products->category->id ? "selected" : "" }}> {{ $category->getName() }}</option>
        @endforeach
    </select>
    <input type="submit" value="Editar">
</form>

@stop
