<?php 
    session_start();
    include('../../db_connect.php');

    if(!isset($_POST['child_id'])|| $_POST['child_id']==''){
        echo 2;

    $parent_id=$_SESSION['id'];
    
    $child_img = addslashes(file_get_contents($_FILES['child_image']['tmp_name']));
    $child_name = $_POST['child_name'];
    $child_mykid = $_POST['child_mykid'];
    $child_nickname = $_POST['child_nickname'];
    $child_gender = $_POST['child_gender'];
    $child_dob = $_POST['child_dob'];
    $child_age = $_POST['child_age'];
    $child_race = $_POST['child_race'];
    $child_religion = $_POST['child_religion'];
    $group_id = $_POST['group_id'];
    $child_copy_mykid = addslashes(file_get_contents($_FILES['child_copy_mykid']['tmp_name']));
    $child_copy_birth = addslashes(file_get_contents($_FILES['child_copy_birth']['tmp_name']));
    $child_health = $_POST['child_health'];
    $child_type=$_POST['child_health']=='Yes'? $_POST['health_allergic_exp']:NULL;
    $health_allergic_doc = $_FILES['health_allergic_doc']['name']=='' ? addslashes(file_get_contents($_FILES['health_allergic_doc']['tmp_name'])) :NULL;
    $reg_date = date("Y-m-d");
    $rewnew = date("Y"); 

       

    $contact_name = $_POST['contact_name'];
    $contact_phone = $_POST['contact_phone'];
    $contact_relationship = $_POST['contact_relationship'];

   

    $child_insert="INSERT INTO child
    (child_name, child_image, child_registerDate,  renew_register, child_gender, child_age, child_nickname, child_DOB, child_myKidNum, child_race, child_religion, health_problem, health_type, health_proof, copy_mykid, copy_birthCertificate, group_id, parent_id) 
    VALUES 
    ('$child_name','$child_img','$reg_date','$rewnew','$child_gender',$child_age,'$child_nickname','$child_dob','$child_mykid','$child_race','$child_religion','$child_health ','$child_type','$health_allergic_doc','$child_copy_mykid','$child_copy_birth',$group_id, $parent_id)";

    
    if(mysqli_query($conn,$child_insert)){
       
    $child_id = $conn->insert_id;
    $invoice_no='IN'.rand(10000000,99999999);
    $fee_description='Fee registration';
    $query = " INSERT INTO  fee (fee_date, fee_desc, fee_amount, child_id, remain_paid,invoice_no, staff_id) VALUES ('$reg_date', '$fee_description', 100, $child_id ,100,'$invoice_no', 20000) ";
    

    $insert_contact="INSERT INTO emergency_contact( contact_name,  contact_phoneNum, contact_relationship, child_id) 
    VALUES ('$contact_name','$contact_phone','$contact_relationship',$child_id)";
    if(  mysqli_query($conn,$insert_contact)&& mysqli_query($conn,$query)){
        header("location:../home.php?success=The registration form has been submitted");

    }
    else{
        echo 'failed';
    }
    }
    else{
        echo mysqli_error($conn);
    }
                

}



else if(isset($_POST['child_id']) && $_POST['register_status']=='REJECT'){
    echo 1;
    echo 'resubmit';
    $child_id = $_POST['child_id'];
    $child_img = addslashes(file_get_contents($_FILES['child_image']['tmp_name']));
    $child_name = $_POST['child_name'];
    $child_mykid = $_POST['child_mykid'];
    $child_nickname = $_POST['child_nickname'];
    $child_gender = $_POST['child_gender'];
    $child_dob = $_POST['child_dob'];
    $child_age = $_POST['child_age'];
    $child_race = $_POST['child_race'];
    $child_religion = $_POST['child_religion'];
    $group_id = $_POST['group_id'];
    $child_copy_mykid = addslashes(file_get_contents($_FILES['child_copy_mykid']['tmp_name']));
    $child_copy_birth = addslashes(file_get_contents($_FILES['child_copy_birth']['tmp_name']));
    $child_health = $_POST['child_health'];
    $child_type=$_POST['child_health']=='Yes'? $_POST['health_allergic_exp']:'';
    $health_allergic_doc = $_FILES['health_allergic_doc']['name'] !='' ? addslashes(file_get_contents($_FILES['health_allergic_doc']['tmp_name'])) :NULL;




    $contact_name = $_POST['contact_name'];
    $contact_phone = $_POST['contact_phone'];
    $contact_relationship = $_POST['contact_relationship'];

   

    $resubmit_insert="UPDATE child SET
    child_image = '$child_img',
    child_name='$child_name',
    copy_mykid='$child_copy_mykid', 
    copy_birthCertificate='$child_copy_birth',
    child_gender='$child_gender',
    child_age=$child_age,
    child_nickname='$child_nickname',
    child_DOB='$child_dob',
    child_myKidNum='$child_mykid',
    child_race='$child_race',
    child_religion='$child_religion',
    health_problem='$child_health',
    health_type='$child_type',
    health_proof = '$health_allergic_doc',
    group_id=$group_id,
    child_registerStatus='WAITING',
    child_rejectReason=''
    WHERE child_id=$child_id";


    
   

       


    $resubmit_contact="UPDATE emergency_contact SET 
    contact_name='$contact_name',contact_relationship='$contact_relationship',contact_phoneNum='$contact_phone' 
    WHERE child_id=$child_id";
    if(  mysqli_query($conn,$resubmit_contact) &&  mysqli_query($conn,$resubmit_insert)){
        header("location:../home.php?success=The registration form has been resubmit");

    }
                

}



    else if(isset($_POST['update'])){

        echo 3;

        $child_id = $_POST['child_id'];
        $child_img = $_FILES['child_img']['name'] != "" ? addslashes(file_get_contents($_FILES['child_img']['tmp_name'])):'';
        $child_name = $_POST['child_name'];
        $child_group = $_POST['child_group'];
       // $child_mykid = $_POST['child_mykid'];
        $child_nickname = $_POST['child_nickname'];
        $child_gender = $_POST['child_gender'];
        $child_dob = $_POST['child_dob'];
        $child_age = date('Y') - date("Y", strtotime($_POST['child_dob']));
        $child_race = $_POST['child_race'];
        $child_religion = $_POST['child_religion'];
        $session = $_POST['session'];
        $health_allergic_doc =  $_FILES['health_allergic_doc']['name'] != "" ? addslashes(file_get_contents($_FILES['health_allergic_doc']['tmp_name'])) :NULL;
        $health_type= $_POST['child_health']=='Yes'?$_POST['health_allergic_exp']:'';
        $child_health = $_POST['child_health'];
        $sql_img= $_FILES['child_img']['name'] != "" ? ",child_image = '$child_img' " :'';
        $sql_doc_health= $_FILES['health_allergic_doc']['name'] != "" ? ", health_proof = '$health_allergic_doc' " :'';
        $group= isset($_POST['child_group']) ? ",group_id= $child_group ":'';
        $sql_session= isset($_POST['session']) ? ",renew_register = $session ":'';

        $contact_name = $_POST['contact_name'];
        $contact_phone = $_POST['contact_phone'];
        $contact_relationship = $_POST['contact_relationship'];

        $emergency_update="UPDATE emergency_contact SET 
        contact_name='$contact_name',contact_relationship='$contact_relationship', contact_phoneNum='$contact_phone' 
        WHERE child_id=$child_id";

        mysqli_query($conn,$emergency_update);

        echo $child_name;
        $child_update="UPDATE child SET
        child_name='$child_name',
        child_gender='$child_gender',
       
        child_age=$child_age,
        child_nickname='$child_nickname',
        child_DOB='$child_dob',
        
        health_problem='$child_health',
        health_type='$child_type',
        child_race='$child_race',
        child_religion='$child_religion',
        health_type='$health_type' ";
         $child_update .= $sql_session;
        $child_update .=  $group;
        $child_update .=  $sql_img;
        $child_update .=  $sql_doc_health;


        $child_update .= "WHERE child_id=$child_id";


   

    if(  mysqli_query($conn,$child_update)){
        header("location:../child_view.php?id=$child_id,&info=The details has been updated");
    }

    else{
        echo mysqli_error($conn);
    }
}





?>