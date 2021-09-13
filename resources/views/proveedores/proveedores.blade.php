@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:proveedores.proveedores-componente />

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
        window.livewire.on('ShowCreateProveedorModal', () => {
         $('#createProveedorModal').modal('show');
        });       

        window.livewire.on('HideCreateProveedorModal', () => {
         $('#createProveedorModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditProveedorModal', () => {
         $('#editProveedorModal').modal('show');
        });  

         window.livewire.on('HideEditProveedorModal', () => {
         $('#editProveedorModal').modal('hide');
        });          
    </script>     
@stop