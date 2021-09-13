@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:entradas.entradas-componente />

    @livewireScripts      
@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')    
    {{--NECESARIO PARA EJECUTAR JAVASCRIPT EN ARCHIVO COMPONENTE BLADE.PHP--}}
    @stack('scripts')    

    <script type="text/javascript">
        /*MENSAJES TOASTR*/
        window.livewire.on('alert', param => {
            toastr[param['type']](param['type'],param['message']);
        });  

        /*VENTANA MODAL CREATE*/
        window.livewire.on('ShowCreateEntradaModal', () => {
         $('#createEntradaModal').modal('show');
        });       

        window.livewire.on('HideCreateEntradaModal', () => {
         $('#createEntradaModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditEntradaModal', () => {
         $('#editEntradaModal').modal('show');
        });  

         window.livewire.on('HideEditEntradaModal', () => {
         $('#editEntradaModal').modal('hide');
        });             
    </script>     
@stop