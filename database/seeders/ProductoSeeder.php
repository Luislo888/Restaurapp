<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ENTRANTES -----------------------------------
        $producto = Producto::create([
            'nombre' => 'Cebiche',
            'precio' => '118.50',
            'categoria' => 'entrantes',
        ]);

        $producto2 = Producto::create([
            'nombre' => 'Croquetas',
            'precio' => '8',
            'categoria' => 'entrantes',
        ]);

        $producto3 = Producto::create([
            'nombre' => 'Crudites',
            'precio' => '6.25',
            'categoria' => 'entrantes',
        ]);

        // PRIMEROS -----------------------------------

        $producto4 = Producto::create([
            'nombre' => 'Ensalada Mixta',
            'precio' => '7.75',
            'categoria' => 'primeros',
        ]);

        $producto5 = Producto::create([
            'nombre' => 'Crema de verduras',
            'precio' => '7.35',
            'categoria' => 'primeros',
        ]);

        $producto6 = Producto::create([
            'nombre' => 'Salmorejo',
            'precio' => '7.65',
            'categoria' => 'primeros',
        ]);

        // SEGUNDOS -----------------------------------

        $producto7 = Producto::create([
            'nombre' => 'Solomillo',
            'precio' => '15.9',
            'categoria' => 'segundos',
        ]);

        $producto8 = Producto::create([
            'nombre' => 'Lubina',
            'precio' => '12.3',
            'categoria' => 'segundos',
        ]);

        $producto9 = Producto::create([
            'nombre' => 'Cochinillo',
            'precio' => '13.5',
            'categoria' => 'segundos',
        ]);

        // POSTRES -----------------------------------

        $producto10 = Producto::create([
            'nombre' => 'Tiramisú',
            'precio' => '7.8',
            'categoria' => 'postres',
        ]);

        $producto11 = Producto::create([
            'nombre' => 'Cheescake',
            'precio' => '8.2',
            'categoria' => 'postres',
        ]);

        $producto12 = Producto::create([
            'nombre' => 'Fruta',
            'precio' => '6.75',
            'categoria' => 'postres',
        ]);

        // BEBIDAS -----------------------------------

        $producto13 = Producto::create([
            'nombre' => 'Agua',
            'precio' => '1.25',
            'categoria' => 'bebidas',
        ]);

        $producto14 = Producto::create([
            'nombre' => 'Cocacola',
            'precio' => '2.1',
            'categoria' => 'bebidas',
        ]);

        $producto15 = Producto::create([
            'nombre' => 'Vino',
            'precio' => '4',
            'categoria' => 'bebidas',
        ]);

        $producto16 = Producto::create([
            'nombre' => 'Cerveza',
            'precio' => '3.5',
            'categoria' => 'bebidas',
        ]);
    }
}
