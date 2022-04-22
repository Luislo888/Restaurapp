@extends('layouts.app')

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
