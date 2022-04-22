<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Producto;
use App\Models\UsersComandas;
use App\Models\ComandasProductos;
use App\Http\Controllers\UsersComandasController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $comanda = new Comanda();

        $comanda->mesa = $request->input('mesa');
        $comanda->comentarios = $request->input('comentarios');

        $comanda->save();

        $user_comanda = new UsersComandasController();
        $user_comanda->store($comanda->id);

        $productos = $request->input('productos');
        $cantidad = $request->input('cantidad');

        $comanda_producto = new ComandasProductosController();
        $comanda_producto->store($comanda->id, $productos, $cantidad);

        return redirect('/camarero')->with('success', 'Comanda creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function show(Comanda $comanda)
    {
        $productos = Producto::all();

        // dd($productos);

        $comanda = Comanda::find($comanda->id);
        // dd($comanda);

        $comandasProductos = ComandasProductos::where('comanda_id', $comanda->id)->get();

        // dd($ComandasProductos);
        return view('comanda', ['comanda' => $comanda, 'todosProductos' => $productos, 'comandasProductos' => $comandasProductos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function edit(Comanda $comanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comanda $comanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comanda $comanda)
    {
        //
    }
}
