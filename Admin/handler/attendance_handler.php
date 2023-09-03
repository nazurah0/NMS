<?php 
session_start();
    include('../../db_connect.php');
    if(isset($_POST['attendance_id'])){

            $id=$_POST['attendance_id'];
            $arrivalTime=$_POST['attendance_arrivalTime'];
            $pickupTime=$_POST['attendance_pickupTime'];
    
            $update="UPDATE attendance SET 
            attendance_arrivalTime='$arrivalTime',
            attendance_pickupTime = '$pickupTime',
            attendance_status ='PRESENT'
            WHERE attendance_id= $id";
    
            if(mysqli_query($conn,$update)) {
                header("location:../child_attendance.php?success=The Attendance time Has Been Updated");
            }

            else{
                header("location:../child_attendance.php?error=Failed to Update");}

            
        }

        else if(isset($_GET['delete'])){

            $id=$_GET['delete'];
            $delete="DELETE FROM attendance WHERE attendance_id=$id";

            if(mysqli_query($conn, $delete)){
                header("location:../child_attendance.php?info=The attendance has been deleted");
            }
        }

    else{

   
   
    $attendance_date =$_POST['attendance_date'];
    $attendance_date1 =date_create($_POST['attendance_date']);
    $formal_date=date_format($attendance_date1,"d F Y");

    

    foreach($_POST['group'] as $value){

        $check=$conn->query("SELECT * FROM attendance a JOIN child c  ON c.child_id=a.child_id WHERE attendance_date='$attendance_date' AND c.group_id=$value ");

        $row= mysqli_num_rows ($check);

        if($row>0){
            header("location:../child_attendance.php?error=The attendance(s) are already set for selected group(s) on ".$formal_date."!");  
        }

        else {


            $group = $conn->query("SELECT * FROM child WHERE group_id  = $value AND child_registerStatus='ACCEPT'");
            while($row=$group->fetch_assoc()){

                $query = " INSERT INTO  attendance (attendance_date, child_id, staff_id) VALUES ('$attendance_date',$row[child_id],".$_SESSION['id'].") ";
                mysqli_query($conn,$query);
                header("location:../child_attendance.php?success=The Attendance Has Been Set");
            
            }
        }
    }   
}
?>