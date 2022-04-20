<?php

namespace App\Http\Controllers;

use App\Models\ComandasProductos;
use Illuminate\Http\Request;

class ComandasProductosController extends Controller
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
    public function store($comanda_id, $producto_id)
    {
        for ($i = 0; $i < count($producto_id); $i++) {
            $comandas_productos = new ComandasProductos();
            $comandas_productos->comanda_id = $comanda_id;
            $comandas_productos->producto_id = $producto_id[$i];
            $comandas_productos->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComandasProductos  $comandasProductos
     * @return \Illuminate\Http\Response
     */
    public function show(ComandasProductos $comandasProductos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComandasProductos  $comandasProductos
     * @return \Illuminate\Http\Response
     */
    public function edit(ComandasProductos $comandasProductos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComandasProductos  $comandasProductos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComandasProductos $comandasProductos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComandasProductos  $comandasProductos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComandasProductos $comandasProductos)
    {
        //
    }
}
