@extends('adminlte::page')

@section('title', 'Salidas')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:salidas.salidas-componente />

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
    </script>     
@stop