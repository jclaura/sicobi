@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:categorias.categorias-componente />

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
        window.livewire.on('ShowCreateCategoriaModal', () => {
         $('#createCategoriaModal').modal('show');
        });       

        window.livewire.on('HideCreateCategoriaModal', () => {
         $('#createCategoriaModal').modal('hide');
        });  

        /*VENTANA MODAL EDIT*/
        window.livewire.on('ShowEditCategoriaModal', () => {
         $('#editCategoriaModal').modal('show');
        });  

         window.livewire.on('HideEditCategoriaModal', () => {
         $('#editCategoriaModal').modal('hide');
        });             
    </script>     
@stop