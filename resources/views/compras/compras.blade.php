@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')

    @livewireStyles    
@stop

@section('content')    

    <livewire:compras.compras-componente />


    @livewireScripts
@stop

@section('css')
    
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
        window.livewire.on('ShowCreateCompraModal', () => {
         $('#createCompraModal').modal('show');
        });       

        window.livewire.on('HideCreateCompraModal', () => {
         $('#createCompraModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditCompraModal', () => {
         $('#editCompraModal').modal('show');
        });  

         window.livewire.on('HideEditCompraModal', () => {
         $('#editCompraModal').modal('hide');
        });             
    </script>    
@stop