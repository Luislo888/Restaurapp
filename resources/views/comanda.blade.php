{{-- @extends('layouts.app') --}}
@extends('camarero')

{{-- @section('cabecera')
    <h6 class="tituloRol">Editar Comanda</h6>
    <div class="collapse navbar-collapse text-center justify-content-center comandasNavTabs" id="navbarSupportedContent">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button id="botonCrear" type="button" class="btn alert alert-primary">Crear</button>
            <button id="botonAbiertas" type="button" class="btn alert alert-warning">Abiertas</button>
            <button id="botonCurso" type="button" class="btn alert alert-danger">EnCurso</button>
            <button id="botonCerradas" type="button" class="btn alert alert-success">Cerradas</button>

        </div>
    </div>
@endsection --}}

@section('asdf')
    {{-- @if (isset($_GET['editarComanda'])) --}}
    <div class="container marginTopBody">
        <div class="row justify-content-center miDiv">


            <div class="col-md-auto" id="crearComanda">
                <div class="card cardCrear" id="cardCrear">
                    <div class="card-header">
                        <h6 class="" id="tituloCrearComanda">{{ __('Editar Comanda') }}</h6>
                    </div>

                    <div class="card-body" id="bodyCrearComanda">
                        @if (session('success'))
                            <h6 class="alert alert-success notificacionSucces">{{ session('success') }}</h6>
                        @endif

                        <form method="POST" action="{{ route('comanda-update', ['id' => $comanda->id]) }}"
                            class="">
                            @method('PATCH')
                            @csrf

                            {{-- Nº MESA --}}

                            <div class="row mb-4">
                                <span class="textoDerecha">{{ $comanda->created_at }}</span>
                                <br>
                                <span class="textoDerecha"><strong>Nº Comanda:</strong>
                                    {{ $comanda->id }}</span>

                                <label for="mesa"
                                    class="col-md-9 col-form-label text-md-start"><strong>{{ __('Nº Mesa') }}</strong></label>

                                <div class="col-md-2 cantidad numeroMesa">
                                    <input id="mesa" min="1" max="6" type="number"
                                        class="form-control @error('mesa') is-invalid @enderror" name="mesa"
                                        value="{{ $comanda->mesa }}" required autocomplete="mesa" autofocus>

                                    @error('mesa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- ENTRANTES --}}

                            @foreach ($comanda->producto as $producto)
                                @if ($producto->categoria == 'entrantes')
                                    <div class="row mb-3">
                                        @if ($loop->first)
                                            <label for="entrantes"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Entrantes') }}</strong></label>
                                        @else
                                            <label for="entrantes"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __(' ') }}</strong>
                                            </label>
                                        @endif


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
                                                <option selected>Elige un entrante</option>
                                                @foreach ($todosProductos as $todosProducto)
                                                    @if ($todosProducto->id == $producto->id)
                                                        <option value="{{ $todosProducto->id }}" selected>
                                                            {{ $todosProducto->nombre }}</option>
                                                    @elseif ($todosProducto->categoria == 'entrantes')
                                                        <option value="{{ $todosProducto->id }}">
                                                            {{ $todosProducto->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 cantidad">
                                            @foreach ($comandasProductos as $comandasProducto)
                                                @if ($producto->id == $comandasProducto->producto_id)
                                                    <input id="" min="1" type="number" class="form-control"
                                                        name="cantidad[]" value='{{ $comandasProducto->cantidad }}'
                                                        placeholder="{{ $comandasProducto->cantidad }}">
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            {{-- PRIMEROS --}}

                            <div class="row mb-3">

                                @foreach ($comanda->producto as $producto)
                                    @if ($producto->categoria == 'primeros')
                                        @if ($loop->first)
                                            <label for="primeros"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Primeros') }}</strong></label>
                                        @else
                                            <label for="primeros"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Primero') }}</strong>
                                            </label>
                                        @endif

                                        <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                            <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarEntrante"></i>
                                        </button>
                                        <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                            <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarEntrante"></i>
                                        </button>

                                        <div class="col-md-5 inputProductos" id="col">

                                            <select id="primeros" name="productos[]"
                                                class="form-control @error('primeros') is-invalid @enderror "
                                                value="{{ old('primeros') }}" required autocomplete="primeros">

                                                @foreach ($todosProductos as $todosProducto)
                                                    @if ($todosProducto->id == $producto->id)
                                                        <option value="{{ $todosProducto->id }}" selected>
                                                            {{ $todosProducto->nombre }}</option>
                                                    @elseif ($todosProducto->categoria == 'primeros')
                                                        <option value="{{ $todosProducto->id }}">
                                                            {{ $todosProducto->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 cantidad">
                                            @foreach ($comandasProductos as $comandasProducto)
                                                @if ($producto->id == $comandasProducto->producto_id)
                                                    <input id="" min="1" type="number"
                                                        class="form-control @error('cantidad') is-invalid @enderror"
                                                        name="cantidad[]" value="{{ $comandasProducto->cantidad }}"
                                                        placeholder="{{ $comandasProducto->cantidad }}"
                                                        autocomplete="cantidad" autofocus>
                                                    @error(' cantidad')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            {{-- SEGUNDOS --}}
                            <div class="row mb-3">

                                @foreach ($comanda->producto as $producto)
                                    @if ($producto->categoria == 'segundos')
                                        @if ($loop->first)
                                            <label for="segundos"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Segundos') }}</strong></label>
                                        @else
                                            <label for="segundos"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Segundo') }}</strong>
                                            </label>
                                        @endif

                                        <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                            <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarEntrante"></i>
                                        </button>
                                        <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                            <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarEntrante"></i>
                                        </button>

                                        <div class="col-md-5 inputProductos" id="col">

                                            <select id="segundos" name="productos[]"
                                                class="form-control @error('segundos') is-invalid @enderror "
                                                value="{{ old('segundos') }}" required autocomplete="segundos">

                                                @foreach ($todosProductos as $todosProducto)
                                                    @if ($todosProducto->id == $producto->id)
                                                        <option value="{{ $todosProducto->id }}" selected>
                                                            {{ $todosProducto->nombre }}</option>
                                                    @elseif ($todosProducto->categoria == 'segundos')
                                                        <option value="{{ $todosProducto->id }}">
                                                            {{ $todosProducto->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 cantidad">
                                            @foreach ($comandasProductos as $comandasProducto)
                                                @if ($producto->id == $comandasProducto->producto_id)
                                                    <input id="" min="1" type="number"
                                                        class="form-control @error('cantidad') is-invalid @enderror"
                                                        name="cantidad[]" value="{{ $comandasProducto->cantidad }}"
                                                        placeholder="{{ $comandasProducto->cantidad }}"
                                                        autocomplete="cantidad" autofocus>
                                                    @error('cantidad')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            {{-- POSTRES --}}

                            <div class="row mb-3">
                                @foreach ($comanda->producto as $producto)
                                    {{-- {{ $productoasdf->nombre }} --}}

                                    @if ($producto->categoria == 'postres')
                                        @if ($loop->first)
                                            <label for="postres"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Postres') }}</strong></label>
                                        @else
                                            <label for="postres"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Postre') }}</strong>
                                            </label>
                                        @endif

                                        <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                            <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarEntrante"></i>
                                        </button>
                                        <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                            <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarEntrante"></i>
                                        </button>

                                        <div class="col-md-5 inputProductos" id="col">

                                            <select id="postres" name="productos[]"
                                                class="form-control @error('postres') is-invalid @enderror "
                                                value="{{ old('postres') }}" required autocomplete="postres">

                                                @foreach ($todosProductos as $todosProducto)
                                                    @if ($todosProducto->id == $producto->id)
                                                        <option value="{{ $todosProducto->id }}" selected>
                                                            {{ $todosProducto->nombre }}</option>
                                                    @elseif ($todosProducto->categoria == 'postres')
                                                        <option value="{{ $todosProducto->id }}">
                                                            {{ $todosProducto->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 cantidad">
                                            @foreach ($comandasProductos as $comandasProducto)
                                                @if ($producto->id == $comandasProducto->producto_id)
                                                    <input id="" min="1" type="number"
                                                        class="form-control @error('cantidad') is-invalid @enderror"
                                                        name="cantidad[]" value="{{ $comandasProducto->cantidad }}"
                                                        placeholder="{{ $comandasProducto->cantidad }}"
                                                        autocomplete="cantidad" autofocus>
                                                    @error('cantidad')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            {{-- BEBIDAS --}}

                            <div class="row mb-3">

                                @foreach ($comanda->producto as $producto)
                                    {{-- {{ $productoasdf->nombre }} --}}

                                    @if ($producto->categoria == 'bebidas')
                                        @if ($loop->first)
                                            <label for="bebidas"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Bebidas') }}</strong></label>
                                        @else
                                            <label for="bebidas"
                                                class="col-md-3 col-form-label text-md-start"><strong>{{ __('Bebida') }}</strong>
                                            </label>
                                        @endif

                                        <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas">
                                            <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarEntrante"></i>
                                        </button>
                                        <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                            <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarEntrante"></i>
                                        </button>

                                        <div class="col-md-5 inputProductos" id="col">

                                            <select id="bebidas" name="productos[]"
                                                class="form-control @error('bebidas') is-invalid @enderror "
                                                value="{{ old('bebidas') }}" required autocomplete="bebidas">

                                                @foreach ($todosProductos as $todosProducto)
                                                    @if ($todosProducto->id == $producto->id)
                                                        <option value="{{ $todosProducto->id }}" selected>
                                                            {{ $todosProducto->nombre }}</option>
                                                    @elseif ($todosProducto->categoria == 'bebidas')
                                                        <option value="{{ $todosProducto->id }}">
                                                            {{ $todosProducto->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 cantidad">
                                            @foreach ($comandasProductos as $comandasProducto)
                                                @if ($producto->id == $comandasProducto->producto_id)
                                                    <input id="" min="1" type="number"
                                                        class="form-control @error('cantidad') is-invalid @enderror"
                                                        name="cantidad[]" value="{{ $comandasProducto->cantidad }}"
                                                        placeholder="{{ $comandasProducto->cantidad }}"
                                                        autocomplete="cantidad" autofocus>
                                                    @error('cantidad')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            {{-- COMENTARIOS --}}

                            <div class="row mb-3">
                                <label for="comentarios" class="col-md-3 col-form-label text-md-start"
                                    id="comentarioLabel"><strong>{{ __('Comentarios') }}</strong></label>

                                <div class="col-md-8">
                                    <textarea id="comentarioInput" min="1" max="6" type="number"
                                        class="form-control @error('comentarios') is-invalid @enderror"
                                        name="comentarios" value="" autocomplete="comentarios" autofocus
                                        placeholder="">{{ $comanda->comentarios }}</textarea>

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
                                        {{ __('Confirmar') }}
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
        </div>
    </div>
    {{-- @endif --}}
@endsection
