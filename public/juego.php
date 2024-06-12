<?php

/**
 *  --- Lógica del script --- 
 * 
 * Establece conexión a la base de datos PDO
 * Si el usuario ya está validado
 *   Si se pide jugar con una letra
 *     Leo la letra
 *     Si no hay error en la letra introducida
 *       Solicito a la partida que compruebe la letra
 *       Invoco la vista de juego con los datos obtenidos
 *   Si no si se solicita una nueva partida
 *     Se crea una nueva partida
 *     Invoco la vista del juego para empezar a jugar
 *   Si no si se solicita el formulario de búsqueda de partidas
 *     Invoco la vista de búsqueda de partidas
 *   Si no si se pide que se procese una búsqueda
 *     Se leen los criterios de la búsqueda
 *     Si hay algún error
 *        Se invoca la vista del formulario mostrando los errores al jugador
 *      Si no  
 *        Se recuperan las partidas que cumplen los criterios de la BBDD
 *        Invoco la vista de listado de partidas recuperadas
 *    Si no si se pide volver del listado de partidas
 *      Redirecciono al navegador al script de juego
 *   Si no 
 *      Invoco la vista de juego
 *  Si no (En cualquier otro caso)
 *      Invoco la vista del formulario de login
 */
require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;
use App\Modelo\Partida;
use App\Almacen\AlmacenPalabrasFichero;
use App\BD\BD;
use App\DAO\PartidaDAO;

session_start();

define("MAX_NUM_ERRORES", 5);

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$views = __DIR__ . '/../vistas';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);

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

// Si el usuario ya está validado
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
// Si se pide jugar con una letra
    if (filter_has_var(INPUT_POST, 'botonenviarjugada')) {
// Leo la letra
        $letra = trim(filter_input(INPUT_POST, 'letra', FILTER_UNSAFE_RAW));
        $partida = $_SESSION['partida'];
// Compruebo si la letra no es válida (carácter no válido o ya introducida)
        $error = !$partida->esLetraValida($letra);
        // Si no hay error compruebo la letra
        if (!$error) {
            $partida->compruebaLetra(strtoupper($letra));
        }
        // Sigo jugando
        echo $blade->run("juego", compact('usuario', 'partida', 'error'));
// Si no si se solicita una nueva partida
    } elseif (filter_has_var(INPUT_GET, 'botonnuevapartida')) { // Se arranca una nueva partida
        $rutaFichero = $_ENV['RUTA_ALMACEN_PALABRAS'];
        $almacenPalabras = new AlmacenPalabrasFichero($rutaFichero);
        $partida = new Partida($almacenPalabras, MAX_NUM_ERRORES);
        $_SESSION['partida'] = $partida;
// Invoco la vista del juego para empezar a jugar
        echo $blade->run("juego", compact('usuario', 'partida'));
    } elseif (filter_has_var(INPUT_GET, 'petformbusqueda')) {
        echo $blade->run("formbusqueda", compact('usuario'));
    } elseif (filter_has_var(INPUT_POST, 'botonbuscar')) {
        $rangoNumLetras = filter_input(INPUT_POST, 'rangonumletras', FILTER_UNSAFE_RAW);
        $errorRangoNumLetras = !preg_match("/^(\d+)-(\d+)$/", $rangoNumLetras, $coincidencias) || $coincidencias[1] > 30 || $coincidencias[2] > 30 || $coincidencias[1] >= $coincidencias[2];
        $maxErrores = filter_input(INPUT_POST, 'maxerrores', FILTER_UNSAFE_RAW);
        $errorMaxErrores = !filter_var($maxErrores, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 5]]);
        $partidasGanadasCheck = filter_input(INPUT_POST, 'partidasganadas', FILTER_UNSAFE_RAW);
        $partidasGanadas = ($partidasGanadasCheck === 'on');
        $error = $errorRangoNumLetras || $errorMaxErrores;
        // Si hay algún error
        if ($error) {
            echo $blade->run("formbusqueda", compact('usuario', 'rangoNumLetras',
                            'errorRangoNumLetras', 'maxErrores', 'errorMaxErrores', 'partidasGanadas'));
        } else { // Si no hay error proceso la búsqueda
            $minNumLetras = $coincidencias[1];
            $maxNumLetras = $coincidencias[2];
            $partidaDAO = new PartidaDAO($bd);
            $partidas = $partidaDAO->obtenerPorCriteriosBusqueda($usuario->getId(),
                    (int) $minNumLetras, (int) $maxNumLetras, (int) $maxErrores, $partidasGanadas);
            echo $blade->run("partidasencontradas", compact('usuario', 'partidas'));
        }
    } else { //En cualquier otro caso
        $partida = $_SESSION['partida'];
        echo $blade->run("juego", compact('usuario', 'partida'));
    }
// En otro caso se muestra el formulario de login
} elseif (filter_has_var(INPUT_GET, 'buscadorvolver')) {
    header("Location:juego.php");
    die;
} else {
    echo $blade->run("formlogin");
}
