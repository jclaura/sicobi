@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:usuarios.usuarios-componente />

    @livewireScripts      
@stop

@section('css')
   
@stop

@section('js')   
    {{--NECESARIO PARA EJECUTAR JAVASCRIPT EN ARCHIVO COMPONENTE BLADE.PHP--}}
    @stack('scripts')   
    
    <script type="text/javascript">
        /*MENSAJES TOASTR*/
        window.livewire.on('alert', param => {
            toastr[param['type']](param['type'],param['message']);
        }); 

        /*VENTANAS MODAL*/
        window.livewire.on('ShowCreatePerfilModal', () => {
         $('#createPerfilModal').modal('show');
        });       

        window.livewire.on('HideCreatePerfilModal', () => {
         $('#createPerfilModal').modal('hide');
        });  

        window.livewire.on('ShowEditPerfilModal', () => {
         $('#showPerfilModal').modal('show');
        });       

        window.livewire.on('HideEditPerfilModal', () => {
         $('#showPerfilModal').modal('hide');
        });

        window.livewire.on('HideCreateUsuarioModal', () => {
         $('#createUsuarioModal').modal('hide');
        });    
    </script>
@stop