<?php

namespace camaleon\errorControllers;
use camaleon\mvc\ControllerBase;

class ErrorController extends ControllerBase {

    /** 
     * Show error
     */
    public function showError() {
        $this->view->renderView("Error","index", "Error | Página no localizada", true);
    }
    
}