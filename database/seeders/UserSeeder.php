<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
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

        $userAdmin = User::create([
            'name' => 'Admin Luis',
            'last_name' => 'López',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'rol' => '1',
        ]);

        $userCamarero1 = User::create([
            'name' => 'Camarero Marcos',
            'last_name' => 'García',
            'email' => 'camarero@gmail.com',
            'password' => Hash::make('1234'),
            'rol' => '2',
        ]);

        $userCocinero = User::create([
            'name' => 'Cocinero Laura',
            'last_name' => 'Carmona',
            'email' => 'cocinero@gmail.com',
            'password' => Hash::make('1234'),
            'rol' => '3',
        ]);

        $userCamarero2 = User::create([
            'name' => 'Camarero Alberto',
            'last_name' => 'Solana',
            'email' => 'camarero2@gmail.com',
            'password' => Hash::make('1234'),
            'rol' => '2',
        ]);
    }
}
