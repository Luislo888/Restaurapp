@extends('layouts.app')

@section('cabecera')
    <h6 class="tituloRol">Camarero</h6>
    <div class="collapse navbar-collapse text-center justify-content-center comandasNavTabs" id="navbarSupportedContent">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button id="botonCrear" type="button" class="btn alert alert-primary">Crear</button>
            <button id="botonAbiertas" type="button" class="btn alert alert-warning">Abiertas</button>
            <button id="botonCurso" type="button" class="btn alert alert-danger">EnCurso</button>
            <button id="botonCerradas" type="button" class="btn alert alert-success">Cerradas</button>

        </div>
    </div>
@endsection

@section('content')
    <div class="container marginTopBody">
        <div class="row justify-content-center miDiv">

            {{-- ----------------------------------- INICIO CREAR COMANDA --------------------------------- --}}

            {{-- <div id="anchorCrearComanda"></div> --}}
            <div class="col-md-auto" id="crearComanda">
                <div class="card cardCrear" id="cardCrear">
                    <div class="card-header">
                        <h6 class="" id="tituloCrearComanda">{{ __('Crear Comanda') }}</h6>
                    </div>

                    <div class="card-body" id="bodyCrearComanda">
                        @if (session('success'))
                            <h6 class="alert alert-success notificacionSucces">{{ session('success') }}</h6>
                        @endif

                        <form method="POST" action="{{ route('comanda') }}" class="">
                            @csrf

                            {{-- Nº MESA --}}

                            <div class="row mb-4">
                                <label for="mesa"
                                    class="col-md-9 col-form-label text-md-start"><strong>{{ __('Nº Mesa') }}</strong></label>

                                <div class="col-md-2 cantidad numeroMesa">
                                    <input id="mesa" min="1" max="6" type="number"
                                        class="form-control @error('mesa') is-invalid @enderror" name="mesa"
                                        value="{{ old('mesa') }}" required autocomplete="mesa" autofocus>

                                    @error('mesa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- ENTRANTES --}}
                            <div class="row mb-3">

                                <label for="entrantes"
                                    class="col-md-3 col-form-label text-md-start"><strong>{{ __('Entrantes ') }}</strong></label>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                    <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarEntrante"></i>
                                </button>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                    <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarEntrante"></i>
                                </button>

                                <div class="col-md-5 inputProductos" id="col">

                                    <select id="entrantes" name="productos[]"
                                        class="form-control @error('entrantes') is-invalid @enderror "
                                        value="{{ old('entrantes') }}" required autocomplete="entrantes">
                                        <option selected disabled>Elige un entrante</option>
                                        @foreach ($entrantes as $entrante)
                                            <option value="{{ $entrante->id }}">{{ $entrante->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control @error('cantidad') is-invalid @enderror" name="cantidad[]"
                                        value="{{ old('cantidad') }}" autocomplete="cantidad" autofocus>

                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- PRIMEROS --}}

                            <div class="row mb-3">
                                <label for="primeros"
                                    class="col-md-3 col-form-label text-md-start"><strong>{{ __('Primeros ') }}</strong>
                                </label>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas"
                                    id="botonAgregarPrimero">
                                    <i class="fa-solid fa-circle-plus botonRedondo"></i>
                                </button>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos"
                                    id="botonQuitarPrimero">
                                    <i class="fa-solid fa-circle-minus botonRedondo"></i>
                                </button>

                                <div class="col-md-5 inputProductos" id="col">

                                    <select id="primeros" name="productos[]"
                                        class="form-control @error('primeros') is-invalid @enderror "
                                        value="{{ old('primeros') }}" required autocomplete="primeros">
                                        <option selected disabled>Elige un primero</option>
                                        @foreach ($primeros as $primero)
                                            <option value="{{ $primero->id }}">{{ $primero->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('primeros')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control @error('cantidad') is-invalid @enderror" name="cantidad[]"
                                        value="{{ old('cantidad') }}" autocomplete="cantidad" autofocus>

                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- SEGUNDOS --}}
                            <div class="row mb-3">
                                <label for="segundos"
                                    class="col-md-3 col-form-label text-md-start"><strong>{{ __('Segundos ') }}</strong></label>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas"
                                    id="botonAgregarSegundo">
                                    <i class="fa-solid fa-circle-plus botonRedondo"></i>
                                </button>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos"
                                    id="botonQuitarSegundo">
                                    <i class="fa-solid fa-circle-minus botonRedondo"></i>
                                </button>
                                <div class="col-md-5 inputProductos">

                                    <select id="segundos" name="productos[]"
                                        class="form-control @error('segundos') is-invalid @enderror"
                                        value="{{ old('segundos') }}" required autocomplete="segundos">
                                        <option selected disabled>Elige un segundo</option>
                                        @foreach ($segundos as $segundo)
                                            <option value="{{ $segundo->id }}">{{ $segundo->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('segundos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control @error('cantidad') is-invalid @enderror" name="cantidad[]"
                                        value="{{ old('cantidad') }}" autocomplete="cantidad" autofocus>

                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- POSTRES --}}

                            <div class="row mb-3">
                                <label for="postres"
                                    class="col-md-3 col-form-label text-md-start"><strong>{{ __('Postres ') }}</strong></label>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas"
                                    id="botonAgregarSegundo">
                                    <i class="fa-solid fa-circle-plus botonRedondo"></i>
                                </button>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos"
                                    id="botonQuitarSegundo">
                                    <i class="fa-solid fa-circle-minus botonRedondo"></i>
                                </button>
                                <div class="col-md-5 inputProductos">

                                    <select id="postres" name="productos[]"
                                        class="form-control @error('postres') is-invalid @enderror"
                                        value="{{ old('postres') }}" required autocomplete="postres">
                                        <option selected disabled>Elige un postre</option>
                                        @foreach ($postres as $postre)
                                            <option value="{{ $postre->id }}">{{ $postre->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('postres')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control @error('cantidad') is-invalid @enderror" name="cantidad[]"
                                        value="{{ old('cantidad') }}" autocomplete="cantidad" autofocus>

                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- BEBIDAS --}}

                            <div class="row mb-3">
                                <label for="bebidas"
                                    class="col-md-3 col-form-label text-md-start"><strong>{{ __('Bebidas ') }}</strong></label>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas"
                                    id="botonAgregarSegundo">
                                    <i class="fa-solid fa-circle-plus botonRedondo"></i>
                                </button>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos"
                                    id="botonQuitarSegundo">
                                    <i class="fa-solid fa-circle-minus botonRedondo"></i>
                                </button>
                                <div class="col-md-5 inputProductos">

                                    <select id="bebidas" name="productos[]"
                                        class="form-control @error('bebidas') is-invalid @enderror"
                                        value="{{ old('bebidas') }}" required autocomplete="bebidas">
                                        <option selected disabled>Elige una bebida</option>
                                        @foreach ($bebidas as $bebida)
                                            <option value="{{ $bebida->id }}">{{ $bebida->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('bebidas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control @error('cantidad') is-invalid @enderror" name="cantidad[]"
                                        value="{{ old('cantidad') }}" autocomplete="cantidad" autofocus>

                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- COMENTARIOS --}}

                            <div class="row mb-3">
                                <label for="comentarios" class="col-md-3 col-form-label text-md-start"
                                    id="comentarioLabel"><strong>{{ __('Comentarios') }}</strong></label>

                                <div class="col-md-8">
                                    <textarea id="comentarioInput" min="1" max="6" type="number"
                                        class="form-control @error('comentarios') is-invalid @enderror"
                                        name="comentarios" value="{{ old('comentarios') }}"
                                        autocomplete="comentarios" autofocus></textarea>

                                    @error('comentarios')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0 justify-content-center">
                                <div class="col-md-12 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Crear Comanda') }}
                                    </button>

                                    <button type="reset" class="btn btn-danger">
                                        {{ __('Limpiar') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{-- ----------------------------------- FIN CREAR COMANDA --------------------------------- --}}

            {{-- ----------------------------------------------------------------------------------------------------------------- --}}


            {{-- ----------------------------------- INICIO COMANDAS ABIERTAS --------------------------------- --}}

            {{-- <div id="anchorComandasAbiertas"></div> --}}
            <div class="col-md-auto" id="comandasAbiertas">
                <div class="card">
                    <div class="card-header text-warning titulosComandas">
                        <h6 id="tituloComandaAbierta">Comandas Abiertas</h6>
                    </div>
                </div>
                @foreach ($comandas as $comanda)
                    @if ($comanda->id != null && $comanda->estado == 'abierta')
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $comanda->created_at }}
                                <br>
                                <strong>Mesa:</strong> {{ $comanda->mesa }}
                                <span class="textoDerecha"><strong>Nº Comanda:</strong>
                                    {{ $comanda->id }}</span>
                            </div>

                            <div class="card-body bodyComandas bodyComandasAbiertas">
                                <strong>Entrantes:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'entrantes')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Primeros:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'primeros')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Segundos:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'segundos')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Postres:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'postres')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Bebidas:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'bebidas')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Comentarios:</strong> {{ $comanda->comentarios }}
                                <br>

                                <div class="row mb-1 mt-1 botonesComandas">
                                    <div class="col-md-12 offset-md-3 mb-1 mt-1 justify-content-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Editar ') }}
                                        </button>

                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Cancelar ') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <h6 id="tituloComandaEnCurso">Comandas en Curso</h6>
                    </div>
                </div>
                @foreach ($comandas as $comanda)
                    @if ($comanda->id != null && $comanda->estado == 'en curso')
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $comanda->created_at }}
                                <br>
                                <strong>Mesa:</strong> {{ $comanda->mesa }}
                                <span class="textoDerecha"><strong>Nº Comanda:</strong>
                                    {{ $comanda->id }}</span>
                            </div>

                            <div class="card-body bodyComandas bodyComandasEnCurso">
                                <strong>Entrantes:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'entrantes')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Primeros:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'primeros')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Segundos:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'segundos')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Postres:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'postres')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Bebidas:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'bebidas')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Comentarios:</strong> {{ $comanda->comentarios }}
                                <br>

                                <div class="row mb-1 mt-1 botonesComandas">
                                    <div class="col-md-12 offset-md-3 mb-1 mt-1 justify-content-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Editar ') }}
                                        </button>

                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Cancelar ') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <h6 id="tituloComandaCerrada">Comandas Cerradas</h6>
                    </div>
                </div>
                @foreach ($comandas as $comanda)
                    @if ($comanda->id != null && $comanda->estado == 'cerrada')
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $comanda->created_at }}
                                <br>
                                <strong>Mesa:</strong> {{ $comanda->mesa }}
                                <span class="textoDerecha"><strong>Nº Comanda:</strong>
                                    {{ $comanda->id }}</span>
                            </div>

                            <div class="card-body bodyComandas bodyComandasCerradas">
                                <strong>Entrantes:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'entrantes')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Primeros:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'primeros')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Segundos:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'segundos')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Postres:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'postres')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Bebidas:</strong>
                                @foreach ($productos as $producto)
                                    @if ($producto->comanda_id == $comanda->id && $producto->categoria == 'bebidas')
                                        <div><br>{{ $producto->nombre }} x {{ $producto->cantidad }}</div>
                                    @endif
                                @endforeach
                                <br>
                                <strong>Comentarios:</strong> {{ $comanda->comentarios }}
                                <br>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- ----------------------------------- FIN COMANDAS CERRADAS --------------------------------- --}}

        </div>
    </div>
    <button id="ocultarCrear" type="button" class="btn alert alert-primary botonOcultar">Crear</button>
    <button id="ocultarAbiertas" type="button" class="btn alert alert-warning botonOcultar">Abiertas</button>
    <button id="ocultarEnCurso" type="button" class="btn alert alert-danger botonOcultar">En Curso</button>
    <button id="ocultarCerradas" type="button" class="btn alert alert-success botonOcultar">Cerradas</button>
@endsection
