<?php 
    include('../../db_connect.php');


    $fee_id=$_POST['fee_id'];
    $amount=$_POST['payment_amount'];
    $date=$_POST['payment_date'];
 

    $type=$_POST['payment_method'];
 
    $insert="INSERT INTO payment (payment_amount, payment_type, payment_date ,  fee_id) VALUES ($amount,'$type','$date',$fee_id)";
    $update_fee="UPDATE fee set fee_status='WAITING' WHERE fee_id=$fee_id";
    if(mysqli_query($conn,$insert) && mysqli_query($conn,$update_fee) ){
 
         header("location:../fee.php?success=The payment details has been added successfully");
 
 
    }
    else{
     echo $fee_id.$amount.$type;
 
    }
?>