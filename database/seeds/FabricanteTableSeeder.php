<?php

use Illuminate\Database\Seeder;
use Apis\Fabricante;
use Faker\Factory as Faker;

class FabricanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<100;$i++) {
            $fabricante = new Fabricante;
            $faker = Faker::create();
            $fabricante->nombre = $faker->firstNameMale();
            $fabricante->telefono = $faker->randomNumber(7);
            $fabricante->save();
        }
    }
}
