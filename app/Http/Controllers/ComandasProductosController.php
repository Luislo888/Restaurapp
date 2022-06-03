<?php

namespace App\Http\Controllers;

use App\Models\ComandasProductos;

class ComandasProductosController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($comanda_id, $producto_id, $cantidad)
    {
        for ($i = 0; $i < count($producto_id); $i++) {
            $comandas_productos = new ComandasProductos();
            $comandas_productos->comanda_id = $comanda_id;
            $comandas_productos->producto_id = $producto_id[$i];
            $comandas_productos->cantidad = $cantidad[$i];
            $comandas_productos->save();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComandasProductos  $comandasProductos
     * @return \Illuminate\Http\Response
     */
    public function update($comanda_id, $producto_id, $cantidad)
    {
        $comandas_productos = ComandasProductos::where('comanda_id', $comanda_id)->delete();
        for ($i = 0; $i < count($producto_id); $i++) {
            $comandas_productos = new ComandasProductos();
            $comandas_productos->comanda_id = $comanda_id;
            $comandas_productos->producto_id = $producto_id[$i];
            $comandas_productos->cantidad = $cantidad[$i];
            $comandas_productos->save();
        }
    }
}
