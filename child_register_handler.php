<?php

    session_start();
    include('db_connect.php');
    
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
    $health_exp=$_POST['reason']!=NULL?$_POST['reason']:'';
    $health_allergic_doc = $_FILES['health_proof']['name'] != NULL ? addslashes(file_get_contents($_FILES['health_proof']['tmp_name'])) :NULL;
    $reg_date = date("Y-m-d");
    $rewnew = date("Y"); 

    $contact_name = $_POST['contact_name'];
    $contact_phone = $_POST['contact_phone'];
    $contact_relationship = $_POST['contact_relationship'];

    $child_insert="INSERT INTO child
    (child_name, child_image, child_registerDate,  renew_register, child_gender, child_age, child_nickname, child_DOB, child_myKidNum, child_race, child_religion, health_problem, health_type, health_proof, copy_mykid, copy_birthCertificate, group_id, parent_id) 
    VALUES 
    ('$child_name','$child_img ','$reg_date ','$rewnew','$child_gender',$child_age,'$child_nickname','$child_dob ','$child_mykid','$child_race','$child_religion','$child_health ', '$health_exp','$health_allergic_doc','$child_copy_mykid ','$child_copy_birth',$group_id,  $parent_id)";

    
    mysqli_query($conn,$child_insert);
       
    
    $child_id = $conn->insert_id;
    $invoice_no='IN'.rand(10000000,99999999);
    $fee_description='Fee registration';
    $query = " INSERT INTO  fee (fee_date, fee_desc, fee_amount, child_id, remain_paid,invoice_no, staff_id) VALUES ('$reg_date', '$fee_description', 100, $child_id ,100,'$invoice_no', 20000) ";

    $insert_contact="INSERT INTO emergency_contact( contact_name, contact_relationship, contact_phoneNum, child_id) 
    VALUES ('$contact_name','$contact_relationship','$contact_phone',$child_id)";

    if(mysqli_query($conn,$insert_contact)&& mysqli_query($conn,$query)){
        echo"succcess";
        header("location:success.php");
    }
