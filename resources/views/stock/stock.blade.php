@extends('adminlte::page')

@section('title', 'Stock')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:stock.stock-componente />

    @livewireScripts      
@stop

@section('css')   
    <style>
        .blink_me {
        animation: blinker 1s linear infinite;
        }

        @keyframes blinker {  
        50% { opacity: 0; }
        }
    </style>
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
        window.livewire.on('ShowCreateStockModal', () => {
         $('#createTiendaModal').modal('show');
        });       

        window.livewire.on('HideCreateStockModal', () => {
         $('#createStockModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditStockModal', () => {
         $('#editStockModal').modal('show');
        });  

         window.livewire.on('HideEditStockModal', () => {
         $('#editStockModal').modal('hide');
        });             

        window.livewire.on('ShowSalidaStockModal', () => {
         $('#salidaStockModal').modal('show');
        });  

        window.livewire.on('HideSalidaStockModal', () => {
         $('#salidaStockModal').modal('hide');
        });     
    </script>     
@stop