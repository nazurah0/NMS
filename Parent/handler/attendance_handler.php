<?php 
    include('../../db_connect.php');

    if(isset($_GET['clockin'])){

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $time=date('G:i:s');
        $id=$_GET['clockin'];
        $update="UPDATE attendance SET attendance_arrivalTime='$time', attendance_status='PRESENT' WHERE attendance_id=$id";
        if(mysqli_query($conn,$update)){
            header ("location:../attendance_view.php?attendance_id=$id&info=The attendance arrival time has been updated!");
        }
    }

    else if(isset($_GET['clockout'])){

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $time=date('G:i:s');
        $id=$_GET['clockout'];
        $update="UPDATE attendance SET attendance_pickupTime='$time' WHERE attendance_id=$id";
        if(mysqli_query($conn,$update)){
            header ("location:../attendance_view.php?attendance_id=$id&info=The attendance arrival time has been updated!");
        }
    }
?>