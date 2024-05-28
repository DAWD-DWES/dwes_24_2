<?php

namespace App\DAO;

use PDO;
use App\Modelo\Partida;
use DateTime;

class PartidaDAO {

    /**
     * @var $bd Conexión a la Base de Datos
     */
    private PDO $bd;

    /**
     * Constructor de la clase UsuarioDAO
     * 
     * @param PDO $bd Conexión a la base de datos
     * 
     * @returns UsuarioDAO
     */
    public function __construct(PDO $bd) {
        $this->bd = $bd;
    }

    public function crea(Partida $partida): bool {
        
    }

    public function modifica(Partida $partida): bool {
        
    }

    public function elimina(int $id): bool {
        
    }

    public function obtenerPorCriteriosBusqueda(int $idUsuario, string $fechaBusqueda, int $minNumLetras, int $maxNumLetras, int $maxErrores, bool $ganadas): array {
// La consulta asume que 'ganadas' implica 'palabraDescubierta' compuesta solo de guiones
        $sql = "
            SELECT * 
            FROM partidas 
            WHERE idUsuario = :idUsuario
            AND numErrores <= :maxErrores
            AND LENGTH(palabraSecreta) BETWEEN :minNumLetras AND :maxNumLetras 
            AND inicio >= :fechaBusqueda"
                . (($ganadas) ? " AND palabraDescubierta = palabraSecreta" : "");

        $stmt = $this->bd->prepare($sql);
        $stmt->execute(["idUsuario" => $idUsuario, "fechaBusqueda" => $fechaBusqueda, "minNumLetras" => $minNumLetras, "maxNumLetras" => $maxNumLetras, "maxErrores" => $maxErrores]);
        $partidas = $stmt->fetchAll(PDO::FETCH_CLASS, Partida::class);
        return $partidas;
    }
}
