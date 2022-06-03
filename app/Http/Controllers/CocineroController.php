<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Producto;
use App\Models\Comanda;
use App\Models\ComandasProductos;
use App\Models\UsersComandas;

class CocineroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('middlecocinero', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrantes = Producto::all()->where('categoria', 'entrantes');
        $primeros = Producto::all()->where('categoria', 'primeros');
        $segundos = Producto::all()->where('categoria', 'segundos');
        $postres = Producto::all()->where('categoria', 'postres');
        $bebidas = Producto::all()->where('categoria', 'bebidas');

        $cocinero = Auth::user()->name;

        if (Auth::user()->rol == 1 || Auth::user()->rol == 3) {
            $comandas =  Comanda::addSelect([
                'id' => UsersComandas::select('id')
                    ->whereColumn('comanda_id', 'comandas.id')
            ])->get();
        } else {
            $comandas =  Comanda::addSelect([
                'id' => UsersComandas::select('id')
                    ->whereColumn('comanda_id', 'comandas.id')
                    ->where('user_id', Auth::user()->id)
            ])->get();
        }

        $hoy = date('Y-m-d');

        $comandasHoy = [];

        foreach ($comandas as $comanda) {
            if ($comanda->created_at >= $hoy) {
                array_push($comandasHoy, $comanda);
            }
        }

        $productos = ComandasProductos::addSelect([
            'id' => Producto::select('id')
                ->whereColumn('productos.id', 'comandas_productos.producto_id')
        ])->join('productos', 'comandas_productos.producto_id', '=', 'productos.id')
            ->select('productos.*', 'comandas_productos.*')->get();

        return view('cocinero', ['cocinero' => $cocinero, 'entrantes' => $entrantes, 'primeros' => $primeros, 'segundos' => $segundos, 'postres' => $postres, 'bebidas' => $bebidas, 'comandas' => $comandasHoy, 'productos' => $productos]);
    }
}
