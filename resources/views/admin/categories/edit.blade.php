@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Categorías</h1>
@stop

@section('content')
    <p>Editar categoria</p>
@section('css')
@stop

<html>
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
<body>

@include('message')
@include('errors')
<form action="{{route('CategoryController@update',['id'=>$category->getId()])}}" method="POST">
    @method('PUT')
    @csrf

    <label for="name">Nombre</label>
    <input type="text" name="name" placeholder="Ingrese el nombre de la categoria"
            value="{{$category->getName()}}">
    <input type="submit" value="Editar">
</form>


</body>
</html>

@stop