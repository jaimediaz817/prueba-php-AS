<?php

namespace camaleon\apis;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
// models
use camaleon\models\UserModel;


class ApiController {
    public function __construct() {}

    public function initApiController () {
        $config = ['settings' => [
            'addContentLengthHeader' => false,
            'displayErrorDetails' => true,
        ]];
        $app = new \Slim\App($config);



        // Define app routes
        $app->get('/api/request/{name}', function ($request, $response, $args) {
            $respuesta = array(
                "res" => $args['name']
            );

            $user = new UserModel();
            $res = $user->getAll();
    
            $user->id= "2";
            $user->name = "jojojo";
            $user->lastName = "apellidoLOLOLs";
            $user->date = "2019-03-11";
            $user->username = "jdiaz";
            $user->password = "12356";
            $user->createdAt ="2019-03-11";
    
            //$user->create();
            $user->update(3);
    
            $busqueda = $user->getById(2, "usua_id_pk");
            \FB::log($busqueda);

             $innerJoin = $user->innerJoin();
             \FB::log($innerJoin);

            return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($innerJoin));
        });
        
        // Run app
        $app->run();

    }
}

?>