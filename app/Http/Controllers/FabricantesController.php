<?php

namespace Apis\Http\Controllers;

use Illuminate\Http\Request;
use Apis\Fabricante;
use Illuminate\Support\Facades\Cache;

class FabricantesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic.one', ['only'=>['store','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fabricantes= Cache::remember('tb_fabricantes', 30/60, function () {
            return Fabricante::simplePaginate(15);
        });
        return  response()->json(['siguiente'=>$fabricantes->nextPageUrl(),'anterior'=>$fabricantes->previousPageUrl(),'datos' => $fabricantes], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->nombre || !$request->telefono) {
            return response()->json(['mensaje'=>'No se pudieron procesar los valores'], 422);
        }
        $datos = new Fabricante;
        $datos->nombre= $request->nombre;
        $datos->telefono= $request->telefono;
        $datos->save();
        //Fabricante::all($request->all());
        //Fabricante::save();
        return response()->json(['mensaje'=>'Fabricante insertado'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra el fabricante'], 404);
        }
        return response()->json(['datos'=>$fabricante], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $metodo = $request->method();
        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra el fabricante'], 404);
        }
        if ($metodo === 'PATCH') {
            $bandera = false;
            $nombre = $request->nombre;
            if ($nombre != null && $nombre != '') {
                $fabricante->nombre = $nombre;
                $bandera = true;
            }
            $telefono = $request->telefono;
            if ($telefono != null && $telefono != '') {
                $fabricante->telefono = $telefono;
                $bandera = true;
            }
            if ($bandera) {
                $fabricante->save();
                return response()->json(['mensaje'=>'Fabricante editado'], 200);
            }
            return response()->json(['mensaje'=>'No se Modifico ningun fabricante'], 200);
        }
        $nombre = $request->nombre;
        $telefono = $request->telefono;
        if (!$nombre || !$telefono) {
            return response()->json(['mensaje'=>'No se pudieron procesar los valores'], 422);
        }
        $fabricante->nombre = $nombre;
        $fabricante->telefono = $telefono;
        $fabricante->save();
        //el metodo patch modifica los campos que quiera
        //el metodo put modifica todos los campos
        return response()->json(['mensaje'=>'Fabricante editado'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra el fabricante'], 404);
        }
        $vehiculo = $fabricante->vehiculos;
        if (sizeof($vehiculo) > 0) {
            return response()->json(['mensaje'=>'Este fabricante posee vehiculos asociados, debera eliminar primero los vehiculos'], 409);
        }
        $fabricante->delete();
        return response()->json(['mensaje'=>'Fabricante eliminado'], 200);
    }
}
