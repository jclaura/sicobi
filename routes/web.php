<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
/**************************************************************
 ******         RUTAS DEL MODULO IMPORTACIONES            *****
***************************************************************/
Route::group(['middleware' => 'admin'], function () {   
    Route::get('/proveedores', function () {
        return view('proveedores.proveedores');
    })->name('proveedores');
    
    Route::get('/compras', function () {
        return view('compras.compras');
    })->name('compras');

    Route::get('/productos', function () {
        return view('productos.productos');
    })->name('productos')->middleware('auth');
    
    Route::get('/pagos', function () {
        return view('pagos.pagos');
    })->name('pagos');
    
    Route::get('/giros', function () {
        return view('giros.giros');
    })->name('giros');
});

/**************************************************************
 ******         RUTAS DEL MODULO INVENTARIOS              *****
***************************************************************/
Route::group(['middleware' => 'admin'], function () {   
    Route::get('/depositos', function () {
        return view('depositos.depositos');
    })->name('depositos');
    
    Route::get('/grupos', function () {
        return view('grupos.grupos');
    })->name('grupos');
    
    Route::get('/tiendas', function () {
        return view('tiendas.tiendas');
    })->name('tiendas');
    
    Route::get('/categorias', function () {
        return view('categorias.categorias');
    })->name('categorias');
    
    Route::get('/stock', function () {
        return view('stock.stock');
    })->name('stock');
    
    Route::get('/entradas', function () {
        return view('entradas.entradas');
    })->name('entradas');
    
    Route::get('/salidas', function () {
        return view('salidas.salidas');
    })->name('salidas');    
});

/**************************************************************
 ******         RUTAS DEL MODULO VENTAS                 *****
***************************************************************/
Route::get('/ventas', function () {
    return view('ventas.ventas');
})->name('ventas');

Route::get('/caja-error', function () {
    return view('ventas.caja-error');
})->name('caja-error');

Route::get('/reportes', function () {
    return view('ventas.reportes');
})->name('reportes');

//IMPRIME RECIBO
Route::get('/recibo-pdf/{ventaId}', [App\Http\Livewire\Ventas\ReciboComponente::class, 'livewirePDF'])->name('recibo');

/**************************************************************
 ******         RUTAS DEL MODULO USUARIOS                 *****
***************************************************************/
Route::group(['middleware' => 'admin'], function () {   
    Route::get('/usuarios', function () {
        return view('usuarios.usuarios');
    })->name('usuarios');
    
    Route::get('/empresa', function () {
        return view('empresa.empresa');
    })->name('empresa');    
});

/**************************************************************
 ******         RUTAS DEL MODULO CLIENTES                 *****
***************************************************************/
Route::get('/clientes', function () {
    return view('clientes.clientes');
})->name('clientes');