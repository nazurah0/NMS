<link href="../css/sb-admin-2.min.css" rel="stylesheet">

<?php
include('../db_connect.php');
$id=$_GET['child_id'];
$sql=$conn->query("SELECT * FROM child c JOIN parent p ON c.parent_id=p.parent_id WHERE
child_id=$id");

foreach($sql->fetch_array() as $k => $val){
    $$k=$val;
  };

  $total=number_format($sum_unpaid,2) ;

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
    $mail->addAddress($email, "Parents of ".$child_name);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('nurnazurahhassan3@gmail.com','BOOK 2U');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Acceptance on Children Registration";
    $mail->Body    = 
    "<div class='card w-100' >
        

        <div class='card-body'>

        <h3>Dear Parents of ".$child_name.",</h3>


        <p><b>Congratulation</b>, we have already accept your child registration </p>
        <p>Now, you may send your children to our nursery</p>
       
    

      
        <p>Please Visit our <a href='https://fyp-nurserymanagementsystem.com/'>Nursery Management System</a> to keep track your child's attendances & fees</p>
        <p>Thank you for using our service in taking care and educate your child.</p>

        <p>Sincerely</p>
        <p><b>Taska Ummi Sakiza</b></p>
        
        
        
        
        </div>

        
    

    </div>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header("location:../Admin/new_register.php?info=The Registration has been accepted!");


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}