<?php

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;
use App\BD\BD;
use App\DAO\PartidaDAO;
use App\Modelo\Partida;

session_start();

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
        $fechaBusqueda = filter_input(INPUT_POST, 'fechabusqueda');
        $rangoNumLetras = filter_input(INPUT_POST, 'rangonumletras');
        $maxErrores = filter_input(INPUT_POST, 'maxerrores');
        $partidasGanadas = filter_input(INPUT_POST, 'partidasganadas');
        $errorRangoLetras = !(preg_match('/^(\d+)\-(\d+)$/', $rangoNumLetras, $coincidencias));
        if (!$errorRangoLetras) {
            $minNumLetras = $coincidencias[1];
            $maxNumLetras = $coincidencias[2];
        }
        $partidaDAO = new PartidaDAO($bd);
        $partidas = $partidaDAO->obtenerPorCriteriosBusqueda($usuario->getId(),
                $fechaBusqueda, $minNumLetras, $maxNumLetras, $maxErrores, $partidasGanadas);
        echo "asda";
    }
}


echo $blade->run("formbusqueda", compact('usuario'));

