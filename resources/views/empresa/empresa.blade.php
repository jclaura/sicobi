@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')

    @livewireStyles    
@stop

@section('content')   

    <livewire:empresa.empresa-componente />

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
        window.livewire.on('ShowEditEmpresaModal', () => {
         $('#editEmpresaModal').modal('show');
        });       

        window.livewire.on('HideEditEmpresaModal', () => {
         $('#editEmpresaModal').modal('hide');
        });  
                    
    </script>     
@stop