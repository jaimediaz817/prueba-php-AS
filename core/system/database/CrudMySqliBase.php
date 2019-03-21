<?php
namespace camaleon\system\database;

use camaleon\system\database\MySqliConnection;

abstract class CrudMySqliBase extends MySqliConnection{

    private $mysqli;
    private $link;                              #reutilizado

    public function __construct() {
        $this->mysqli = parent::connect();     
    }

    /**
     * Comprueba si hay conexión activa con la bbdd (0=> cerrada, no hay; 1=> activa)
     */
    public function isLinked() {
        $response = (isset($this->mysqli) && is_object($this->mysqli) ? $this->mysqli->ping() : 0);
        return $response;
    }

    public function query($query, $count='') {
        $result = $this->mysqli->query($query);;

        if ($count=='') {
            $response = $result;
        } else {
            $num = $result->num_rows;
            $response = array(
                'data' => $result,
                'rows' => $num
            );
        }
        return $response;
    }

}