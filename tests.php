<?php

require_once "vendor/autoload.php";
use camaleon\examples\BaseExamples;
use Dotenv\Dotenv;


// VLUCAS LIBRARY
// $dotenv = new Dotenv(__DIR__ . '/private');
// $dotenv->load();
$dotenv = Dotenv::create(__DIR__.'/private');
$dotenv->load();


require_once "Coche.php";

//

$carro = new Coche();
echo "datos: ". $carro->getColor() . "  " . var_dump($carro). " <br> ENV: ". getenv('DB_HOST_DEV') ;
$ejemplos = new BaseExamples();
print_r(PDO::getAvailableDrivers());