@extends('layouts.app')
{{-- @extends('camarero') --}}

@section('cabecera')
    <h6 class="tituloRol">Editar Comanda</h6>
    <div class="collapse navbar-collapse text-center justify-content-center comandasNavTabs" id="navbarSupportedContent">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button id="botonCrear" type="button" class="btn alert alert-primary">Crear</button>
            <button id="botonAbiertas" type="button" class="btn alert alert-warning">Abiertas</button>
            <button id="botonCurso" type="button" class="btn alert alert-danger">EnCurso</button>
            <button id="botonCerradas" type="button" class="btn alert alert-success">Cerradas</button>

        </div>
    </div>
@endsection

{{-- @section('asdf') --}}
{{-- @if (isset($_GET['editarComanda'])) --}}
<div class="container marginTopBody">
    <div class="row justify-content-center miDiv">

        <div class="col-md-auto" id="crearComanda">
            <div class="card cardCrear" id="cardCrear">
                <div class="card-header">
                    <h6 class="" id="tituloCrearComanda"><i class="fa-solid fa-pen-to-square"></i>
                        {{ __('Editar Comanda') }}</h6>
                </div>

                <div class="card-body" id="bodyCrearComanda">
                    {{-- @if (session('success'))
                        <h6 class="alert alert-success notificacionSucces">{{ session('success') }}</h6>
                    @endif
                    <h6 class="alert alert-success notificacionSucces">{{ session('success') }}</h6> --}}
                    <h6 class="alert alert-success notificacionCrearComanda" id="notificacionSuccess">
                        {{ session('success') }}</h6>
                    <h6 class="alert alert-danger notificacionCrearComanda mb-3" id="notificacionError">
                        {{ session('success') }}</h6>
                    <div class="row justify-content-center ">
                        <i class="fas fa-spinner fa-spin text-center"></i>
                    </div>


                    <form method="POST" {{ route('comanda-update', ['id' => $comanda->id]) }} class=""
                        id="">
                        {{-- id="formCrearComanda"> --}}
                        @method('PATCH')
                        @csrf

                        {{-- Nº MESA --}}
                        <strong><i class="fa-solid fa-clock iconClock"></i></strong>
                        <span class="fechaFormateada">{{ $comanda->created_at }}</span>

                        <span class="textoDerecha"><strong>
                                <img class="orderList" src="{{ asset('images/comanda.png') }}">
                                Nº Comanda:</strong>
                            {{ $comanda->id }}</span>
                        <p></p>

                        {{-- INICIO ENTRANTES --}}

                        <div class="row mb-4">

                            <label for="mesa" class="col-md-9 col-form-label text-md-start"><strong>
                                    <img src="{{ asset('images/mesa.png') }}" alt="">
                                    {{ __('Nº Mesa') }}</strong></label>

                            <div class="col-md-2 cantidad numeroMesa">
                                <input id="mesa" min="1" max="6" type="number"
                                    class="form-control @error('mesa') is-invalid @enderror" name="mesa" required
                                    autocomplete="mesa" autofocus value="{{ $comanda->mesa }}">

                                @error('mesa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3" id="rowEntrantes">
                            <label for="entrantes" id="labelEntrantes"
                                class="col-md-3 col-form-label text-md-start"><strong>
                                    <img class="iconIzquierda" src="{{ asset('images/entrantes.png') }}" alt="">

                                    {{ __('Entrantes ') }}</strong></label>

                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarEntrante"></i>
                            </button>
                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarEntrante"></i>
                            </button>
                            <div class="col-md-5 inputProductos" id="colEntrantes">
                                <select id="selectEntrantes" name="productos[]"
                                    class="form-control @error('entrantes') is-invalid @enderror "
                                    autocomplete="entrantes">
                                    <option value="0" selected>Elige un entrante</option>

                                    @foreach ($entrantes as $entrante)
                                        <option value="{{ $entrante->id }}">{{ $entrante->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-2 cantidad">
                                <input id="" min="1" type="number"
                                    class="form-control @error('cantidad') is-invalid @enderror" name="cantidad[]"
                                    autocomplete="cantidad" autofocus>

                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        @foreach ($productos as $producto)
                            @if ($producto->categoria == 'entrantes' && $producto->comanda_id == $comanda->id)
                                <div class="row mb-3" id="rowEntrantes">
                                    <label for="entrantes" id="labelEntrantes"
                                        class="col-md-5 col-form-label text-md-start"> </label>

                                    <div class="col-md-5 inputProductos" id="colEntrantes">
                                        <select id="selectEntrantes" name="productos[]"
                                            class="form-control @error('entrantes') is-invalid @enderror "
                                            autocomplete="entrantes">
                                            <option value="0" selected>Elige un entrante</option>

                                            @foreach ($entrantes as $entrante)
                                                @if ($entrante->id == $producto->producto_id)
                                                    <option selected value="{{ $entrante->id }}">
                                                        {{ $entrante->nombre }}
                                                    </option>
                                                @else
                                                    <option value="{{ $entrante->id }}">
                                                        {{ $entrante->nombre }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-2 cantidad">
                                        <input id="" min="1" type="number"
                                            class="form-control @error('cantidad') is-invalid @enderror"
                                            name="cantidad[]" value="{{ $producto->cantidad }}"
                                            autocomplete="cantidad" autofocus>

                                        @error('cantidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        {{-- FIN ENTRANTES --}}


                        {{-- INICIO PRIMEROS --}}

                        {{-- <div class="row mb-3" id="rowPrimeros">
                            <label for="primeros" id="labelPrimeros"
                                class="col-md-3 col-form-label text-md-start"><strong>
                                    <img class="iconIzquierda" src="{{ asset('images/primeros.png') }}" alt="">

                                    {{ __('Primeros ') }}</strong></label>

                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarPrimero"></i>
                            </button>
                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarPrimero"></i>
                            </button>
                            <div class="col-md-5 inputProductos" id="colPrimeros">
                                <select id="selectPrimeros" name="productos[]"
                                    class="form-control @error('primeros') is-invalid @enderror "
                                    autocomplete="primeros">
                                    <option value="0" selected>Elige un primero</option>

                                    @foreach ($primeros as $primero)
                                        <option value="{{ $primero->id }}">{{ $primero->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-2 cantidad">
                                <input id="" min="1" type="number"
                                    class="form-control @error('cantidad') is-invalid @enderror" name="cantidad[]"
                                    autocomplete="cantidad" autofocus>

                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        @foreach ($productos as $producto)
                            @if ($producto->categoria == 'primeros' && $producto->comanda_id == $comanda->id)
                                <div class="row mb-3" id="rowPrimeros">
                                    <label for="primeros" id="labelPrimeros"
                                        class="col-md-5 col-form-label text-md-start"> </label>

                                    <div class="col-md-5 inputProductos" id="colPrimeros">
                                        <select id="selectPrimeros" name="productos[]"
                                            class="form-control @error('primeros') is-invalid @enderror "
                                            autocomplete="primeros">
                                            <option value="0" selected>Elige un primero</option>

                                            @foreach ($primeros as $primero)
                                                @if ($primero->id == $producto->producto_id)
                                                    <option selected value="{{ $primero->id }}">
                                                        {{ $primero->nombre }}
                                                    </option>
                                                @else
                                                    <option value="{{ $primero->id }}">
                                                        {{ $primero->nombre }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-2 cantidad">
                                        <input id="" min="1" type="number"
                                            class="form-control @error('cantidad') is-invalid @enderror"
                                            name="cantidad[]" value="{{ $producto->cantidad }}"
                                            autocomplete="cantidad" autofocus>

                                        @error('cantidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        @endforeach --}}

                        {{-- FIN PRIMEROS --}}



                        {{-- SEGUNDOS --}}


                        {{-- <div class="row mb-3">
                            <label for="segundos" class="col-md-3 col-form-label text-md-start"><strong>
                                    <img class="iconIzquierda" src="{{ asset('images/segundos.png') }}" alt="">
                                    {{ __('Segundos ') }}</strong></label>

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
                                    autocomplete="segundos">
                                    <option value="0" selected>Elige un segundo</option>
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
                                    autocomplete="cantidad" autofocus>

                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- POSTRES --}}

                        {{-- <div class="row mb-3">
                            <label for="postres" class="col-md-3 col-form-label text-md-start"><strong>
                                    <i class="fa-solid fa-ice-cream"></i> {{ __('Postres ') }}
                                </strong></label>

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
                                    class="form-control @error('postres') is-invalid @enderror" autocomplete="postres">
                                    <option value="0" selected>Elige un postre</option>
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
                                    autocomplete="cantidad" autofocus>

                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- BEBIDAS --}}

                        {{-- <div class="row mb-3">
                            <label for="bebidas" class="col-md-3 col-form-label text-md-start"><strong><i
                                        class="fa-solid fa-wine-glass"></i> {{ __('Bebidas ') }}</strong></label>

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
                                    class="form-control @error('bebidas') is-invalid @enderror" autocomplete="bebidas">
                                    <option value="0" selected>Elige una bebida</option>
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
                                    autocomplete="cantidad" autofocus>

                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- COMENTARIOS --}}

                        <div class="row mb-3">
                            <label for="comentarios" class="col-md-3 col-form-label text-md-start"
                                id="comentarioLabel"><strong><i class="fa-solid fa-comment"></i>
                                    {{ __('Comentarios') }}</strong></label>

                            <div class="col-md-8">
                                <textarea id="comentarioInput" min="1" max="6" class="form-control @error('comentarios') is-invalid @enderror"
                                    name="comentarios" autocomplete="comentarios"
                                    autofocus>{{ $comanda->comentarios }}</textarea>

                                @error('comentarios')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0 justify-content-center">
                            <div class="col-md-12 offset-md-6">
                                <button type="submit" class="btn btn-primary" id="botonCrearComanda">
                                    {{ __('Confirmar') }}
                                </button>

                                <button type="reset" class="btn btn-danger btnResetComanda">
                                    {{ __('Limpiar') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
{{-- @endif --}}
{{-- @endsection --}}
