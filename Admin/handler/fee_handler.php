<?php 
session_start();
    include('../../db_connect.php');
    if(isset($_POST['fee_id'])){
        $id=$_POST['fee_id'];
        $date=$_POST['fee_date'];
        $desc=$_POST['fee_description'];
        $status=$_POST['fee_status'];
        $amount=$_POST['fee_amount'];

        $update="UPDATE fee SET
        fee_date='$date',
        fee_desc='$desc',
        fee_status='$status',
        fee_amount=$amount
        WHERE fee_id=$id";

       if( mysqli_query($conn,$update)){

        header("location:../mgt_fee.php?info=The detail has been updated!");

        }
        else{
            header("location:../mgt_fee.php?error=Failed to update!");

        }
    }

    if(isset($_GET['delete'])){

        $fee_id=$_GET['delete'];

        $sql_delete="DELETE FROM fee WHERE fee_id = $fee_id";

        if(  mysqli_query($conn,$sql_delete)){
            header("location:../mgt_fee.php?info=The detail has been deleted!");
        }


    }

    else{


    $fee_description =$_POST['fee_description'];
    $date= date("Y-m-d");

    $current_month=date("m");
    $invoice_no='IN'.rand(10000000,99999999);



    foreach($_POST['group'] as $value){

        $check=$conn->query("SELECT * FROM fee f JOIN child c  ON c.child_id=f.child_id WHERE month(fee_date)=$current_month AND c.group_id=$value AND NOT fee_desc='Fee registration' ");
        
  

        $row= mysqli_num_rows ($check);

        if($row>0){
            header("location:../mgt_fee.php?error=The fee(s) are already set for selected group(s) in this month!");  
        }
        
        else{

       

            $group = $conn->query("SELECT * FROM child c 
            JOIN parent p ON c.parent_id = p.parent_id
            JOIN child_group g ON c.group_id = g.group_id 
            WHERE c.group_id  = $value
            AND child_registerStatus='ACCEPT' ");
            while($row=$group->fetch_assoc()){

                $query = " INSERT INTO  fee (fee_date, fee_desc, fee_amount, child_id, remain_paid,invoice_no, staff_id) VALUES ('$date', '$fee_description', $row[group_price], $row[child_id],$row[group_price],'$invoice_no', ".$_SESSION['id'].") ";
                mysqli_query($conn,$query);
                $last_id = $conn->insert_id;

                $fee_email = $conn->query("SELECT * FROM fee 
                WHERE fee_id  = $last_id");
                foreach($fee_email->fetch_array() as $k => $val){
                    $$k=$val;
                }
                require( "../../phpmailer/index.php");

            
                }
            }
        }
   
    
}
?>