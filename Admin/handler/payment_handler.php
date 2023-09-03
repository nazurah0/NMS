<?php 
    include('../../db_connect.php');
    
    if(isset($_GET['status'])){
        $id=$_GET['id'];
        if($_GET['status']=='REJECT'){
            $fee=$_GET['fee'];
           
            $update="UPDATE payment set payment_status='REJECT' WHERE payment_id=$id";
            $update_fee="UPDATE fee set fee_status='UNPAID' WHERE fee_id=$fee";

            if(mysqli_query($conn,$update) && mysqli_query($conn,$update_fee) ){

                header("location:../mgt_payment.php?info=The payment status has been updated successfully");
    
            }
            else{
                header("location:../mgt_payment.php?error=Failed to Insert");
    
            }
        }

        else if($_GET['status']=='ACCEPT'){
            $fee=$_GET['fee'];
            $remain=$_GET['remain'];
            $update="UPDATE payment set payment_status='ACCEPT' WHERE payment_id=$id";
            
            if($remain==0)  
            $update_fee="UPDATE fee set fee_status='PAID', remain_paid=0 WHERE fee_id=$fee";

            else
            $update_fee="UPDATE fee set fee_status='UNPAID', remain_paid=$remain WHERE fee_id=$fee";

            if(mysqli_query($conn,$update) && mysqli_query($conn,$update_fee) ){

                header("location:../mgt_payment.php?info=The payment status has been updated successfully");
    
            }
            else{
                header("location:../mgt_payment.php?error=Failed to Insert");
    
            }
        }

        
    }

    else if(isset($_GET['delete'])){

        $pay_id=$_GET['delete'];

        $sql_delete="DELETE FROM payment WHERE payment_id = $pay_id";

        if(  mysqli_query($conn,$sql_delete)){
            header("location:../mgt_payment.php?info=The detail has been deleted!");
        }


    }
    else if($_POST['payment_id']==NULL){
        $fee_id=$_POST['fee_id'];
        $amount=$_POST['payment_amount'];
        $date=$_POST['payment_date'];
        $proof=$_POST['payment_proof'];
        $type=$_POST['payment_method'];

        $insert="INSERT INTO payment (payment_amount, payment_type, payment_date , payment_proof,fee_id) VALUES ($amount,'$type','$date','$proof',$fee_id)";
        $update_fee="UPDATE fee set fee_status='WAITING' WHERE fee_id=$fee_id";
        if(mysqli_query($conn,$insert) && mysqli_query($conn,$update_fee) ){

            header("location:../mgt_payment.php?success=The payment details has been added successfully");

        }
        else{
            header("location:../mgt_payment.php?error=Failed to Insert");

        }
    }

  
    else{
        echo "failed";
    }
?>