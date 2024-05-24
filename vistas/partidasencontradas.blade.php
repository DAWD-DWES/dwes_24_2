{{-- Usamos la vista app como plantilla --}}
@extends('app')
{{-- Sección aporta el título de la página --}}
@section('title', 'Buscador de partidas')
@section('navbar')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="buscador.php?volver=true">Volver</a>
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
                        <th scope="col">Fecha Fin</th>
                        <th scope="col">Ganada</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partidasAMostrar as $partida)
                    <tr>
                        <td>{{ $partida->getPalabraSecreta() }}</td>
                        <td>{{ $partida->getLetras() }}</td>
                        <td>{{ $partida->getNumErrores() }}</td>
                        <td>{{ $partida->getInicio()->format('d/m/Y') }}</td>
                        <td>{{ $partida->getFin()->format('d/m/Y') }}</td>
                        <td>{{ ($partida->getPalabraDescubierta() ===  $partida->getPalabraSecreta()) ? "Si" : "No"}}</td>
                    </tr>
                    @empty
                    <tr><td>No hay partidas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($numPartidas > $numPartidasPagina)
    <div class="row justify-content-center">
        <div class="col-auto">
            <nav>
                <ul class="pagination">
                    @for ($i = 1; $i < $numPartidas; $i += $numPartidasPagina)
                    <li class="page-item mx-2">
                        <a href="buscador.php?pagina={{ intdiv($i, $numPartidasPagina) + 1 }}">{{ intdiv ($i, $numPartidasPagina) + 1}}</a>
                    </li>
                    @endfor
                </ul>
            </nav>
        </div>
    </div>
    @endif
</div>    
@endsection

