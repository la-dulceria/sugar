@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Categorías</h1>
@stop

@section('content')
    <div class="container py-5">
        <h1>¿Desea borrar la categoría {{ $category->getName() }}? </h1>

        <form action="{{route('CategoryController@delete',['id'=>$category->getId()]) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="redondo btn btn-danger">
                Eliminar
            </button>
            <a class="redondo btn btn-secondary" href="{{ route('CategoryController@index') }}">Cancelar</a>
        </form>
    </div>

@stop
