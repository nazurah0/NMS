<?php
    session_start();
    include('db_connect.php');
    
   

    

    

   

   if($_SESSION['signup']=="1"){

        if($_POST['username']!=NULL && $_POST['password']!=NULL ){
            $username =  $_POST['username'];
            $password =  $_POST['password']; 
            $email =  $_POST['email']; 

            $father_ic_signup = $_POST['father_ic_signup'];
            $mother_ic_signup = $_POST['mother_ic_signup'];

            $father_copy_ic = $_FILES['father_copy']['name']!='' ?addslashes(file_get_contents($_FILES['father_copy']['tmp_name'])):NULL;
            $father_name = $_POST['father_name'];
            $father_phone = $_POST['father_phoneNum'];
            $father_work = $_POST['father_work'];
            $father_wAddress = $_POST['father_workAddress'];
            $mother_copy_ic = $_FILES['mother_copy']['name']!='' ? addslashes(file_get_contents($_FILES['mother_copy']['tmp_name'])):NULL;
            $mother_name = $_POST['mother_name'];
            $mother_phone = $_POST['mother_phoneNum'];
            $mother_work = $_POST['mother_work'];
            $mother_wAddress = $_POST['mother_WorkAddress'];
            $parent_address = $_POST['parent_address'];
            $parent_town = $_POST['parent_town'];
            $parent_postcode = $_POST['parent_postcode'];
            $parent_state = $_POST['parent_state'];




            $insert="INSERT INTO parent
            (email,father_name, father_IC, father_phoneNum, copy_icFather, copy_icMonther, mother_name, mother_IC, mother_phoneNum, parent_address, parent_town, parent_postcode, parent_state, father_work, father_workAddress, mother_work, mother_workAddress) 
            VALUES 
            ('$email','$father_name','$father_ic_signup','$father_phone','$father_copy_ic','$mother_copy_ic','$mother_name','$mother_ic_signup','$mother_phone','$parent_address','$parent_town ','$parent_postcode' ,'$parent_state','$father_work','$father_wAddress','$mother_work ','$mother_wAddress')";
            mysqli_query($conn,$insert) ;
  
    

            $last_id = $conn->insert_id;

            
            $hashPassword = password_hash($password , PASSWORD_DEFAULT);
            

            $user="INSERT INTO user (user_id ,username, user_password, user_type) VALUES ( '$last_id', '$username' , '$hashPassword', 'PARENT')";
            
            if(mysqli_query($conn,$user)){
                $signin = "SELECT * FROM user WHERE user_id=$last_id  LIMIT 1";
  
                $result=mysqli_query($conn,$signin);
                $user= mysqli_fetch_assoc($result);
                $_SESSION['signin']='1';
                $_SESSION['id']=$user['user_id'];
                $_SESSION['username']=$user['username'];
                $_SESSION['type']=$user['user_type'];
                

                header ("location:Parent/index.php");
            }

            else {
                echo "failed";
                echo mysqli_error($conn);
            }

        }
    }
   
    
   else{

    $father_IC = $_POST['father_IC'];
    $mother_IC =$_POST['mother_IC'];

    $check = "SELECT * FROM parent WHERE father_IC = '$father_IC' AND father_IC NOT IN ('') OR mother_IC = '$mother_IC' AND mother_IC NOT IN ('')";
    $result=mysqli_query($conn,$check);

    if($father_IC==NULL &&  $mother_IC==NULL){

        header("location:signup.php?alert=Please insert father AND/OR mother identity card Number");

    }

    else if(mysqli_num_rows($result)==TRUE ){
        header("location:signup.php?exist=Your info is exist in the system. Please go to the Sign in page and Sign in into the system to register new student or new session. If you forgot your PASSWORD, you may contact nursery to reset the password.");
    }
    else if(mysqli_num_rows($result)==FALSE ){
        if(!$_POST['mother_IC']== NULL && !$_POST['father_IC']==NULL){
            $_SESSION['signup']="1";
            header("location:signup_form.php?mother_ic=$mother_IC&father_ic=$father_IC");
        }

        else if($_POST['mother_IC']== NULL && !$_POST['father_IC']==NULL){
            $_SESSION['signup']="1";
            header("location:signup_form.php?father_ic=$father_IC");
        }

        else if($_POST['father_IC']==NULL && !$_POST['mother_IC']== NULL){
            $_SESSION['signup']="1";
            header("location:signup_form.php?mother_ic=$mother_IC");
        }
        else if($_POST['mother_IC']== NULL && $_POST['father_IC']==NULL){
            $_SESSION['signup']="1";
            header("location:signup_form.php"); 
        }

       

    }

    
} 


 
?>