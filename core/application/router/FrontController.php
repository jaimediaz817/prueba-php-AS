<?php

namespace camaleon\RouterControllers;

//use camaleon\viewControllers\IndexController;
use camaleon\apis\ApiController;
use camaleon\errorControllers\ErrorController;

class FrontController {

    private static $path="";
    private static $isIndexController=true;
    private static $isApiRequest=false;
    private static $controllerName="";
    private static $paramsUrlGroup;
    
    public static function setParamsGroup($params) {
        self::$paramsUrlGroup = $params;
    }
    public static function getParamsGroup() {
        return self::$paramsUrlGroup;
    }

    public static function setControllerName(string $name='') {
        self::$controllerName=$name;
    }

    public static function getControllerName():string {
        return self::$controllerName;
    }

    //   R O U T E R 
    public static function getRouteUlrParams() {

        $urlGetParams = (isset($_GET['url']))? $_GET['url'] : "Index/index";
        //------------- EXISTENCIA DE CONTROLADOR POR GET-------------------------------
        $getController = 0;
        $getMethod = 0;
        $getParams = 0;
        //------------------------------------------------------------------------------
        $folderRootCrll='';
        $controller = '';
        $method = '';
        $params = '';
        $params2= '';

        $arreglo = explode("/", $urlGetParams);

        // comprobación de existencia de nombre prefijo al controlador |__________
        if (isset($arreglo[0])) {

            // TODO: validar si es una API o CONTROLLER            
            if ($arreglo[0] == "api") {
                self::$isApiRequest = true;
            }            

            $controller = getCapitalLetter($arreglo[0]) ."Controller";
            $folderRootCrll=$arreglo[0];
            $getController = 1;
            self::setControllerName($controller);
        } else {
            $controller = "IndexController";
        }

        // Comprobación de existencia de método |_________________________________
        if (isset($arreglo[1]) && $arreglo[1]!= '') {
            // TODO: api method request
            if (self::$isApiRequest) {
                $method = "initApiMethod";
            } else {
                $method = $arreglo[1];
            }            
            $getMethod = 1;
        } else {
            $method = 'index';
        }

        // API REQUEST, load controller
        if (self::$isApiRequest) {

            $path = "core/application/apis/". $controller . ".php";
            $method = "initApiController";
            if (file_exists($path)) {
                //require $path;
                //echo $path;
                //$apiObj = new $controller();
                $apiObj = new ApiController();
                // call method
                $apiObj->{$method}();
            }
            return 0;
        }
        
        // Refactorizar ------------------------------------
        if (isset($arreglo[2]) && !self::$isApiRequest) {
            // contar cantidad de parametros:
            if ($arreglo[2]!= '') {
                $respuesta = self::getParamsRequest($arreglo);
                if ($respuesta["countParams"]>1) {
                    self::setParamsGroup($respuesta["params"]);
                    $getParams = $respuesta["countParams"];
                } else if ($respuesta["countParams"] == 1) {
                    $params = $arreglo[2];
                    $getParams = 1;
                }
            }
        }

        // IS INDEX CONTROLLER
        if ($controller=="IndexController" && $getMethod==1) {
            self::$isIndexController=true;
        } else {
            self::$isIndexController=false;
        }

        //  INSTANCIATE
        if ($getController == 1){
            if(self::$isIndexController==true){
                $path = "core/application/controllers/". $controller . ".php";
                //echo "<br>{$folderRootCrll}<br>";
            }else{
                $path = "core/application/controllers/".$folderRootCrll."/". $controller . ".php";
            }

            if (file_exists($path)) {
                require $path;
                $controllerObj = new $controller();

                // Si existen parametros
                if ( $getMethod == 1){
                    if (method_exists($controllerObj, $method)) {

                        if ($getParams == 1) {                     
                            $controllerObj->{$method}($params);
                        } else if ($getParams > 1) {
                            $controllerObj->{$method}(self::getParamsGroup());
                        } else {
                            $controllerObj->{$method}();
                        }                                                    
                    } else {
                        // SIN MÉTODOS
                    }
                }
            } else {
                // TODO:refactor - mejora
                //exit("El controlador no existe fisicamente como artefacto PHP");
                $path = "core/application/controllers/errors/ErrorController.php";
                if (file_exists($path)) {
                    $errController = new ErrorController();
                    $errController->showError();
                }
            }
        }
    }

    public static function getParamsRequest($url) {
        $countParams = 0;
        $paramsGroup = array();
        $paramsFinal = '';
        foreach($url as $index => $val) {
            if ($index >= 2) {
                array_push($paramsGroup, $val);
                $countParams++;
            }            
        }
        $paramsFinal = implode(",",$paramsGroup);
        $response = array(
            "params" => $paramsFinal,
            "countParams" => $countParams
        );
        return $response;
    }

    public static function redirectApiRest($path) {

    }
}