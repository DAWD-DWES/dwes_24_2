<?php

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;
use App\BD\BD;
use App\DAO\PartidaDAO;
use App\Modelo\Partida;

session_start();

define("NUM_PARTIDAS_PAGINA", 10);


// Inicializa el acceso a las variables de entorno

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$vistas = __DIR__ . '/../vistas';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($vistas, $cache, BladeOne::MODE_DEBUG);

// Establece conexión a la base de datos PDO
try {
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $database = $_ENV['DB_DATABASE'];
    $usuario = $_ENV['DB_USUARIO'];
    $password = $_ENV['DB_PASSWORD'];
    $bd = BD::getConexion($host, $port, $database, $usuario, $password);
} catch (PDOException $error) {
    echo $blade->run("cnxbderror", compact('error'));
    die;
}

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    if (filter_has_var(INPUT_POST, 'botonbuscar')) {
        $fechaBusqueda = filter_input(INPUT_POST, 'fechabusqueda', FILTER_UNSAFE_RAW);
        $errorFechaBusqueda = !preg_match("/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/(19|20)\d\d$/", $fechaBusqueda) || !(DateTime::createFromFormat('d/m/Y', $fechaBusqueda));
        $rangoNumLetras = filter_input(INPUT_POST, 'rangonumletras', FILTER_UNSAFE_RAW);
        $errorRangoNumLetras = !preg_match("/^(\d+)-(\d+)$/", $rangoNumLetras, $coincidencias) 
                || $coincidencias[1] > 30 || $coincidencias[2] > 30 || $coincidencias[1] >= $coincidencias[2];
        $maxErrores = filter_input(INPUT_POST, 'maxerrores', FILTER_UNSAFE_RAW);
        $errorMaxErrores = !filter_var($maxErrores, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 5]]);
        $partidasGanadasCheck = filter_input(INPUT_POST, 'partidasganadas', FILTER_UNSAFE_RAW);
        $partidasGanadas = ($partidasGanadasCheck === 'on');
        $error = $errorFechaBusqueda || $errorRangoNumLetras || $errorMaxErrores;
        if ($error) {
            echo $blade->run("formbusqueda", compact('usuario', 'fechaBusqueda', 'errorFechaBusqueda', 'rangoNumLetras',
                            'errorRangoNumLetras', 'maxErrores', 'errorMaxErrores', 'partidasGanadas'));
        } else {
            $minNumLetras = $coincidencias[1];
            $maxNumLetras = $coincidencias[2];
            $partidaDAO = new PartidaDAO($bd);
            $partidas = $partidaDAO->obtenerPorCriteriosBusqueda($usuario->getId(),
                    $fechaBusqueda, $minNumLetras, $maxNumLetras, $maxErrores, $partidasGanadas);
            $_SESSION['partidasEncontradas'] = $partidas;
            $partidasAMostrar = array_slice($partidas, 0, NUM_PARTIDAS_PAGINA);
            $numPartidas = count($partidas);
            $numPartidasPagina = NUM_PARTIDAS_PAGINA;
            echo $blade->run("partidasencontradas", compact('usuario', 'partidasAMostrar', 'numPartidas', 'numPartidasPagina'));
        }
    } elseif (filter_has_var(INPUT_GET, 'pagina')) {
        $pagina = filter_input(INPUT_GET, 'pagina', FILTER_UNSAFE_RAW);
        $partidas = $_SESSION['partidasEncontradas'];
        $numPartidas = count($partidas);
        $numPartidasPagina = NUM_PARTIDAS_PAGINA;
        $partidasAMostrar = array_slice($partidas, NUM_PARTIDAS_PAGINA * ($pagina - 1), NUM_PARTIDAS_PAGINA);
        echo $blade->run("partidasencontradas", compact('usuario', 'partidasAMostrar', 'numPartidas', 'numPartidasPagina'));
    } else {
        echo $blade->run("formbusqueda", compact('usuario'));
    }
}

    