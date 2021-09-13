@extends('adminlte::page')

@section('title', 'Giros')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:giros.giros-componente />

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
        window.livewire.on('ShowCreateGiroModal', () => {
         $('#createGiroModal').modal('show');
        });       

        window.livewire.on('HideCreateGiroModal', () => {
         $('#createGiroModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditGiroModal', () => {
         $('#editGiroModal').modal('show');
        });  

         window.livewire.on('HideEditGiroModal', () => {
         $('#editGiroModal').modal('hide');
        });             
    </script>     
@stop