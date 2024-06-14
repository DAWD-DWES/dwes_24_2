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
}
