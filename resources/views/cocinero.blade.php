@extends('layouts.app')

@section('cabecera')
    <h6 class="tituloRol">Cocinero <img id="iconChef" src="{{ asset('images/chef.png') }}" alt=""></i></h6>
    <div class="collapse navbar-collapse text-center justify-content-center comandasNavTabs" id="navbarSupportedContent">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button id="botonAbiertas" type="button" class="btn alert alert-warning">Abiertas</button>
            <button id="botonCurso" type="button" class="btn alert alert-danger">En Curso</button>
            <button id="botonCerradas" type="button" class="btn alert alert-success">Cerradas</button>
            <button id="botonCanceladas" type="button" class="btn alert alert-secondary">Canceladas</button>

        </div>
    </div>
@endsection

@section('content')
    <div class="container marginTopBody">
        <div class="row justify-content-center miDiv">

            {{-- ----------------------------------- INICIO COMANDAS ABIERTAS --------------------------------- --}}

            {{-- <div id="anchorComandasAbiertas"></div> --}}
            <div class="col-md-auto" id="comandasAbiertas">
                <div class="card">
                    <div class="card-header text-warning titulosComandas">
                        <h6 id="tituloComandaAbierta"><i class="fa-solid fa-spinner iconEnCurso"></i> Comandas Abiertas
                        </h6>
                    </div>
                </div>
                @foreach ($comandas as $comanda)
                    @if ($comanda->id != null && $comanda->estado == 'abierta')
                        <form method="GET" action="{{ route('comanda-edit', ['id' => $comanda->id]) }}"
                            class="formShowComanda">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong><img src="{{ asset('images/mesa.png') }}" alt=""> Mesa:</strong>
                                    {{ $comanda->mesa }}
                                    <span class="textoDerecha"><strong>
                                            <img class="orderList" src="{{ asset('images/comanda.png') }}">
                                            Nº Comanda:</strong>
                                        {{ $comanda->id }}</span>
                                    <br><strong><i class="fa-solid fa-clock iconClock"></i></strong>
                                    <span class="fechaFormateada">{{ $comanda->created_at }}</span>
                                </div>

                                <div class="card-body bodyComandas bodyComandasAbiertas">
                                    <strong class="categoriaProducto">
                                        <img class="iconIzquierda" src="{{ asset('images/entrantes.png') }}" alt="">

                                        Entrantes:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'entrantes')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    <strong class="categoriaProducto"> <img class="iconIzquierda"
                                            src="{{ asset('images/primeros.png') }}" alt="">
                                        Primeros:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'primeros')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>

                                    <strong class="categoriaProducto"> <img class="iconIzquierda"
                                            src="{{ asset('images/segundos.png') }}" alt="">
                                        Segundos:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'segundos')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    <strong class="categoriaProducto">
                                        <i class="fa-solid fa-ice-cream"></i> Postres:
                                    </strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'postres')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    <strong class="categoriaProducto"><i class="fa-solid fa-wine-glass"></i>
                                        Bebidas:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'bebidas')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    @if ($comanda->comentarios != null)
                                        <strong class="comentarioProducto"><i class="fa-solid fa-comment"></i>
                                            Comentarios:</strong>
                                        {{ $comanda->comentarios }}
                                    @endif
                                    <br>

                                    <div class="row mb-1 mt-1 botonesComandas">
                                        <div class="col-md-12 offset-md-4 mb-1 mt-1 justify-content-center">
                                            <button type="submit" class="btn btn-primary botonCocinarComanda"
                                                name="cocinarComanda" data-bs-toggle="modal"
                                                data-bs-target="#cocinarComanda">
                                                {{ __('Cocinar ') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                @endforeach
            </div>

            {{-- ----------------------------------- FIN COMANDAS ABIERTAS --------------------------------- --}}

            {{-- ----------------------------------------------------------------------------------------------------------------- --}}


            {{-- ----------------------------------- INICIO COMANDAS EN CURSO --------------------------------- --}}

            {{-- <div id="anchorComandasCerradas"></div> --}}
            <div class="col-md-auto" id="comandasEnCurso">
                <div class="card">
                    <div class="card-header text-warning titulosComandas">
                        <h6 id="tituloComandaEnCurso"><i class="fa-solid fa-list-check"></i> Comandas en Curso</h6>
                    </div>
                </div>
                @foreach ($comandas as $comanda)
                    @if ($comanda->id != null && $comanda->estado == 'en curso')
                        <form method="GET" action="{{ route('comanda-edit', ['id' => $comanda->id]) }}"
                            class="formShowComanda">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <img class="iconIzquierda" src="{{ asset('images/mesa.png') }}" alt="">
                                    <strong>Mesa:</strong> {{ $comanda->mesa }}
                                    <span class="textoDerecha"><img class="orderList"
                                            src="{{ asset('images/comanda.png') }}" alt=""> <strong>Nº Comanda:</strong>
                                        {{ $comanda->id }}</span>
                                    <br>
                                    <i class="fa-solid fa-clock iconClock"></i>
                                    <span class="fechaFormateada">{{ $comanda->created_at }}</span>
                                </div>
                                <div class="card-body bodyComandas bodyComandasEnCurso">
                                    <strong class="categoriaProducto"> <img class="iconIzquierda"
                                            src="{{ asset('images/entrantes.png') }}" alt="">
                                        Entrantes:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'entrantes')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    <strong class="categoriaProducto"> <img class="iconIzquierda"
                                            src="{{ asset('images/primeros.png') }}" alt="">
                                        Primeros:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'primeros')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    <strong class="categoriaProducto"> <img class="iconIzquierda"
                                            src="{{ asset('images/segundos.png') }}" alt="">
                                        Segundos:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'segundos')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    <strong class="categoriaProducto"><i class="fa-solid fa-ice-cream"></i>
                                        Postres:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'postres')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    <strong class="categoriaProducto"><i class="fa-solid fa-wine-glass"></i>
                                        Bebidas:</strong>
                                    @foreach ($productos as $producto)
                                        @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'bebidas')
                                            <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                        @endif
                                    @endforeach
                                    <br>
                                    @if ($comanda->comentarios != null)
                                        <strong class="comentarioProducto"><i class="fa-solid fa-comment"></i>
                                            Comentarios:</strong>
                                        {{ $comanda->comentarios }}
                                    @endif
                                    <br>
                                    <div class="row mb-1 mt-1 botonesComandas">
                                        <div class="col-md-12 offset-md-3 mb-1 mt-1 justify-content-center">
                                            <button type="submit" class="btn btn-success botonFinalizarComanda"
                                                data-bs-toggle="modal" data-bs-target="#cocinarComanda">
                                                Finalizar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                @endforeach
            </div>

            {{-- ----------------------------------- FIN COMANDAS EN CURSO --------------------------------- --}}

            {{-- ----------------------------------------------------------------------------------------------------------------- --}}

            {{-- ----------------------------------- INICIO COMANDAS CERRADAS --------------------------------- --}}

            {{-- <div id="anchorComandasCerradas"></div> --}}
            <div class="col-md-auto" id="comandasCerradas">
                <div class="card">
                    <div class="card-header text-warning titulosComandas">
                        <h6 id="tituloComandaCerrada"><i class="fa-solid fa-check-double"></i> Comandas Cerradas</h6>
                    </div>
                </div>
                @foreach ($comandas as $comanda)
                    @if ($comanda->id != null && $comanda->estado == 'cerrada')
                        <div class="card mb-3">
                            <div class="card-header">
                                <img class="iconIzquierda" src="{{ asset('images/mesa.png') }}" alt="">
                                <strong>Mesa:</strong> {{ $comanda->mesa }}
                                <span class="textoDerecha"><img class="orderList"
                                        src="{{ asset('images/comanda.png') }}" alt=""> <strong>Nº Comanda:</strong>
                                    {{ $comanda->id }}</span>
                                <br>
                                <i class="fa-solid fa-clock iconClock"></i>
                                <span class="fechaFormateada">{{ $comanda->created_at }}</span>
                            </div>

                            <div class="card-body bodyComandas bodyComandasCerradas">
                                <strong class="categoriaProducto"><img class="iconIzquierda"
                                        src="{{ asset('images/entrantes.png') }}" alt="">
                                    Entrantes:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'entrantes')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="categoriaProducto"> <img class="iconIzquierda"
                                        src="{{ asset('images/primeros.png') }}" alt="">
                                    Primeros:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'primeros')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="categoriaProducto"> <img class="iconIzquierda"
                                        src="{{ asset('images/segundos.png') }}" alt="">
                                    Segundos:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'segundos')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="categoriaProducto"><i class="fa-solid fa-ice-cream"></i> Postres:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'postres')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="categoriaProducto"><i class="fa-solid fa-wine-glass"></i> Bebidas:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'bebidas')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                @if ($comanda->comentarios != null)
                                    <strong class="comentarioProducto"><i class="fa-solid fa-comment"></i>
                                        Comentarios:</strong>
                                    {{ $comanda->comentarios }}
                                @endif
                                <br>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- ----------------------------------- FIN COMANDAS CERRADAS --------------------------------- --}}


            {{-- ----------------------------------- INICIO COMANDAS Canceladas --------------------------------- --}}

            {{-- <div id="anchorComandasCerradas"></div> --}}
            <div class="col-md-auto" id="comandasCanceladas">
                <div class="card">
                    <div class="card-header titulosComandas">
                        <h6 id="tituloComandaCanceladas"><i class="fa-solid fa-ban"></i> Comandas Canceladas</h6>
                    </div>
                </div>
                @foreach ($comandas as $comanda)
                    @if ($comanda->id != null && $comanda->estado == 'cancelada')
                        <div class="card mb-3">
                            <div class="card-header">
                                <img class="iconIzquierda" src="{{ asset('images/mesa.png') }}" alt="">
                                <strong>Mesa:</strong> {{ $comanda->mesa }}
                                <span class="textoDerecha"><img class="orderList"
                                        src="{{ asset('images/comanda.png') }}" alt=""> <strong>Nº Comanda:</strong>
                                    {{ $comanda->id }}</span>
                                <br>
                                <i class="fa-solid fa-clock iconClock"></i>
                                <span class="fechaFormateada">{{ $comanda->created_at }}</span>
                            </div>

                            <div class="card-body bodyComandas bodyComandasCanceladas">
                                <strong class="categoriaProducto"><img class="iconIzquierda"
                                        src="{{ asset('images/entrantes.png') }}" alt="">
                                    Entrantes:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'entrantes')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="categoriaProducto"> <img class="iconIzquierda"
                                        src="{{ asset('images/primeros.png') }}" alt="">
                                    Primeros:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'primeros')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="categoriaProducto"> <img class="iconIzquierda"
                                        src="{{ asset('images/segundos.png') }}" alt="">
                                    Segundos:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'segundos')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="categoriaProducto"><i class="fa-solid fa-ice-cream"></i> Postres:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'postres')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="categoriaProducto"><i class="fa-solid fa-wine-glass"></i> Bebidas:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'bebidas')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                @if ($comanda->comentarios != null)
                                    <strong class="comentarioProducto"><i class="fa-solid fa-comment"></i>
                                        Comentarios:</strong>
                                    {{ $comanda->comentarios }}
                                @endif
                                <br>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- ----------------------------------- FIN COMANDAS CERRADAS --------------------------------- --}}

        </div>
    </div>
    <button id="ocultarAbiertasCocinero" type="button"
        class="btn alert alert-warning botonOcultar sinFocus">Abiertas</button>
    <button id="ocultarEnCursoCocinero" type="button" class="btn alert alert-danger botonOcultar sinFocus">En
        Curso</button>
    <button id="ocultarCerradasCocinero" type="button"
        class="btn alert alert-success botonOcultar sinFocus">Cerradas</button>
    <button id="ocultarCanceladasCocinero" type="button"
        class="btn alert alert-secondary botonOcultar sinFocus">Canceladas</button>


    <!-- INICIO MODAL EDITAR COMANDA -->

    <div class="modal fade" id="showComanda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="showComandaContent">
            </div>
        </div>
    </div>

    <!-- FIN MODAL EDITAR COMANDA -->


    <!-- INICIO MODAL CANCELAR COMANDA -->

    <div class="modal fade" id="cocinarComanda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="cocinarComandaContent">
            </div>
        </div>
    </div>

    <!-- FIN MODAL CANCELAR COMANDA -->
@endsection
