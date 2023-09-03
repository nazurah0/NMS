<?php 

    include('../../db_connect.php');
  


    if(isset($_POST['delete'])){
        $delete ="DELETE FROM parent WHERE parent_id =". $_POST['delete'] ;
        $user ="DELETE FROM user WHERE user_id =". $_POST['delete'] ;
        if(mysqli_query($conn,$delete) && mysqli_query($conn,$user)){
        header("location:../parents.php?info=The data has been deleted successfully");}

        else{
            header("location:../parents.php?error=Failed to delete");
        }
    }

    else if(isset($_POST['update_parent'])){
        $email=$_POST['email'];
        $parent_id=$_POST['parent_id'];
        $father_name = $_POST['father_name'];
        $father_ic = $_POST['father_ic'];
        $father_phone = $_POST['father_phone'];
        $father_work = $_POST['father_work'];
        $father_wAddress = $_POST['father_wAddress'];
        $mother_name = $_POST['mother_name'];
        $mother_ic = $_POST['mother_ic'];
        $mother_phone = $_POST['mother_phone'];
        $mother_work = $_POST['mother_work'];
        $mother_wAddress = $_POST['mother_wAddress'];
        $parent_address = $_POST['parent_address'];
        $parent_town = $_POST['parent_town'];
        $parent_postcode = $_POST['parent_postcode'];
        $parent_state = $_POST['parent_state'];

        if(isset($_POST['father_ic'])){
        $copy_father = $_FILES['father_copy_ic']['error'] == 0 ? addslashes(file_get_contents($_FILES['father_copy_ic']['tmp_name'])):'';
        $sql_father= $_FILES['father_copy_ic']['error'] == 0 ? " ,copy_icFather ='$copy_father'" :'';}

        if(isset($_POST['mother_ic'])){
        $copy_mother = $_FILES['mother_copy_ic']['error'] == 0 ? addslashes(file_get_contents($_FILES['mother_copy_ic']['tmp_name'])):'';
        $sql_mother= $_FILES['mother_copy_ic']['error'] == 0 ? " ,copy_icMonther ='$copy_mother'" :'';}
echo $parent_id;
        $parent_update="UPDATE parent SET 
        email='$email',
        father_name='$father_name',
        father_IC='$father_ic',
        father_phoneNum='$father_phone',
        mother_name='$mother_name',
        mother_IC='$mother_ic',
        mother_phoneNum='$mother_phone',
        parent_address='$parent_address',
        parent_town='$parent_town',
        parent_postcode='$parent_postcode',
        parent_state='$parent_state',
        father_work='$father_work',
        father_workAddress='$father_wAddress',
        mother_work='$mother_work',
        mother_workAddress='$mother_wAddress'";
if(isset($_POST['father_ic'])){
         $parent_update .= $sql_father;}

         if(isset($_POST['mother_ic'])){
         $parent_update .= $sql_mother;}

        $parent_update .=" WHERE parent_id=$parent_id";

        if(  mysqli_query($conn,$parent_update)){
            
           header("location:../parents.php?info=The details has been successfully updated!");
        } 
        }

        else if(isset($_GET['reset'])){
            $id=$_GET['reset'];
            $parent = $conn->query("SELECT * FROM parent
            WHERE parent_id  = $id");
            foreach($parent->fetch_array() as $k => $val){
                $$k=$val;
            }

            $username=$father_IC !=''? $father_IC : $mother_IC;
            $password=$father_IC !=''? $father_IC : $mother_IC;
            $hashPassword = password_hash($password , PASSWORD_DEFAULT);
            $update="UPDATE user SET username='$username' , user_password='$hashPassword' WHERE user_id=$id";

            if(  mysqli_query($conn,$update)){
            
                header("location:../parents.php?info=The parent's username and password has been reset!");
             }
        }
        



    



?>