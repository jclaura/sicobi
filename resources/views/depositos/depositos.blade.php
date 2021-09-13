@extends('adminlte::page')

@section('title', 'Depósitos')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:depositos.depositos-componente />

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
        window.livewire.on('ShowCreateDepositoModal', () => {
         $('#createDepositoModal').modal('show');
        });       

        window.livewire.on('HideCreateDepositoModal', () => {
         $('#createDepositoModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditDepositoModal', () => {
         $('#editDepositoModal').modal('show');
        });  

         window.livewire.on('HideEditDepositoModal', () => {
         $('#editDepositoModal').modal('hide');
        });             
    </script>     
@stop