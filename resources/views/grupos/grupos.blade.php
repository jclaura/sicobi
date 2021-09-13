@extends('adminlte::page')

@section('title', 'Clasificación')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:grupos.grupos-componente />

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
        window.livewire.on('ShowCreateGrupoModal', () => {
         $('#createGrupoModal').modal('show');
        });       

        window.livewire.on('HideCreateGrupoModal', () => {
         $('#createGrupoModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditGrupoModal', () => {
         $('#editGrupoModal').modal('show');
        });  

         window.livewire.on('HideEditGrupoModal', () => {
         $('#editGrupoModal').modal('hide');
        });             
    </script>     
@stop