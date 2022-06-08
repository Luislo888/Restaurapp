<?php

namespace Database\Seeders;

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
            'estado' => 'cerrada',
            'comentarios' => 'Cocacola no hielo',
        ]);
        // COMANDA ID 2 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 2,
            'comentarios' => 'Alitas muy picantes',
            'estado' => 'cerrada',
        ]);
        // COMANDA ID 3 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 4,
            // 'comentarios' => 'Muy picante',
            'estado' => 'cerrada',
        ]);
        // COMANDA ID 4 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 6,
            // 'comentarios' => 'Con almendras',
            'estado' => 'en curso',
        ]);
        // COMANDA ID 5 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 2,
            // 'comentarios' => '',
            'estado' => 'en curso',
        ]);
        // COMANDA ID 6 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            // 'comentarios' => 'Con tomate',
            'estado' => 'en curso',
        ]);
        // COMANDA ID 7 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 5,
            'comentarios' => 'Solomillos punto',
            'estado' => 'abierta',
        ]);
        // COMANDA ID 8 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 6,
            'comentarios' => 'Agua grifo',
            'estado' => 'abierta',
        ]);
        // COMANDA ID 9 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 3,
            'comentarios' => 'Sin roquefort ',
            'estado' => 'cancelada',
        ]);
        // COMANDA ID 10 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 1,
            'comentarios' => 'Sin albahaca',
            'estado' => 'cancelada',
        ]);
        // COMANDA ID 11 -----------------------------------
        $comanda = Comanda::create([
            'mesa' => 6,
            // 'comentarios' => 'Con tomate',
            'estado' => 'cancelada',
        ]);
    }
}
