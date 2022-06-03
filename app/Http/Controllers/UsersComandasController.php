<?php

namespace App\Http\Controllers;

use App\Models\UsersComandas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersComandasController extends Controller
{
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
}
