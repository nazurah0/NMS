<?php 
session_start();
 include('../../db_connect.php');
 $id=$_POST['id'];
 $email=$_POST['email'];
 $username=$_POST['username'];

 
    if($_POST['password']==NULL){
    $update="UPDATE user SET username='$username' WHERE user_id=$id";

    }

    else{
       $password = $_POST['password'];
       $hashPassword = password_hash($password , PASSWORD_DEFAULT);
        $update="UPDATE user SET username='$username', user_password='$hashPassword' WHERE user_id=$id";
    }

    $update1="UPDATE parent SET email='$email' WHERE parent_id=$id";

    if(mysqli_query($conn,$update) && mysqli_query($conn,$update1)){
        $_SESSION['username']=$username;
        header("location: ". $_SERVER['HTTP_REFERER']."?info=User details has been updated!.");
    }



?>