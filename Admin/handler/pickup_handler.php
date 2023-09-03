<?php
   include('../../db_connect.php');
    if($_POST['pickup_id']==NULL){

        $attendance_id = $_POST['attendance_id'];
        $pickupTime=$_POST['attendance_pickupTime'];
        $name=$_POST['pickup_name'];
        $phone=$_POST['pickup_phoneNum'];
        $relationship=$_POST['pickup_relationship'];
    
      
            $query = " INSERT INTO  pickup (pickup_name, pickup_phoneNum, pickup_relationship, attendance_id) VALUES ('$name','$phone','$relationship', $attendance_id) ";
            $query2 = " UPDATE  attendance SET attendance_pickupTime ='$pickupTime' WHERE attendance_id= $attendance_id  ";
            if(mysqli_query($conn,$query) && mysqli_query($conn,$query2)){
            header("location:../child_attendance.php?success=The pickup detail has been inserted");}

            else{
                header("location:error=Failed to Insert ");}
            
        
    }

    else if(isset($_POST['pickup_id'])){

        $attendance_id = $_POST['attendance_id'];
        $pickup_id=$_POST['pickup_id'];
        $pickupTime=$_POST['attendance_pickupTime'];
        $name=$_POST['pickup_name'];
        $phone=$_POST['pickup_phoneNum'];
        $relationship=$_POST['pickup_relationship'];
    
      
            $query = " UPDATE  pickup SET pickup_name='$name', 
            pickup_phoneNum='$phone', 
            pickup_relationship='$relationship'
            WHERE pickup_id=$pickup_id" ;
            $query2 = " UPDATE  attendance SET attendance_pickupTime ='$pickupTime' WHERE attendance_id= $attendance_id  ";
            if(mysqli_query($conn,$query) && mysqli_query($conn,$query2)){
            header("location:../child_attendance.php?info=The detail has been updated");}

            else{
                header("location:../child_attendance.php?error=Failed to Update");}
            
        
    }

?>