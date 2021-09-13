@extends('adminlte::page')

@section('title', 'Tiendas')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:tiendas.tiendas-componente />

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
        window.livewire.on('ShowCreateTiendaModal', () => {
         $('#createTiendaModal').modal('show');
        });       

        window.livewire.on('HideCreateTiendaModal', () => {
         $('#createTiendaModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditTiendaModal', () => {
         $('#editTiendaModal').modal('show');
        });  

         window.livewire.on('HideEditTiendaModal', () => {
         $('#editTiendaModal').modal('hide');
        });             
    </script>     
@stop