<?php

namespace App\DAO;

use PDO;
use App\Modelo\Partida;

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
    
    public function recuperaPorIdUsuario(int $idUsuario): array {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = "select * from partidas where idUsuario = :idUsuario";
        $sth = $this->bd->prepare($sql);
        $sth->execute(["idUsuario" => $idUsuario]);
        $sth->setFetchMode(PDO::FETCH_CLASS, Partida::class);
        $partidas = $sth->fetchAll();
        return $partidas;
    }

    public function obtenerPorCriteriosBusqueda(int $idUsuario, int $minNumLetras, int $maxNumLetras, int $maxErrores, bool $ganadas): array {
        $sql = "
            SELECT * 
            FROM partidas 
            WHERE idUsuario = :idUsuario
            AND numErrores <= :maxErrores
            AND LENGTH(palabraSecreta) BETWEEN :minNumLetras AND :maxNumLetras"
                . (($ganadas) ? " AND palabraDescubierta = palabraSecreta" : "");
        $stmt = $this->bd->prepare($sql);
        $stmt->execute(["idUsuario" => $idUsuario, "minNumLetras" => $minNumLetras, "maxNumLetras" => $maxNumLetras, "maxErrores" => $maxErrores]);
        $partidas = $stmt->fetchAll(PDO::FETCH_CLASS, Partida::class);
        return $partidas;
    }
}
