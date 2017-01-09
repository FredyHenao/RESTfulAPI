<?php

use Illuminate\Database\Seeder;
use Apis\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->email = 'faker@faker.com';
        $user->password = Hash::make('algo');
        $user->save();
    }
}
