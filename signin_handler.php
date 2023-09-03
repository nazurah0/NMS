<?php 
    session_start();
    include('db_connect.php');

$role1 = $_POST['role'];
  $role = $_POST['username']== 'admin'? 'ADMIN':$_POST['role'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $signin = "SELECT * FROM user WHERE username = '$username'  AND user_type = '$role'  LIMIT 1";
  
  $result=mysqli_query($conn,$signin);
  $user= mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)==1){

        if(password_verify($password,$user['user_password'])){

            if( $role1=='STAFF'){
            
                if($user['user_type']=='ADMIN'){
                    $_SESSION['signin']='1';
                    $_SESSION['id']=$user['user_id'];
                    $_SESSION['username']=$user['username'];
                    $_SESSION['type']=$user['user_type'];
                    unset($_COOKIE);
                header("location:Admin/dashboard.php");
                exit();
                }

                else if($user['user_type']=='STAFF'){
                    $_SESSION['signin']='1';
                    $_SESSION['id']=$user['user_id'];
                    $_SESSION['username']=$user['username'];
                    $_SESSION['type']=$user['user_type'];
                    header("location:Admin/dashboard.php");
                    exit();
                }

            }
            
            else if($user['user_type'] == 'PARENT'){

                
                $_SESSION['signin']='1';
                $_SESSION['id']=$user['user_id'];
                $_SESSION['username']=$user['username'];
                $_SESSION['type']=$user['user_type'];
                header("location:Parent/index.php");
                exit();

            }

            else{
    
                header("location: ". $_SERVER['HTTP_REFERER']."&alert=The username or password is incorrect.");
        
            }
    }

        else{

            header("location: ". $_SERVER['HTTP_REFERER']."&alert=The password is incorrect.");
 
        }
    

    }
    else{
   
        header("location: ". $_SERVER['HTTP_REFERER']."&alert=The username or password is incorrect.");

    }

?>