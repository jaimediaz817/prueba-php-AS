<?php

require_once "vendor/autoload.php";

// Class Uses
use camaleon\examples\BaseExamples;
use Dotenv\Dotenv;
use camaleon\helpers\UrlGeneratorFacade;
use camaleon\helpers\ResourceBundle2;
// Rutas
use camaleon\RouterControllers\FrontController;

class IndexApp {
    public function __construct() {}

    public function initApacheConfig() {
        // configuracion de apache, zona horaria
        date_default_timezone_set('America/Bogota');
        // lineas de ejecución
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
    }

    /**
     * Inicializa datos relativos al entorno donde se ejecuta.
     */
    public function initEnviromentData(){
        $dotenv = Dotenv::create(__DIR__.'/private');
        $dotenv->load();
    }

    /**
     * Inicializa constantes
     */
    public function initConstantsURL(){
        //   F U N C T I O N S
        $includes = "core/application/includes/";
        define('PATHINCLUDES', $includes);

        //   U R L   G E N E R A T O R - B A S E # 1
        $urlGenerator1 = UrlGeneratorFacade::getInstanceURLGenerator()->obtenerURL();
        define('SINGLE_URL_OLD', $urlGenerator1);

        //   U R L   G E N E R A T O R - B A S E 
        $urlGenerator = UrlGeneratorFacade::getInstanceURLGenerator()->getSingleURLRoot();
        define('SINGLE_URL', $urlGenerator);

        //   U R L   G E N E R A T O R - A S S E T S 
        define('ASSET_URL', $urlGenerator . 'assets/');
        ResourceBundle2::writeErrorLog("830", "from:: CONSTANT EXISTE LA SESSION, METODO NUEVO");
    }

    public function validarAmbienteApp() {
        //$ambienteApp = InnerUrlGenerator::getInstanceURLGenerator()->getAmbienteApplication
        $ambiente = UrlGeneratorFacade::getInstanceURLGenerator()->getAmbienteApplication();
        $textEnv = '';
        if ($ambiente == "camaleon" || $ambiente == "localhost") {
            $dbHost = getenv('DB_HOST_DEV');
            $dbName = getenv('DB_NAME_DEV');
            $dbUser = getenv('DB_USER_DEV');
            $dbPass = getenv('DB_PASSWORD_DEV');

            define('_DB_HOST',$dbHost);
            define('_DB_USER',$dbUser);
            define('_DB_PASS',$dbPass);
            define('_DB_NAME',$dbName);
            $textEnv = 'local';
        } else {
            //---------------------------------------
            /*****      P R O D U C C I O N    *****/
            $dbHost = getenv('DB_HOST_PRO');
            $dbName = getenv('DB_NAME_PRO');
            $dbUser = getenv('DB_USER_PRO');
            $dbPass = getenv('DB_PASSWORD_PRO');
        
            define('_DB_HOST',$dbHost);
            define('_DB_USER',$dbUser);
            define('_DB_PASS',$dbPass);
            define('_DB_NAME',$dbName);
            $textEnv = 'production';
        }
        define('ENVIROMENT_NAME', $textEnv);
        $textEnv = null;
        //echo "<br>ambiente <br>". _DB_HOST . ", ". _DB_USER. ", ". _DB_PASS. ", ". _DB_NAME;
    }

    public function initFrontControllerRouter() {
        FrontController::getRouteUlrParams();
    }

    public function loadFunctions() {
        require_once(PATHINCLUDES.'functions.inc.php');
    }
    /**
     * @Examples
     */
    public function initExamples(){
        $examples = new BaseExamples();
    }
}



$index = new IndexApp();
//************************************************** */
// Apache
$index->initApacheConfig();

// Constants
$index->initConstantsURL();
// Enviroment
$index->initEnviromentData();

// AMBIENTE
$index->validarAmbienteApp();

// Functions
$index->loadFunctions();
// Routes
$index->initFrontControllerRouter();
//************************************************** */
//$index->initExamples();

