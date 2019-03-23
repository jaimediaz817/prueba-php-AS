<?php 

namespace camaleon\mvc;

class ViewBase {
    public function renderView($controller,$view, $title, $methodValController = false) {

        if (!$methodValController) {
            $controlador = get_class($controller);
            $controlador = substr($controlador, 0, -10);
        } else {
            $controlador = $controller;
        }

        $path = "./views/" . $controlador . "/" . $view;

        if (file_exists($path. ".php")) {
            if ($title != '') {
                $this->title = $title;
            }

            // Session validate
            session_start();
            if (!isset($_SESSION['nickUser'])) {
                include "./views/Login/login.php";
            } else {
                include $path . ".php";
            }
            
        } else if (file_exists($path . ".html")) {
            if ($title !== '') {
                $this->title = $title;
                include ".views/modules/header.php";
            }            
            include $path . ".html";
        } else {
            // 404 Page Not found
            echo "Error al intentar cargar la página";
        }
    }
}