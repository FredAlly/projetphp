<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

     //   for ($i = 0; $i < 2; $i++) {
            $user = new User;
           /*  $user->name = $faker->lastName;
            $user->email = $faker->unique()->email;
            $user->password = bcrypt('123456'); */      
           // $user->role =  $faker->randomElement(['admin' ,'user']);

           $user->name = 'admin';
           $user->email = 'admin@mail.com';
           $user->password = Hash::make('12345678');
           $user->role =  User::admin_role;
            $user->save();
       // }

    }
}