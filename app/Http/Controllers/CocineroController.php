<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ComandasController;

use App\Models\Producto;
use App\Models\Comanda;
use App\Models\ComandaProducto;
use App\Models\ComandasProductos;
use App\Models\UsersComandas;
use App\Models\User;

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
                // ->where('created_at', '>', $hoy)
                //     , 
                // 'rol' => User::select('rol')
                //     ->whereColumn('users_comandas.user_id', 'users.id'),
                // ->where('user_id', Auth::user()->id)
                // ->where('comandas.estado', 'abierta')
            ])->get();
        } else {
            $comandas =  Comanda::addSelect([
                'id' => UsersComandas::select('id')
                    ->whereColumn('comanda_id', 'comandas.id')
                    ->where('user_id', Auth::user()->id)
                // ->where('created_at', '>=', $hoy)
                // ->where('comandas.estado', 'abierta')
            ])->get();
        }

        // dd($comandas);
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


        // dd($productos);
        return view('cocinero', ['cocinero' => $cocinero, 'entrantes' => $entrantes, 'primeros' => $primeros, 'segundos' => $segundos, 'postres' => $postres, 'bebidas' => $bebidas, 'comandas' => $comandasHoy, 'productos' => $productos]);

        // return view('cocinero');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
