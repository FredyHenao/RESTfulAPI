<?php

use Illuminate\Database\Seeder;
use Apis\Fabricante;
use Apis\Vehiculo;
use Faker\Factory as Faker;

class VehiculoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<500;$i++) {
            $vehiculo = new Vehiculo;
            $faker = Faker::create();
            $cantidad = Fabricante::all()->count();
            $vehiculo->color = $faker->safeColorName();
            $vehiculo->cilindraje = 30;
            $vehiculo->potencia = $faker->randomNumber(7);
            $vehiculo->peso = 20;
            $vehiculo->fabricante_id = $faker->numberBetween(1, $cantidad);
            $vehiculo->save();
        }
    }
}
