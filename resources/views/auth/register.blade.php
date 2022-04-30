@extends('layouts.app')

@section('cabecera')
    <div id="tituloAdministrador">
        <h1 id="">Administrador <i class="fa-solid fa-user-gear"></i></h1>
        <a href="{{ url('/camarero') }}" class="btn btn-primary botonesAdmin" role="button" aria-disabled="true">Camareros
        </a>
        <a href="{{ url('/cocinero') }}" class="btn btn-primary botonesAdmin" role="button" aria-disabled="true">Cocineros
        </a>
    </div>
@endsection

@section('content')
    <div class="container marginTopBody">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>{{ __('Registrar Usuario') }}</h6>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <h6 class="alert alert-success notificacionSucces">{{ session('success') }}</h6>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('Nombre') }}</label>

                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-start">{{ __('Apellidos') }}</label>

                                <div class="col-md-7">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-start">{{ __('E-mail') }}</label>

                                <div class="col-md-7">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="rol" class="col-md-4 col-form-label text-md-start">{{ __('Rol ') }}</label>

                                <div class="col-md-7">

                                    <select id="registrarRol" name="rol"
                                        class="form-control @error('rol') is-invalid @enderror" value="{{ old('rol') }}"
                                        required autocomplete="rol">
                                        <option class="registrar" value="0" selected disabled>Elige un rol</option>
                                        <option class="registrar" value="1">Administrador</option>
                                        <option class="registrar" value="2">Camarero</option>
                                        <option class="registrar" value="3">Cocinero</option>
                                    </select>

                                    @error('rol')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-start">{{ __('Contraseña') }}</label>

                                <div class="col-md-7">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-start">{{ __('Confirmar Contraseña') }}</label>

                                <div class="col-md-7">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-7 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
