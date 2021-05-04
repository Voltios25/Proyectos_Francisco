
<?php
include_once '../modelo/usuario.php';
use  PHPMailer\PHPMailer\PHPMailer ;
use  PHPMailer\PHPMailer\SMTP ;
use  PHPMailer\PHPMailer\Exception ;

// El cargador automático de Load Composer
require  '../vendor/autoload.php' ;
$usuario = new Usuario();
if($_POST['funcion']=='verificar'){
    $correo = $_POST['correo'];
    $usuario->verificar($correo);
}
if($_POST['funcion']=='recuperar'){
    $correo = $_POST['correo'];
    $codigo = generar(10);
    $usuario->reemplazar($codigo,$correo);
    $mail = new PHPMailer(True);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp-mail.outlook.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'franciscomartinaquino@outlook.es';
        $mail->Password   = '0101martin';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('franciscomartinaquino@outlook.es', 'Sistema Administrativo');
        $mail->addAddress($correo);     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Restablecer Contraseña';
        $mail->Body    = 'La nueva contraseña es: <b>'.$codigo.'</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPDebug = false;
        $mail->do_debug = false;
        $mail->send();
        echo 'enviado';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


}
//Metodo que permite obtener un codigo aleatorio
function generar($longitud){
    //Concatenacion de codigos aleatorios
    $key = '';
    //Los digitos que quiero que se intervengan en la nueva clave
    $patron='1234567890abcdefghijklmnopqrstuvxyz';
    //Cuanto quiero que mida este key
    $max = strlen($patron)-1;
    //Para hacer el recorrido
    for($i=0;$i<$longitud;$i++){
        //Concatenacion
        $key.=$patron{mt_rand(0,$max)};

    }
    return $key;
}


?>
