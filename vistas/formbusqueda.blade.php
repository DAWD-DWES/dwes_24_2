{{-- Usamos la vista app como plantilla --}}
@extends('app')
{{-- Sección aporta el título de la página --}}
@section('title', 'Formulario login')
{{-- Sección sobreescribe el barra de navegación de la plantilla app --}}
@section('navbar')
<li class="nav-item me-5">
    <a class="nav-link" aria-current="page" href="juego.php">Volver</a>
</li>
@endsection
{{-- Sección muestra el formulario de búsqueda de una partida --}}
@section('content')
@php
define ("ERROR_NUMRANGOLETRAS", 'Rango inválido');
define ("ERROR_MAXERRORES", 'Número de errores inválido');
@endphp
<form action="juego.php" method="post" novalidate class="container mt-3">
    <h2 class="mb-3">Buscar Partidas</h2>
    <div class="mb-4">
        <label for="rangoletras" class="form-label">Rango en el número de letras de la palabra secreta:</label>
        <input type="text" class= "{{ "form-control " . (isset($errorRangoNumLetras) ?  ($errorRangoNumLetras ? "is-invalid" : "is-valid") : "") }}" 
               id="rangonumletras" name="rangonumletras" placeholder="Ejemplo: 5-10" value="{{ ($rangoNumLetras ?? '') }}">
        <div class="invalid-feedback">
            <p>{{ ERROR_NUMRANGOLETRAS }}</p>
        </div>
    </div>
    <div class="mb-4">
        <label for="maxerrores" class="form-label">Número máximo de errores:</label>
        <input type="text" class= "{{ "form-control " . (isset($errorMaxErrores) ?  ($errorMaxErrores ? "is-invalid" : "is-valid") : "") }}" 
               id="maxerrores" name="maxerrores" placeholder="Ejemplo: 3" value="{{ ($maxErrores ?? '') }}">
        <div class="invalid-feedback">
            <p>{{ ERROR_MAXERRORES }}</p>
        </div>
    </div>
    <div class="mb-4 form-check">
        <input type="checkbox" class="form-check-input" id="partidasganadas" name="partidasganadas">
        <label class="form-check-label" for="partidasganadas">Partidas Ganadas</label>
    </div>
    <div>
        <input type="submit" class="btn btn-primary" name="botonbuscar" value="Buscar Partidas">
    </div>
</form>
@endsection


