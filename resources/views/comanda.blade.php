@extends('camarero')

@section('asdf')
    <div class="container marginTopBody">
        <div class="row justify-content-center miDiv">

            <div class="col-md-auto" id="crearComanda">
                <div class="card cardCrear" id="cardCrear">
                    <div class="card-header">
                        <h6 class="" id="tituloCrearComanda"><i class="fa-solid fa-pen-to-square"></i>
                            {{ __('Editar Comanda') }}</h6>
                    </div>

                    <div class="card-body" id="bodyCrearComanda">
                        <h6 class="alert alert-success notificacionCrearComanda" id="notificacionEditarSuccess">
                            {{ session('success') }}</h6>
                        <h6 class="alert alert-danger notificacionCrearComanda mb-3" id="notificacionEditarError">
                            {{ session('success') }}</h6>
                        <div class="row justify-content-center ">
                            <i class="fas fa-spinner fa-spin text-center" id="spinEditarComanda"></i>
                        </div>


                        <form method="POST" {{ route('comanda-update', ['id' => $comanda->id]) }} class=""
                            id="formEditarComanda">
                            @method('PATCH')
                            @csrf

                            {{-- INICIO COMANDA CABECERA --}}

                            <strong><i class="fa-solid fa-clock iconClock"></i></strong>
                            <span class="fechaFormateada">{{ $comanda->created_at }}</span>

                            <span class="textoDerecha"><strong>
                                    <img class="orderList" src="{{ asset('images/comanda.png') }}">
                                    Nº Comanda:</strong>
                                {{ $comanda->id }}</span>
                            <p></p>


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

                            {{-- FIN COMANDA CABECERA --}}



                            {{-- INICIO ENTRANTES --}}

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

                            <div class="row mb-3" id="">
                                <label for="primeros" id="labelEntrantes"
                                    class="col-md-3 col-form-label text-md-start"><strong>
                                        <img class="iconIzquierda" src="{{ asset('images/primeros.png') }}" alt="">

                                        {{ __('Primeros ') }}</strong></label>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                    <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarPrimero"></i>
                                </button>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                    <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarPrimero"></i>
                                </button>
                                <div class="col-md-5 inputProductos" id="col">
                                    <select id="primeros" name="productos[]" class="form-control">
                                        <option value="0" selected>Elige un primero</option>

                                        @foreach ($primeros as $primero)
                                            <option value="{{ $primero->id }}">{{ $primero->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number" class="form-control" name="cantidad[]">
                                </div>
                            </div>

                            @foreach ($productos as $producto)
                                @if ($producto->categoria == 'primeros' && $producto->comanda_id == $comanda->id)
                                    <div class="row mb-3" id="row">
                                        <label for="primeros" id="" class="col-md-5 col-form-label text-md-start"> </label>

                                        <div class="col-md-5 inputProductos" id="col">
                                            <select id="primeros" name="productos[]" class="form-control">
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
                                            <input id="" min="1" type="number" class="form-control" name="cantidad[]"
                                                value="{{ $producto->cantidad }}">
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            {{-- FIN PRIMEROS --}}



                            {{-- INICIO SEGUNDOS --}}

                            <div class="row mb-3" id="">
                                <label for="segundos" id="labelSegundos"
                                    class="col-md-3 col-form-label text-md-start"><strong>
                                        <img class="iconIzquierda" src="{{ asset('images/segundos.png') }}" alt="">

                                        {{ __('Segundos ') }}</strong></label>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                    <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarSegundo"></i>
                                </button>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                    <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarSegundo"></i>
                                </button>
                                <div class="col-md-5 inputProductos" id="col">
                                    <select id="segundos" name="productos[]" class="form-control">
                                        <option value="0" selected>Elige un segundo</option>

                                        @foreach ($segundos as $segundo)
                                            <option value="{{ $segundo->id }}">{{ $segundo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number" class="form-control" name="cantidad[]">
                                </div>
                            </div>

                            @foreach ($productos as $producto)
                                @if ($producto->categoria == 'segundos' && $producto->comanda_id == $comanda->id)
                                    <div class="row mb-3" id="row">
                                        <label for="segundos" id="" class="col-md-5 col-form-label text-md-start"> </label>

                                        <div class="col-md-5 inputProductos" id="col">
                                            <select id="segundos" name="productos[]" class="form-control">
                                                <option value="0" selected>Elige un segundo</option>

                                                @foreach ($segundos as $segundo)
                                                    @if ($segundo->id == $producto->producto_id)
                                                        <option selected value="{{ $segundo->id }}">
                                                            {{ $segundo->nombre }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $segundo->id }}">
                                                            {{ $segundo->nombre }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-md-2 cantidad">
                                            <input id="" min="1" type="number" class="form-control" name="cantidad[]"
                                                value="{{ $producto->cantidad }}">
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            {{-- FIN SEGUNDOS --}}



                            {{-- INICIO POSTRES --}}

                            <div class="row mb-3" id="">
                                <label for="postres" id="labelPostres"
                                    class="col-md-3 col-form-label text-md-start"><strong>
                                        <i class="fa-solid fa-ice-cream"></i>

                                        {{ __('Postres ') }}</strong></label>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                    <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarPostre"></i>
                                </button>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                    <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarPostre"></i>
                                </button>
                                <div class="col-md-5 inputProductos" id="col">
                                    <select id="postres" name="productos[]" class="form-control">
                                        <option value="0" selected>Elige un postre</option>

                                        @foreach ($postres as $postre)
                                            <option value="{{ $postre->id }}">{{ $postre->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number" class="form-control" name="cantidad[]">
                                </div>
                            </div>

                            @foreach ($productos as $producto)
                                @if ($producto->categoria == 'postres' && $producto->comanda_id == $comanda->id)
                                    <div class="row mb-3" id="row">
                                        <label for="postres" id="" class="col-md-5 col-form-label text-md-start"> </label>

                                        <div class="col-md-5 inputProductos" id="col">
                                            <select id="postres" name="productos[]" class="form-control">
                                                <option value="0" selected>Elige un postre</option>

                                                @foreach ($postres as $postre)
                                                    @if ($postre->id == $producto->producto_id)
                                                        <option selected value="{{ $postre->id }}">
                                                            {{ $postre->nombre }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $postre->id }}">
                                                            {{ $postre->nombre }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-md-2 cantidad">
                                            <input id="" min="1" type="number" class="form-control" name="cantidad[]"
                                                value="{{ $producto->cantidad }}">
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            {{-- FIN POSTRES --}}



                            {{-- INICIO BEBIDAS --}}

                            <div class="row mb-3" id="">
                                <label for="bebidas" id="labelBebidas"
                                    class="col-md-3 col-form-label text-md-start"><strong>
                                        <i class="fa-solid fa-wine-glass"></i>

                                        {{ __('Bebidas ') }}</strong></label>

                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                    <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarBebida"></i>
                                </button>
                                <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                    <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarBebida"></i>
                                </button>
                                <div class="col-md-5 inputProductos" id="col">
                                    <select id="bebidas" name="productos[]" class="form-control">
                                        <option value="0" selected>Elige una bebida</option>

                                        @foreach ($bebidas as $bebida)
                                            <option value="{{ $bebida->id }}">{{ $bebida->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 cantidad">
                                    <input id="" min="1" type="number" class="form-control" name="cantidad[]">
                                </div>
                            </div>

                            @foreach ($productos as $producto)
                                @if ($producto->categoria == 'bebidas' && $producto->comanda_id == $comanda->id)
                                    <div class="row mb-3" id="row">
                                        <label for="bebidas" id="" class="col-md-5 col-form-label text-md-start"> </label>

                                        <div class="col-md-5 inputProductos" id="col">
                                            <select id="bebidas" name="productos[]" class="form-control">
                                                <option value="0" selected>Elige una bebida</option>

                                                @foreach ($bebidas as $bebida)
                                                    @if ($bebida->id == $producto->producto_id)
                                                        <option selected value="{{ $bebida->id }}">
                                                            {{ $bebida->nombre }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $bebida->id }}">
                                                            {{ $bebida->nombre }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-md-2 cantidad">
                                            <input id="" min="1" type="number" class="form-control" name="cantidad[]"
                                                value="{{ $producto->cantidad }}">
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            {{-- FIN BEBIDAS --}}



                            {{-- INCIO COMENTARIOS --}}

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
                                    <button type="submit" class="btn btn-primary" id="botonEditarComanda">
                                        {{ __('Confirmar') }}
                                    </button>

                                    <button type="reset" class="btn btn-danger btnResetComanda">
                                        {{ __('Limpiar') }}
                                    </button>
                                </div>
                            </div>

                            {{-- FIN COMENTARIOS --}}
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
