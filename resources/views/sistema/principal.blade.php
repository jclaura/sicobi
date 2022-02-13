@extends('adminlte::page')

@section('title', 'Dashboard2')

@section('content_header')

    @livewireStyles
    
@stop

@section('content')    

    <livewire:sistema.principal-componente />


    @livewireScripts
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop