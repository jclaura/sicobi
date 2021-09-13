@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:pagos.pagos-componente />

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
        window.livewire.on('ShowCreatePagoModal', () => {
         $('#createPagoModal').modal('show');
        });       

        window.livewire.on('HideCreatePagoModal', () => {
         $('#createPagoModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditPagoModal', () => {
         $('#editPagoModal').modal('show');
        });  

         window.livewire.on('HideEditPagoModal', () => {
         $('#editPagoModal').modal('hide');
        });             
    </script>     
@stop