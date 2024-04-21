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
<form action="buscador.php" method="post" novalidate class="container mt-3">
    <h2 class="mb-3">Buscar Partidas</h2>
    <div class="mb-4">
        <label for="fechabusqueda" class="form-label">Fecha a partir de la que buscar:</label>
        <input type="text" class="form-control" id="fechabusqueda" name="fechabusqueda" placeholder="Ejemplo: 10/04/2024">
    </div>
    <div class="mb-4">
        <label for="rangoletras" class="form-label">Rango en el número de letras de la palabra secreta:</label>
        <input type="text" class="form-control" id="rangoletras" name="rangoletras" placeholder="Ejemplo: 5-10">
    </div>
    <div class="mb-4">
        <label for="numerofallos" class="form-label">Número máximo de fallos:</label>
        <input type="text" class="form-control" id="numerofallos" name="numerofallos" placeholder="Ejemplo: 3">
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


