<?php


  include('../../db_connect.php');

  if(isset($_GET['id'])){

    $group_id=$_GET['id'];
    $delete="DELETE FROM child_group WHERE group_id='$group_id'";

    if(mysqli_query($conn, $delete)){
        header("location:../mgt_group.php?info=The group has been deleted successfully");
    }

    else{
        header("location:../mgt_group.php?error=Failed to delete");
    }
  }

  else{

   $name=$_POST['group_name'];
   $price=$_POST['group_price'];
   $desc=$_POST['group_description'];
  
   if($_POST['group_id']=="") {
    echo $name;
 
     $insert="INSERT INTO child_group (group_name, group_price, group_description) VALUES ('$name', $price,'$desc')";
 
   
   
     if(mysqli_query($conn, $insert)){
        header("location:../mgt_group.php?success=The group has been added successfully");
   }
  
  
  }
   

  else if(isset($_POST['group_id'])){

     $id=$_POST['group_id'];


      $update1="UPDATE child_group SET
      group_name = '$name',
      group_price = '$price',
      group_description = '$desc'
      WHERE group_id = $id
      ";



      if(mysqli_query($conn, $update1)){
         header("location:../mgt_group.php?info=The detail has been updated successfully!");
    }
}

}







 

?>

