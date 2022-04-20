<?php

namespace App\Http\Controllers;

use App\Models\UsersComandas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersComandasController extends Controller
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
    public function store($comanda_id)
    {
        $user_comanda = new UsersComandas();

        $user_comanda->user_id = auth::user()->id;
        $user_comanda->comanda_id = $comanda_id;

        $user_comanda->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsersComandas  $usersComandas
     * @return \Illuminate\Http\Response
     */
    public function show(UsersComandas $usersComandas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsersComandas  $usersComandas
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersComandas $usersComandas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsersComandas  $usersComandas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsersComandas $usersComandas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsersComandas  $usersComandas
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersComandas $usersComandas)
    {
        //
    }
}
