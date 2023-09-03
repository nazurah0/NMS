<link href="../css/sb-admin-2.min.css" rel="stylesheet">

<?php
include('../db_connect.php');
$id=$_GET['child_id'];
$sql=$conn->query("SELECT c.child_id,  p.email, c.child_name,  f.fee_status , COUNT(c.child_id) AS count_unpaid , SUM(f.remain_paid)  AS sum_unpaid, GROUP_CONCAT(f.invoice_no) AS fee FROM child c
JOIN fee f ON c.child_id=f.child_id
JOIN parent p ON c.parent_id=p.parent_id
GROUP BY c.child_id, f.fee_status
HAVING f.fee_status = 'UNPAID' AND c.child_id=$id");

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
    $mail->Subject = "Outstanding Fee Reminder";
    $mail->Body    = 
    "<div class='card w-100' >
        <div class='card-header bg-info'>
            <h2>Outstanding Fee<h2>
            
        </div>

        <div class='card-body'>

        <h3>Dear Parents of ".$child_name.",</h3>

        <p>This is gentle reminder that your children's nursery fee have not been paid for the past few month(s)</p>
        <p>Below is Information about outstanding fee:</p>

        <table>
            <tbody>
                <tr>
                    <td>
                        <h4><b>Invoice No.</b></h4>
                    </td>
                    <td>:</td>
                    <td>
                        <h4>$fee</h4>
                    </td>
                </tr>
                <tr>
                <td>
                    <h4><b>Total Amount of Outstanding Fee</b></h4>
                </td>
                <td>:</td>
                <td>
                    <h4>RM $total</h4>
                </td>
            </tr>
            
            </tbody>
        </table>

        <p>Please settle down all the outstanding fee as soon as possible.</p>

        <p>Sincerely</p>
        
        
        
        
        </div>

        
    

    </div>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header("location:../Admin/report.php?info=The email is successfully sended!");


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}