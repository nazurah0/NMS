<?php 

    include('../../db_connect.php');

    if(isset($_POST['address'])){
        $id=$_POST['parent_id'];
        $address=$_POST['parent_address'];
        $town=$_POST['parent_town'];
        $postcode=$_POST['parent_postcode'];
        $state=$_POST['parent_state'];

        $update="UPDATE parent SET
        parent_address='$address',
        parent_town='$town',
        parent_postcode='$postcode',
        parent_state='$state'
        WHERE parent_id=$id";

        if(mysqli_query($conn,$update)){
            header("location:../parent.php?info=The details has been updated successfully!");

        }

        else{
            header("location:../parent.php?error=Failed to update");

        }



    }

    else if(isset($_POST['father'])){
        $id=$_POST['parent_id'];
        $name = $_POST['father_name'];
        $ic = $_POST['father_ic'];
        $phoneNum = $_POST['father_phone'];
        $work = $_POST['father_work'];
        $workAddress = $_POST['father_wAddress'];
        $father_copy_ic = $_FILES['father_copy_ic']['name']!='' ? addslashes(file_get_contents($_FILES['father_copy_ic']['tmp_name'])):NULL;
        $ic= $_FILES['father_copy_ic']['name'] != "" ? ",copy_icFather = '$father_copy_ic' " :'';


        $update="UPDATE parent SET
        father_name='$name',
        father_IC='$ic',
        father_phoneNum='$phoneNum',
        father_work='$work',
        father_workAddress='$workAddress'";
        $update .= $ic;
       $update.= "WHERE parent_id=$id";

        if(mysqli_query($conn,$update)){
            header("location:../parent.php?info=The details has been updated successfully!");

        }

        else{
            header("location:../parent.php?error=Failed to update");

        }



    }

    else if(isset($_POST['mother'])){
        $id=$_POST['parent_id'];
        $name = $_POST['mother_name'];
        $ic = $_POST['mother_ic'];
        $phone = $_POST['mother_phone'];
        $work = $_POST['mother_work'];
        $workAddress = $_POST['mother_wAddress'];
        $mother_copy_ic = $_FILES['mother_copy_ic']['name']!='' ? addslashes(file_get_contents($_FILES['mother_copy_ic']['tmp_name'])):NULL;
        $ic= $_FILES['mother_copy_ic']['name'] != "" ? ",copy_icMonther = '$mother_copy_ic' " :'';

        $update="UPDATE parent SET
        mother_name='$name',
        mother_IC='$ic',
        mother_phoneNum='$phoneNum',
        mother_work='$work',
        mother_workAddress='$workAddress'";
        $update .= $ic;
        $update.= "WHERE parent_id=$id";
       

        if(mysqli_query($conn,$update)){
            header("location:../parent.php?info=The details has been updated successfully!");

        }

        else{
            header("location:../parent.php?error=Failed to update");

        }



    }


?>