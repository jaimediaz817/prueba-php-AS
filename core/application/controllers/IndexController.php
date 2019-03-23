<?php
//namespace camaleon\viewControllers;

use camaleon\mvc\ControllerBase;

//   M O D E L S
use camaleon\models\UserModel;

//   S E S S I O N
use camaleon\helpers\SessionApp;

//   E M A I L
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



class IndexController extends ControllerBase{

    public function index($params=null) {

        $test = 818;

        // show users
        $user = new UserModel();
        $responseUsers = $user->selectAllUsers();

        header("Location: ". SINGLE_URL . "Dashboard/index");
        // $this->view->test = $test;
        // $this->view->renderView($this, "index", "main");
    }
}