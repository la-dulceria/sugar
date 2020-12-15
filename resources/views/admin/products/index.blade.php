@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Productos</h1>
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



    </head>
    <body>

    @include('message')
    <form action="{{route('ProductController@findProduct' )}}" >
        <div class="input-group">
            <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
            <input class="form-control typeahead" id="system-search"
                   name="find" placeholder="Buscar">
            <button class="btn-primary"  ><i class="fas fa-search"></i>
        </div>
    <table id="customers">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Precio</th>
            <th scope="col">Categoria</th>
            <th scope="col">
                <div >
                    <div class="row">
                        <div class="col-md-3">
                            <form action="{{route('ProductController@findProduct' )}}" >
                                <div class="input-group">
                                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                    <input class="form-control typeahead" id="system-search"
                                           name="find" placeholder="Buscar">
                                    <button class="btn-primary"  ><i class="fas fa-search"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </th>
        </tr>
        </thead>
        <tr>

            @foreach($products as $product)
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->category->name}}</td>
                <td>
                    <a class="btn btn-danger" onclick="return ConfirmDelete();"
                       href="{{route('ProductController@delete', $product->getId())}} "
                       ><i class="fa fa-trash"></i></a>
                    <a class="btn btn-success" href="{{route('ProductController@edit',['id' => $product->getId()])}}">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>

        </tr>
        @endforeach
    </table>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
            integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
            integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"
            integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w=="
            crossorigin="anonymous"></script>
    <script type="text/javascript">
        var path= "{{ route('ProductController@autoComplete') }}"
        $('input.typeahead').typeahead({
            source:function (terms,process){
                return $.get(path,{terms:terms},function(product){
                   return process(product);
                })
            }
        });

        function ConfirmDelete()
        {
            var x = confirm("Seguro que desea borrar el producto?");
            if (x)
                return true;
            else
                return false;
        }


    </script>

    </body>
@stop

