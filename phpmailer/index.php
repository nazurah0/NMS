<link href="../css/sb-admin-2.min.css" rel="stylesheet">

<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mail.yahoo.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nur_nazurahhassan@yahoo.com';                     //SMTP username
    $mail->Password   = 'zmgdtcrwmdsrdfha';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('nur_nazurahhassan@yahoo.com', "Taska Ummi Sakiza");
    $mail->addAddress("$row[email]", "Parents of ".$row['child_name']);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('nurnazurahhassan3@gmail.com','BOOK 2U');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Nursery's Monthly Fee ";
    $mail->Body    = 
    "<div class='card w-100' >
        <div class='card-header bg-info'>
            <h2> FEE INVOICE<h2>
            
        </div>

        <div class='card-body'>

        <h3>Dear Parents of ".$row['child_name'].",</h3>

        <p>We would like to remind you that we have issue new fee for this month</p>
        <p><b>Fee details:</b></p>
        <table>
        <tbody>
            <tr>
                <td>
                    <h4><b>Invoice No.</b></h4>
                </td>
                <td>:</td>
                <td>
                    <h4>".$invoice_no."</h4>
                </td>
            </tr>
            <tr>
            <td>
                <h4><b>Fee amount</b></h4>
            </td>
            <td>:</td>
            <td>
                <h4>RM ".$fee_amount."</h4>
            </td>
        </tr>
        
        </tbody>
    </table>
    <p>Sincerely</p>
        
        </div>

        
    

    </div>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header("location:../mgt_fee.php?success=The fee(s) are successfully set!");


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}