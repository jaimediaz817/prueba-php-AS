<?php
//namespace camaleon\viewControllers;

use camaleon\mvc\ControllerBase;

//   M O D E L S
use camaleon\models\UserModel;

//   S E S S I O N
use camaleon\helpers\SessionApp;

use camaleon\helpers\StringSecurityManager;

//   E M A I L
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class LoginController extends ControllerBase {

    public function login($params=null) {

        // show users
        $user = new UserModel();
        $responseUsers = $user->selectAllUsers();        

        $this->view->renderView($this, "login", "Login | users");
    }

    public function signInLogin() {

        $nickname = '';
        $password = '';
        $statusAccount = null;
        $successLogin = false;
        $userId = '';

        if ($_POST) {
            $nickname = $_POST['login'];
            $password = StringSecurityManager::encrypt($_POST['password']);

            $user = new UserModel();
            $loginData = $user->selectUserLogin($nickname, $password);

            if(!empty($loginData)) {
                $statusAccount =  $loginData[0]["usua_status_account"];

                // S E S S I O N
                SessionApp::initStartFullSessionVar("idUser", $loginData[0]["usua_id_pk"]);
                SessionApp::initStartFullSessionVar("nickUser", $loginData[0]["usua_nickname"]);

                $userId = $loginData[0]["usua_id_pk"];
            } else {
                $userId = 0;
            }

            if ($loginData[0]["usua_status_account"] == 0) {
                $statusAccount = "fail";
            } else if ($loginData[0]["usua_status_account"] == 1) {
                $statusAccount = "success";
            }
        }
        echo(json_encode(array("res"=> $statusAccount, "nick"=>$loginData, "userId"=> $userId )));
    }

    /**
     * Access mail validation
     */
    public function accessMail($params=null) {

        $res    = 0;
        $email  = $_POST['email'];
        $login  = $_POST['login'];
        $userId = $_POST['userId'];

        $mail = new PHPMailer(true);

        try {
            //Server settings (acceso)
            $mail->SMTPDebug = 3;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'jdsolutions817@gmail.com';             // SMTP username
            $mail->Password   = 'Jidg18402120';                         // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            $mail->setFrom('jdsolutions817@gmail.com', 'Jaime Diaz'); // from
            $mail->addAddress($email, $login);     // A quien se enviará

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Asunto del correo';
            $mail->Body    = "
                                <p>To access your account click on this link, you will be redirected to the platform.</p>
                                <a href='". SINGLE_URL ."Login/activateAccount/". $userId ."'>
                                Click here to activate your account</a> 
            ";

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            $mail->send();
            $res = 1;

            //echo json_encode(array("res"=> "success", "send"=>$res));
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $res = 0;
        } finally {
            echo json_encode(array("res"=> "success", "send"=>$res));
        }

        if ($res == 1) {
            $resultMail = array(
                "res" => "success",
                "send" => true
            );
        } else {
            $resultMail = array(
                "res" => "fail",
                "send" => false
            );
        }
        echo json_encode($resultMail);
    }

    public function activateAccount($params=null) {
        //$idUser = SessionApp::getValueSession("idUser");
        $ex = explode(",", $params);
        $arr = array();
        $cont=0;
        $nameGeneralProd = "";
        foreach($ex as $index => $va) {
            $cont++;
            array_push($arr, $va);
        }
        $idUser = $arr[0];

        $user = new UserModel();
        $responseUsers = $user->activateAccountEmail($idUser);

        header("Location: ". SINGLE_URL . "Dashboard/index");
    }

    /**
     * Sign Out
     */
    public function signOut($params=null) {
        // clear SESSION superglobal

        // S E S S I O N
        SessionApp::unsetVarSession("idUser");
        SessionApp::unsetVarSession("nickUser");
        SessionApp::destroyAllSession();
        // Redirect
        header("Location: ". SINGLE_URL . "Login/login");
    }
}