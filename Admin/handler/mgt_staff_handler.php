<?php 

  include('../../db_connect.php');

  if(isset($_GET['id'])){

   $staff_id=$_GET['id'];
   $delete="DELETE FROM staff WHERE staff_id='$staff_id'";
   $delete1="DELETE FROM user WHERE user_id='$staff_id'";

   if(mysqli_query($conn, $delete)&& mysqli_query($conn, $delete1) ){
       header("location:../mgt_staff.php?success=The Group Has Been Deleted Successfully");
   }

   else{
       header("location:../mgt_staff.php?error=Failed to delete");
   }
 }
else{
   $name=$_POST['staff_name'];
   $role=$_POST['staff_role'];
   $username=$_POST['staff_username'];
   $hashPassword = password_hash( $username , PASSWORD_DEFAULT);
   if($_POST['staff_ID']=="") {
   

      $insert="INSERT INTO staff (staff_name) VALUES ('$name')";
      mysqli_query($conn, $insert);
      $last_id = $conn->insert_id;
      
   
      $insert1="INSERT INTO user (user_id,username,user_password, user_type) VALUES ($last_id, '$username', '$hashPassword','$role') ";
    
    
      if(mysqli_query($conn, $insert1)){
         header("location:../mgt_staff.php?success=Your Data Has Been Added Successfully");
    }
   
   
   }

  else if(isset($_POST['staff_ID'])){
    
     $id=$_POST['staff_ID'];

      $update="UPDATE staff SET
      staff_name = '$name'
      WHERE staff_id = $id
       ";




        $update1="UPDATE user SET
        username = '$username',
        user_type = '$role'
        WHERE user_id = $id
        ";
    


      if(mysqli_query($conn, $update) && mysqli_query($conn, $update1)){
         header("location:../mgt_staff.php?alert=Successfully Updated!");
    }
}

}



 

?>