<?php
//namespace camaleon\viewControllers;

use camaleon\mvc\ControllerBase;

//   M O D E L S
use camaleon\models\UserModel;
use camaleon\models\PerfilModel;

//   S E S S I O N
use camaleon\helpers\SessionApp;

//   E M A I L
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



class IndexController extends ControllerBase{

    public function index($params=null) {
        // Refactorizar
        \FB::log("params: ".$params);
        $ex = explode(",", $params);
        $arr = array();
        $cont=0;
        foreach($ex as $index => $va) {
            $cont++;
            //echo "<br>recorrido<br>". $index . $va;
            array_push($arr, $va);
        }
        $cantidad =  count($arr);
        //\FB::log($arr);
        //echo "-----------------";








        // MYSQLI ********************
        //$conn = new mysqli("localhost", "root", "1234", "trilogic_me_catalogo_2018");
        //$conn->query("SET NAMES 'utf8'");
        //$res = $conn->query("SELECT * FROM usuario");
        // $data = $res;
        //\FB::log("resultado:::::::::::::111 ");
        //\FB::log($res);


        $perfil = new PerfilModel();
        $res2 = $perfil->query("SELECT * FROM perfil");
        $data = $res2;
        //echo "<br> mysqli <br>" . phpinfo();
        //\FB::log("resultado:::::::::::::");
        //\FB::log($res2);


        //$conn->close();
        // PDO ***********************
        $user = new UserModel();
        $res2 = $user->innerJoin();
        $res = $user->getAll();

        // $user->id= "2";
        // $user->name = "jojojo";
        // $user->lastName = "apellidoLOLOLs";
        // $user->date = "2019-03-11";
        // $user->username = "jdiaz";
        // $user->password = "12356";
        // $user->createdAt ="2019-03-11";

        //$user->create();
        // $user->update(3);

        $busqueda = $user->getById(1, "usua_id_pk");
        \FB::log("ar join:");
        \FB::log($res2);
        



        //  S E S S I O N
        SessionApp::setValueSession("login" , "817");
        SessionApp::setValueSession("login2" , "817");
        SessionApp::setValueSession("login3" , "817");


        SessionApp::unsetVarSession("login");
        SessionApp::destroyAllSession();

        //*************************************************************** */
        // Render view
        $this->view->test = 817;
        $this->view->arrJoin = $res2;
        $this->view->res = $data;
        $this->view->renderView($this, "index", "main");
    }

    public function ejemplos($params = null) {

        // Refactorizar
        \FB::log("params: ".$params);
        $ex = explode(",", $params);
        $arr = array();
        $cont=0;
        foreach($ex as $index => $va) {
            $cont++;
            //echo "<br>recorrido<br>". $index . $va;
            array_push($arr, $va);
        }
        $cantidad =  count($arr);
        \FB::log($arr);
        //echo "-----------------";


        $this->view->renderView($this, "examples", "main");
    }

    public function test($params=null) {
        echo json_encode(array("res" => 817, "success"=> "Respuesta ajax"));
    }


    // EMAILS 

    public function email($params=null) {

        // Instantiation and passing `true` enables exceptions
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

            //Recipients (datos de envío)
            $mail->setFrom('jdsolutions817@gmail.com', 'Jaime Díaz'); // desde donde
            $mail->addAddress('jaimeivan0017@gmail.com', 'Jaime Díaz main');     // A quien se enviará
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Asunto del correo';
            $mail->Body    = '<div> Prueba desde PHP mail, Camaleon Microframework PHP</div>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }        

        $this->view->renderView($this, "email", "main");
    }
}