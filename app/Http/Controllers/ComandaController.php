<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Producto;
use App\Models\UsersComandas;
use App\Models\ComandasProductos;
use App\Http\Controllers\UsersComandasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComandaController extends Controller
{
    public function cantidadNueva($cantidad)
    {
        $cantidadNueva = array();

        for ($i = 0; $i < count($cantidad); $i++) {
            if ($cantidad[$i] != null) {
                $cantidadNueva[] = $cantidad[$i];
            }
        }
        return $cantidadNueva;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $comanda = new Comanda();

            $comanda->mesa = $request->input('mesa');
            $comanda->comentarios = $request->input('comentarios');

            $comanda->save();

            $user_comanda = new UsersComandasController();
            $user_comanda->store($comanda->id);

            $productos = $request->input('productos');
            $cantidad = $this->cantidadNueva($request->input('cantidad'));

            $comanda_producto = new ComandasProductosController();
            $comanda_producto->store($comanda->id, $productos, $cantidad);

            $productosCompleto = Producto::whereIn('id', $productos)->get();

            $comandaCompleta = array();
            $comandaCompleta['comanda'] = $comanda;
            $comandaCompleta['productosCompleto'] = $productosCompleto;
            $comandaCompleta['cantidad'] = $cantidad;

            echo json_encode($comandaCompleta);
        } catch (\Throwable $th) {

            $comanda::rollBack();
            return redirect('/camarero')->withErrors(['msg' => 'Se debe rellenar correctamente la comanda']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $primeros = Producto::all()->where('categoria', 'primeros');
        $entrantes = Producto::all()->where('categoria', 'entrantes');
        $segundos = Producto::all()->where('categoria', 'segundos');
        $postres = Producto::all()->where('categoria', 'postres');
        $bebidas = Producto::all()->where('categoria', 'bebidas');

        $comanda = Comanda::find($id);

        $comandasProductos = ComandasProductos::where('comanda_id', $comanda->id)->get();

        $camarero = Auth::user()->name;

        if (Auth::user()->rol == 1) {
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

        $productos = ComandasProductos::addSelect([
            'id' => Producto::select('id')
                ->whereColumn('productos.id', 'comandas_productos.producto_id')
        ])->join('productos', 'comandas_productos.producto_id', '=', 'productos.id')
            ->select('productos.*', 'comandas_productos.*')->get();

        $productosComanda = array();

        foreach ($productos as $producto) {

            if ($producto->comanda_id == $comanda->id) {
                $productosComanda[] = $producto;
            }
        }

        $comandaCompleta = array();

        $comandaCompleta['comanda'] = $comanda;
        $comandaCompleta['comandas'] = $comandas;
        $comandaCompleta['productos'] = $productos;
        $comandaCompleta['comandasProductos'] = $comandasProductos;
        $comandaCompleta['primeros'] = $primeros;
        $comandaCompleta['entrantes'] = $entrantes;
        $comandaCompleta['segundos'] = $segundos;
        $comandaCompleta['postres'] = $postres;
        $comandaCompleta['bebidas'] = $bebidas;
        $comandaCompleta['productosComanda'] = $productosComanda;
        $comandaCompleta['productosCompleto'] = $productos;

        echo json_encode($comandaCompleta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comanda = Comanda::find($id);

        $comanda->mesa = $request->input('mesa');
        $comanda->comentarios = $request->input('comentarios');

        $comanda->update();

        $productos = $request->input('productos');

        $cantidad = $this->cantidadNueva($request->input('cantidad'));

        $comanda_producto = new ComandasProductosController();
        $comanda_producto->update($comanda->id, $productos, $cantidad);

        $comandaCompleta = array();
        $productosCompleto = Producto::whereIn('id', $productos)->get();
        $comandaCompleta['comanda'] = $comanda;
        $comandaCompleta['productosCompleto'] = $productosCompleto;
        $comandaCompleta['cantidad'] = $cantidad;

        echo json_encode($comandaCompleta);
    }

    public function cancelar($id)
    {
        $comanda = Comanda::find($id);
        $comanda->estado = 'cancelada';
        $comanda->update();
        echo json_encode($id);
    }

    public function cambiarEstadoComanda($id, $estado)
    {
        $comanda = Comanda::find($id);

        if ($estado == 'curso') {
            $comanda->estado = 'en curso';
        } else {
            $comanda->estado = 'cerrada';
        }

        $comanda->update();

        echo json_encode($id);
    }

    public function cambiarEstadoProducto($id, $producto, $estado)
    {
        $producto = ComandasProductos::find($producto);

        $producto->estado_producto = $estado;

        $producto->update();

        echo json_encode($id);
    }
}
