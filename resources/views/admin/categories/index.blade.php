@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Categorías</h1>
@stop

@section('content')
    <p>Lista</p>
    <!DOCTYPE html>
    <html>
    <head>
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

            #customers tr:nth-child(even){background-color: #F4E8E8;}

            #customers tr:hover {background-color: wheat;}

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #081000;
                color: white;
            }
        </style>
    </head>
    <body>
    @include('message')
    <table id="customers">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
       </tr>
        </thead>
        <tr>
        @foreach($category as $item)
            <td>{{$item->name}}</td>
            <td><a href="{{route('CategoryController@confirm',
                ['id' => $item->getId()])}}" class="btn btn-danger ">
                    <i class="fas fa-trash-alt"></i></a>
                <a href="{{route('CategoryController@edit',
                ['id' => $item->getId()])}}" class="btn btn-success">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
@stop

