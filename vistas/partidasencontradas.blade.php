{{-- Usamos la vista app como plantilla --}}
@extends('app')
{{-- Sección aporta el título de la página --}}
@section('title', 'Buscador de partidas')
@section('navbar')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="juego.php?buscadorvolver">Volver</a>
</li>
@endsection
{{-- Sección muestra vista de juego para que el usuario elija una letra --}}
@section('content')
<div class="container">
    <h2 class="my-2 text-center">Partidas Encontradas</h2>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Palabra Secreta</th>
                        <th scope="col">Letras</th>
                        <th scope="col">NumErrores</th>
                        <th scope="col">Fecha Inicio</th>
                        <th scope="col">Hora Inicio</th>
                        <th scope="col">Fecha Fin</th>
                        <th scope="col">Hora Fin</th>
                        <th scope="col">Ganada</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partidas as $partida)
                    @php
                    $inicioValores = explode(' ', $partida->getInicio());
                    $finValores = explode(' ', $partida->getFin());
                    @endphp                    <tr>
                        <td>{{ $partida->getPalabraSecreta() }}</td>
                        <td>{{ $partida->getLetras() }}</td>
                        <td>{{ $partida->getNumErrores() }}</td>
                        <td>{{ $inicioValores[0] }}</td>
                        <td>{{ $inicioValores[1] }}</td>
                        <td>{{ $finValores[0] }}</td>
                        <td>{{ $finValores[1] }}</td>
                        <td>{{ ($partida->getPalabraDescubierta() ===  $partida->getPalabraSecreta()) ? "Si" : "No"}}</td>
                    </tr>
                    @empty
                    <tr><td>No hay partidas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>    
@endsection

