<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(array('prefix'=>'api/v1.0'), function () {//utilizar un prefijo para obtener versiones de la api
    Route::resource('vehiculos', 'VehiculoController', ['only'=>['index','show']]);
    Route::resource('fabricantes.vehiculos', 'FabricanteVehiculoController', ['except'=>['show','edit','create']]);
    Route::resource('fabricantes', 'FabricantesController', ['except'=>['edit','create']]);
});

Route::pattern('inexistente', '.*');
Route::any('/{inexistente}', function () {
    return response()->json(['mensaje'=>'Ruta y/o metodos incorrectos'], 400);
});
