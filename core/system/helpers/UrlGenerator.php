<?php

namespace camaleon\helpers;

/**
 * Description of DataTimeManager
 *
 * @author Jaime Diaz <jaimeivan0017@gmail.com>
 */

class UrlGenerator {
	/**
	* CONSTRUCTOR __
	*/
    public function __Construct() {}

	public function obtenerURL() {
		$s = empty($_SERVER["HTTPS"])?'':($_SERVER["HTTPS"] == "on")?"s":"";
		$protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]),"/").$s;
		$port=($_SERVER["SERVER_PORT"]=="80")?"":(":".$_SERVER["SERVER_PORT"]);
		return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
    }

	public function getAmbienteApplication() {
		$urlCompleta = $this->obtenerURL();
		$datos = parse_url($urlCompleta);
		$hostVar = $datos['host'];
		return $hostVar;
	}
	
	public function getSingleURLRoot() {
		$urlCompleta = $this->obtenerURL();
		$datos = parse_url($urlCompleta);
		$hostVar = $datos['host'];
		$path = explode("/", $datos['path']);
		//validacion para el tipo de ambiente:
		if ($hostVar == 'localhost'){
			//cambiar la visibilidad del proyecto
			$explodePath = $path[1]. "/";
		}else {
			$explodePath = $path[0];
		}
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
		return  $datos['scheme']."://". $datos['host'] . $port ."/". $explodePath;         
    }

    public function obtenerURL_DirectorioActual() {
        $varPath = getcwd();
        return $varPath;
    }
    public function get__DIRname() {
        $dirname = dirname(__DIR__);
        return $dirname;
    }
    public function strleft($s1, $s2) {
        return substr($s1, 0, strpos($s1, $s2));
    }		
} 