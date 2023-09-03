<?php
 session_start();
include('../../db_connect.php');

if(isset($_POST['contact_name'])){
   $parent_id=$_SESSION['id'];
   $contact_name = $_POST['contact_name'];

   $query = "SELECT  * FROM parent where parent_id=$parent_id";
   $result = mysqli_query($conn,$query);
   foreach($result->fetch_array() as $k => $val){
      $$k=$val;
    };
    
    $response = "";


   if($contact_name == $father_name || $contact_name == $mother_name ){
      
          $response = "<span style='color: red; font-size:14px'>Contact details cannot be same with parent details </span>";
     
   
   }

   echo $response;
   die;
}

if(isset($_POST['contact_pnum'])){
   $parent_id=$_SESSION['id'];
   $contact_pnum = $_POST['contact_pnum'];

   $query = "SELECT  * FROM parent where parent_id=$parent_id";
   $result = mysqli_query($conn,$query);
   foreach($result->fetch_array() as $k => $val){
      $$k=$val;
    };
    
    $response1 = "";

   if($contact_pnum == $father_phoneNum || $contact_pnum == $mother_phoneNum ){
      
          $response1 = "<span style='color: red; font-size:14px''>Contact phone number cannot be same with parent phone number </span>";
     
   
   }

   echo $response1;
   die;
}