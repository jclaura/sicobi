@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:ventas.caja-error-componente />

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
        window.livewire.on('ShowCajaModal', () => {
         $('#cajaModal').modal('show');
        });       

        window.livewire.on('HideCajaModal', () => {
         $('#cajaModal').modal('hide');
        });                           
    </script>     
@stop