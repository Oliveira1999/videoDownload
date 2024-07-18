<?php
require_once("conexao.php");
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['email'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $corpo = "Nome: " . $nome . "<br>Email: " . $email . "<br>Mensagem: " . $message;

    $mail = new PHPMailer(true);
    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Depuração
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'silvarecordz99@gmail.com';
        $mail->Password = 'kxwqkmbvmpxthdxq';
        $mail->Port = 587;

        $mail->setFrom('silvarecordz99@gmail.com', 'Recuperacao de senha');
        $mail->addAddress($email); // para onde é enviado administrador do sistema

        $mail->isHTML(true);
        $mail->Subject = 'Mensagem de contato';
        $mail->Body = $corpo;
        $mail->AltBody = "Nome: " . $nome . "\nEmail: " . $email . "\nMensagem: " . $message;

        $mail->send();
        echo 'Mensagem enviada com sucesso';
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}
?>
