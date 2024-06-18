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
<form action="juego.php" method="post" novalidate class="container mt-3">
    <h2 class="mb-3">Buscar Partidas</h2>
    <div class="mb-4">
        <label for="rangoletras" class="form-label">Rango en el número de letras de la palabra secreta:</label>
        <input type="text" class="form-control" id="rangoletras" name="rangoletras" placeholder="Ejemplo: 5-10">
    </div>
    <div class="mb-4">
        <label for="letraspalabrasecreta" class="form-label">Letras en la palabra secreta:</label>
        <input type="text" class="form-control" id="letraspalabrasecreta" name="letraspalabrasecreta" placeholder="Ejemplo: aertfo">
    </div>
    <div>
        <input type="submit" class="btn btn-primary" name="botonbuscar" value="Buscar Partidas">
    </div>
</form>
@endsection


