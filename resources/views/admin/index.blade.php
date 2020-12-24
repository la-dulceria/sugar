@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('message')
    <p>Bienvenido al panel de administración de La Dulcería!</p>
    <img src="{{ e(asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png'))) }}" width="50%"/>
@stop

@section('css')
@stop

@section('js')
@stop
