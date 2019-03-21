<?php

namespace camaleon\mvc;
use camaleon\mvc\ViewBase;

class ControllerBase {
    public function __construct() {
        $this->view = new ViewBase();
    }    
}