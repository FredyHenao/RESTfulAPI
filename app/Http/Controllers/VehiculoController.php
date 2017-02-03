<?php

namespace Apis\Http\Controllers;

use Illuminate\Http\Request;
use Apis\Vehiculo;

class VehiculoController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos =Vehiculo::simplePaginate(15);
        return  response()->json(['siguiente'=>$vehiculos->nextPageUrl(),'anterior'=>$vehiculos->previousPageUrl(),'datos' => $vehiculos], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['mensaje'=>'No se encuentra el vehiculo'], 404);
        }
        return response()->json(['datos'=>$vehiculo], 200);
    }
}
