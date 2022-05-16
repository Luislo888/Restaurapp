<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comanda;

class ComandaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // COMANDA ID 1 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 1,
            'comentarios' => 'Solomillo poco hecho',
        ]);
        // COMANDA ID 2 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 1,
            'comentarios' => 'Con tomate',
        ]);
        // COMANDA ID 3 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 1,
            'comentarios' => 'Muy picante',
        ]);
        // COMANDA ID 4 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 2,
            'comentarios' => 'Con almendras',
            'estado' => 'en curso',
        ]);
        // COMANDA ID 5 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 2,
            'comentarios' => 'Con albondigas',
            'estado' => 'en curso',
        ]);
        // COMANDA ID 6 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 2,
            'comentarios' => 'Con tomate',
            'estado' => 'en curso',
        ]);
        // COMANDA ID 7 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            'comentarios' => 'Con tomate',
            'estado' => 'cerrada',
        ]);
        // COMANDA ID 8 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            'comentarios' => 'Con tomate',
            'estado' => 'cerrada',
        ]);
        // COMANDA ID 9 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            'comentarios' => 'Sin pepinillos',
            'estado' => 'cerrada',
        ]);
        // COMANDA ID 10 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            'comentarios' => 'Con tomate',
            'estado' => 'abierta',
        ]);
        // COMANDA ID 11 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            'comentarios' => 'Con tomate',
            'estado' => 'cancelada',
        ]);
        // COMANDA ID 12 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            'comentarios' => 'Con tomate',
            'estado' => 'cancelada',
        ]);
        // COMANDA ID 13 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            'comentarios' => 'Con tomate',
            'estado' => 'abierta',
        ]);
    }
}
