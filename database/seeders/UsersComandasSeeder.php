<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsersComandas;

class UsersComandasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // COMANDA ID 1 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 1,
        ]);
        // COMANDA ID 2 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 2,
        ]);
        // COMANDA ID 3 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 3,
        ]);
        // COMANDA ID 4 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 4,
        ]);
        // COMANDA ID 5 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 5,
        ]);
        // COMANDA ID 6 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 6,
        ]);
        // COMANDA ID 7 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 7,
        ]);
        // COMANDA ID 8 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 8,
        ]);
        // COMANDA ID 9 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 9,
        ]);
        // COMANDA ID 10 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 4,
            'comanda_id' => 10,
        ]);
        // COMANDA ID 11 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 11,
        ]);
        // COMANDA ID 12 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 12,
        ]);
        // COMANDA ID 13 -----------------------------------
        $comanda = UsersComandas::create([
            'user_id' => 2,
            'comanda_id' => 13,
        ]);
    }
}
