@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:ventas.ventas-componente />

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
        
        window.livewire.on('ShowCajaModal', () => {
         $('#cajaModal').modal('show');
        });       

        window.livewire.on('HideCajaModal', () => {
         $('#cajaModal').modal('hide');
        });                           

        window.livewire.on('ShowGastosModal', () => {
         $('#gastosModal').modal('show');
        });       

        window.livewire.on('HideGastosModal', () => {
         $('#gastosModal').modal('hide');
        });  

        window.livewire.on('ShowClienteModal', () => {
         $('#clienteModal').modal('show');
        });       

        window.livewire.on('HideClienteModal', () => {
         $('#clienteModal').modal('hide');
        }); 

        window.livewire.on('refreshPage', () => {
            document.location.reload(true)
        }); 
    </script>     
@stop