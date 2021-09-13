@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:productos.productos-componente />

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
        window.livewire.on('ShowCreateProductoModal', () => {
         $('#createProductoModal').modal('show');
        });       

        window.livewire.on('HideCreateProductoModal', () => {
         $('#createProductoModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditProductoModal', () => {
         $('#editProductoModal').modal('show');
        });  

         window.livewire.on('HideEditProductoModal', () => {
         $('#editProductoModal').modal('hide');
        });             
    </script>     
@stop