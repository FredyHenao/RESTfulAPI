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
        $vehiculo = new Vehiculo;
        $faker = Faker::create();
        $cantidad = Fabricante::all()->count();

        for ($i=0;$i<50;$i++) {
            $vehiculo->color = $faker->safeColorName();
            $vehiculo->cilindraje = $faker->randomFloat(3);
            $vehiculo->potencia = $faker->randomNumber(7);
            $vehiculo->peso = $faker->randomFloat(2);
            $vehiculo->fabricante_id = $faker->numberBetween(1, $cantidad);
            $vehiculo->save();
        }
    }
}
