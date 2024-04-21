<?php
require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$vistas = __DIR__ . '/../vistas';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($vistas, $cache, BladeOne::MODE_DEBUG);

session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
}


echo $blade->run("formbusqueda", compact('usuario'));


