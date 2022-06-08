<?php

namespace Database\Seeders;

use App\Models\Producto;
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

        $producto1 = Producto::create([
            'nombre' => 'Alitas',
            'precio' => '8',
            'categoria' => 'entrantes',
        ]);

        $producto2 = Producto::create([
            'nombre' => 'Bravas',
            'precio' => '6.30',
            'categoria' => 'entrantes',
        ]);

        $producto3 = Producto::create([
            'nombre' => 'Croquetas',
            'precio' => '8.90',
            'categoria' => 'entrantes',
        ]);

        $producto4 = Producto::create([
            'nombre' => 'Jamón 5J',
            'precio' => '15.30',
            'categoria' => 'entrantes',
        ]);

        $producto5 = Producto::create([
            'nombre' => 'Pan de Ajo',
            'precio' => '3.25',
            'categoria' => 'entrantes',
        ]);

        $producto6 = Producto::create([
            'nombre' => 'Provolone',
            'precio' => '7.30',
            'categoria' => 'entrantes',
        ]);

        $producto7 = Producto::create([
            'nombre' => 'Tabla de Ahumados',
            'precio' => '12.30',
            'categoria' => 'entrantes',
        ]);


        $producto8 = Producto::create([
            'nombre' => 'Tabla de Embutidos',
            'precio' => '10.70',
            'categoria' => 'entrantes',
        ]);

        $producto9 = Producto::create([
            'nombre' => 'Tabla de Quesos',
            'precio' => '10.50',
            'categoria' => 'entrantes',
        ]);

        // PRIMEROS -----------------------------------

        $producto10 = Producto::create([
            'nombre' => 'Crema de Verduras',
            'precio' => '5.75',
            'categoria' => 'primeros',
        ]);
        $producto11 = Producto::create([
            'nombre' => 'Ensalada Caprese',
            'precio' => '6.35',
            'categoria' => 'primeros',
        ]);

        $producto12 = Producto::create([
            'nombre' => 'Ensalada César',
            'precio' => '6.65',
            'categoria' => 'primeros',
        ]);

        $producto13 = Producto::create([
            'nombre' => 'Ensalada Mixta',
            'precio' => '6.60',
            'categoria' => 'primeros',
        ]);

        $producto14 = Producto::create([
            'nombre' => 'Pasta Boloñesa',
            'precio' => '7.65',
            'categoria' => 'primeros',
        ]);

        $producto15 = Producto::create([
            'nombre' => 'Pasta Carbonara',
            'precio' => '7.90',
            'categoria' => 'primeros',
        ]);

        $producto16 = Producto::create([
            'nombre' => 'Papas Aliñás',
            'precio' => '6.30',
            'categoria' => 'primeros',
        ]);

        $producto17 = Producto::create([
            'nombre' => 'Risotto de Setas',
            'precio' => '8.45',
            'categoria' => 'primeros',
        ]);

        $producto18 = Producto::create([
            'nombre' => 'Salmorejo',
            'precio' => '7.20',
            'categoria' => 'primeros',
        ]);

        // SEGUNDOS -----------------------------------

        $producto19 = Producto::create([
            'nombre' => 'Cachopo',
            'precio' => '15.9',
            'categoria' => 'segundos',
        ]);

        $producto20 = Producto::create([
            'nombre' => 'Chuletillas de Cordero',
            'precio' => '16.3',
            'categoria' => 'segundos',
        ]);

        $producto21 = Producto::create([
            'nombre' => 'Cochinillo',
            'precio' => '18.5',
            'categoria' => 'segundos',
        ]);

        $producto22 = Producto::create([
            'nombre' => 'Lubina',
            'precio' => '17.9',
            'categoria' => 'segundos',
        ]);

        $producto23 = Producto::create([
            'nombre' => 'Merluza',
            'precio' => '15.3',
            'categoria' => 'segundos',
        ]);

        $producto24 = Producto::create([
            'nombre' => 'Pastel de carne',
            'precio' => '13.5',
            'categoria' => 'segundos',
        ]);

        $producto25 = Producto::create([
            'nombre' => 'Pulpo a la Brasa',
            'precio' => '19.9',
            'categoria' => 'segundos',
        ]);

        $producto26 = Producto::create([
            'nombre' => 'Rabo de Toro',
            'precio' => '16.3',
            'categoria' => 'segundos',
        ]);

        $producto27 = Producto::create([
            'nombre' => 'Solomillo',
            'precio' => '19.5',
            'categoria' => 'segundos',
        ]);

        // POSTRES -----------------------------------

        $producto28 = Producto::create([
            'nombre' => 'Brownie',
            'precio' => '7.8',
            'categoria' => 'postres',
        ]);

        $producto29 = Producto::create([
            'nombre' => 'Buñuelos',
            'precio' => '8.2',
            'categoria' => 'postres',
        ]);

        $producto30 = Producto::create([
            'nombre' => 'Cheescake',
            'precio' => '6.75',
            'categoria' => 'postres',
        ]);

        $producto31 = Producto::create([
            'nombre' => 'Coulant de Chocolate',
            'precio' => '7.8',
            'categoria' => 'postres',
        ]);

        $producto32 = Producto::create([
            'nombre' => 'Natillas',
            'precio' => '6.2',
            'categoria' => 'postres',
        ]);

        $producto33 = Producto::create([
            'nombre' => 'Tarta de la viña',
            'precio' => '6.75',
            'categoria' => 'postres',
        ]);

        $producto34 = Producto::create([
            'nombre' => 'Tarta de la Casa',
            'precio' => '7.8',
            'categoria' => 'postres',
        ]);

        $producto35 = Producto::create([
            'nombre' => 'Tarta Zanahoria',
            'precio' => '6.2',
            'categoria' => 'postres',
        ]);

        $producto36 = Producto::create([
            'nombre' => 'Tiramisú',
            'precio' => '6.75',
            'categoria' => 'postres',
        ]);

        // BEBIDAS -----------------------------------

        $producto37 = Producto::create([
            'nombre' => 'Agua',
            'precio' => '0.00',
            'categoria' => 'bebidas',
        ]);

        $producto38 = Producto::create([
            'nombre' => 'Agua con Gas',
            'precio' => '2.1',
            'categoria' => 'bebidas',
        ]);

        $producto139 = Producto::create([
            'nombre' => 'Café con Hielo',
            'precio' => '2',
            'categoria' => 'bebidas',
        ]);

        $producto40 = Producto::create([
            'nombre' => 'Café con Leche',
            'precio' => '2',
            'categoria' => 'bebidas',
        ]);

        $producto41 = Producto::create([
            'nombre' => 'Café Cortado',
            'precio' => '2',
            'categoria' => 'bebidas',
        ]);

        $producto42 = Producto::create([
            'nombre' => 'Café Manchado',
            'precio' => '2',
            'categoria' => 'bebidas',
        ]);

        $producto43 = Producto::create([
            'nombre' => 'Café Solo',
            'precio' => '2',
            'categoria' => 'bebidas',
        ]);

        $producto44 = Producto::create([
            'nombre' => 'Cerveza',
            'precio' => '2.5',
            'categoria' => 'bebidas',
        ]);

        $producto45 = Producto::create([
            'nombre' => 'Cerveza 0,0',
            'precio' => '2.5',
            'categoria' => 'bebidas',
        ]);

        $producto46 = Producto::create([
            'nombre' => 'Cerveza Clara',
            'precio' => '2.5',
            'categoria' => 'bebidas',
        ]);

        $producto47 = Producto::create([
            'nombre' => 'Cocacola Zero',
            'precio' => '3',
            'categoria' => 'bebidas',
        ]);

        $producto48 = Producto::create([
            'nombre' => 'Nestea',
            'precio' => '3',
            'categoria' => 'bebidas',
        ]);

        $producto49 = Producto::create([
            'nombre' => 'Tinto de verano',
            'precio' => '2.25',
            'categoria' => 'bebidas',
        ]);

        $producto50 = Producto::create([
            'nombre' => 'Vino Blanco',
            'precio' => '3',
            'categoria' => 'bebidas',
        ]);

        $producto51 = Producto::create([
            'nombre' => 'Vino Tinto',
            'precio' => '3',
            'categoria' => 'bebidas',
        ]);
    }
}
