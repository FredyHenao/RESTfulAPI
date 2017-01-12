<?php

namespace Apis\Http\Controllers;

use Illuminate\Http\Request;
use Apis\Vehiculo;
use Apis\Fabricante;

class FabricanteVehiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic', ['only'=>['store','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra el fabricante'], 404);
        }
        return response()->json(['datos'=>$fabricante->vehiculos], 200);
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
    public function store(Request $request, $id)
    {
        if (!$request->color || !$request->cilindraje || !$request->potencia || !$request->peso) {
            return response()->json(['mensaje'=>'No se pudieron procesar los valores'], 422);
        }
        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No existe el fabricante asociado'], 404);
        }
        $vehiculos = new Vehiculo();
        $vehiculos->color = $request->color;
        $vehiculos->cilindraje = $request->cilindraje;
        $vehiculos->potencia = $request->potencia;
        $vehiculos->peso = $request->peso;
        $vehiculos->fabricante_id = $request->fabricante_id;
        $fabricante->vehiculos()->save($vehiculos);
        return response()->json(['mensaje'=>'Vehiculo insertado'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
