<?php
namespace camaleon\examples;

class BaseExamples {
    public function __construct(){
        echo "namespaces in Camaleon works here!" . SINGLE_URL. getenv('DB_HOST_DEV') . '<br> FUNCTIONS: '. sumar(800, 17);
    }
}