@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:clientes.cliente-componente />

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
        
        window.livewire.on('ShowCreateClienteModal', () => {
         $('#createClienteModal').modal('show');
        });       

        window.livewire.on('HideCreateClienteModal', () => {
         $('#createClienteModal').modal('hide');
        });                                  

        window.livewire.on('ShowEditClienteModal', () => {
         $('#editClienteModal').modal('show');
        });       

        window.livewire.on('HideEditClienteModal', () => {
         $('#editClienteModal').modal('hide');
        });
    </script>     
@stop