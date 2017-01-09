<?php

use Illuminate\Database\Seeder;
use Apis\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FabricanteTableSeeder::class);
        $this->call(VehiculoTableSeeder::class);
        User::truncate();
        $this->call(UsersTableSeeder::class);
    }
}
