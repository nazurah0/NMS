<?php
include('../../db_connect.php');

if(isset($_POST['username'])){
   $username = $_POST['username'];

   $query = "SELECT  count(*) as cntUser FROM user where username='".$username."'";

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>Username Available</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_assoc($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span style='color: red;'>Username Not Available</span>";
      }
   
   }

   echo $response;
   die;
}