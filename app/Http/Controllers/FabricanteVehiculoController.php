<?php

namespace Apis\Http\Controllers;

use Illuminate\Http\Request;
use Apis\Vehiculo;
use Apis\Fabricante;

class FabricanteVehiculoController extends Controller
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
    public function index($id)
    {
        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra el fabricante'], 404);
        }
        return response()->json(['datos'=>$fabricante->vehiculos], 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idFabricante, $idVehiculo)
    {
        $metodo = $request->method();
        $fabricante = Fabricante::find($idFabricante);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra el fabricante'], 404);
        }
        $vehiculo = $fabricante->vehiculos()->find($idVehiculo);
        if (!$vehiculo) {
            return response()->json(['mensaje'=>'No se encuentra el vehiculo asociado al fabricante'], 404);
        }
        $color = $request->color;
        $cilindraje = $request->cilindraje;
        $potencia = $request->potencia;
        $peso = $request->peso;

        if ($metodo === 'PATCH') {
            $bandera = false;
            if ($color != null && $color != '') {
                $vehiculo->color = $color;
                $bandera = true;
            }
            if ($cilindraje != null && $cilindraje != '') {
                $vehiculo->cilindraje = $cilindraje;
                $bandera = true;
            }
            if ($potencia != null && $potencia != '') {
                $vehiculo->potencia = $potencia;
                $bandera = true;
            }
            if ($peso != null && $peso != '') {
                $vehiculo->peso = $peso;
                $bandera = true;
            }
            if ($bandera) {
                $vehiculo->save();
                return response()->json(['mensaje'=>'Vehiculo editado'], 200);
            }
            return response()->json(['mensaje'=>'No se Modifico ningun vehiculo'], 200);
        }

        if (!$color || !$cilindraje || !$potencia || !$peso) {
            return response()->json(['mensaje'=>'No se pudieron procesar los valores'], 422);
        }
        $vehiculo->color = $color;
        $vehiculo->cilindraje = $cilindraje;
        $vehiculo->potencia = $potencia;
        $vehiculo->peso = $peso;
        $vehiculo->save();
      //el metodo patch modifica los campos que quiera
      //el metodo put modifica todos los campos
      return response()->json(['mensaje'=>'Vehiculo editado'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idFabricante, $idVehiculo)
    {
        $fabricante = Fabricante::find($idFabricante);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra el fabricante'], 404);
        }
        $vehiculo = $fabricante->vehiculos()->find($idVehiculo);
        if (!$vehiculo) {
            return response()->json(['mensaje'=>'No se encuentra el vehiculo asociado al fabricante'], 404);
        }
        $vehiculo->delete();
        return response()->json(['mensaje'=>'Vehiculo eliminado'], 200);
    }
}
