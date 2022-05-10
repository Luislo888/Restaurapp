<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Producto;
use App\Models\UsersComandas;
use App\Models\ComandasProductos;
use App\Http\Controllers\UsersComandasController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CamareroController;
use App\Models\User;
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
        // dd($request);

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
        // $comandaCompleta['comanda_producto'] = $comanda_producto;
        $comandaCompleta['cantidad'] = $cantidad;

        // echo json_encode($comandaCompleta);

        return redirect('/camarero')->with('success', 'Comanda creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // dd($entrantes);
        $primeros = Producto::all()->where('categoria', 'primeros');
        $entrantes = Producto::all()->where('categoria', 'entrantes');
        $segundos = Producto::all()->where('categoria', 'segundos');
        $postres = Producto::all()->where('categoria', 'postres');
        $bebidas = Producto::all()->where('categoria', 'bebidas');


        $comanda = Comanda::find($id);
        // dd($comanda);
        // La comanda buscada por ID

        $comandasProductos = ComandasProductos::where('comanda_id', $comanda->id)->get();
        // dd($comandasProductos);
        // Los productos de la comanda en cuestión

        $camarero = Auth::user()->name;

        if (Auth::user()->rol == 1) {
            $comandas =  Comanda::addSelect([
                'id' => UsersComandas::select('id')
                    ->whereColumn('comanda_id', 'comandas.id')
                // ->where('user_id', Auth::user()->id)
                // ->where('comandas.estado', 'abierta')
            ])->get();
        } else {
            $comandas =  Comanda::addSelect([
                'id' => UsersComandas::select('id')
                    ->whereColumn('comanda_id', 'comandas.id')
                    ->where('user_id', Auth::user()->id)
                // ->where('comandas.estado', 'abierta')
            ])->get();
        }

        // dd($comandas);
        // Todas las comandas del usuario, usado para la vista camarero

        $productos = ComandasProductos::addSelect([
            'id' => Producto::select('id')
                ->whereColumn('productos.id', 'comandas_productos.producto_id')
        ])->join('productos', 'comandas_productos.producto_id', '=', 'productos.id')
            ->select('productos.*', 'comandas_productos.*')->get();

        // dd($productos);
        // Todos las comandasProductos(comanda_id, producto_id, cantidad) uniéndole los productos(nombre, categoria)

        // return view('comanda', ['comanda' => $comanda, 'comandas' => $comandas, 'todosProductos' => $productos, 'productos' => $productos, 'comandasProductos' => $comandasProductos, 'entrantes' => $entrantes, 'primeros' => $primeros, 'segundos' => $segundos, 'postres' => $postres, 'bebidas' => $bebidas]);

        $productosComanda = array();

        foreach ($productos as $producto) {

            if ($producto->comanda_id == $comanda->id) {
                $productosComanda[] = $producto;
            }
        }

        $comandaCompleta = array();

        // $productosCompleto = Producto::whereIn('id', $comandasProductos)->get();
        // $comandaCompleta['productosCompleto'] = $productosCompleto;

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

        // dd($comandaCompleta);

        echo json_encode($comandaCompleta);


        // return view('comanda', ['comanda' => $comanda, 'comandas' => $comandas, 'productos' => $productos, 'comandasProductos' => $comandasProductos, 'entrantes' => $entrantes, 'primeros' => $primeros, 'segundos' => $segundos, 'postres' => $postres, 'bebidas' => $bebidas]);
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

        // return redirect('/camarero')->with('success', 'Comanda actualizada');
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

    public function cancelar($id)
    {
        $comanda = Comanda::find($id);
        $comanda->estado = 'cancelada';
        $comanda->update();
        echo json_encode($id);
    }
}
