<?php 
session_start();
include('../db_connect.php');
if(isset($_POST['username'])){

    $_SESSION['payment']='1';
    $_SESSION['fee_id']=$_POST['fee_id'];
    header("location:payment-detail.php?bank=".$_POST['bank']);

    
}

else if(isset($_GET['payment'])){

   $fee_id=$_SESSION['fee_id'];
   $sql2=$conn->query("SELECT * FROM fee where fee_id=".$fee_id);
   foreach($sql2->fetch_array() as $l => $value){
    $$l=$value;
    }
   $payment_type='ONLINE BANKING';
   $payment_date=date('y-m-d');
   $payment_status='ACCEPT';
   $transaction_id=rand(10000000,99999999);
   $insert=$conn->query("INSERT INTO payment( payment_amount, payment_type, payment_date,  payment_status, fee_id, transaction_id) VALUES 
   ($remain_paid ,'$payment_type','$payment_date','$payment_status',$fee_id,$transaction_id)");
    $last_id = $conn->insert_id;
   $update_fee=$conn->query("UPDATE fee set fee_status='PAID', remain_paid=0 WHERE fee_id=$fee_id");
   if(insert)
    header("location:payment-success.php?bank=".$_GET['bank']."&id=$last_id");

    
}
else if(isset($_GET['complete'])){

    $_SESSION['payment']='0';
    $_SESSION['fee_id']=0;
    header("location:../Parent/fee.php?success=Payment Successful");


}

?>