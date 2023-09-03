<?php
        include('../../db_connect.php');

        if(isset($_GET['status'])){

            $status=$_GET['status'];
            $id=$_GET['id'];

            if($status=='ACCEPT'){

                $update="UPDATE child SET child_registerStatus='$status' WHERE child_id= $id";
                //$register_fee="INSERT INTO fee (fee_date, fee_desc, fee_amount, remain_paid, child_id, staff_id) VALUES ()";

                if(mysqli_query($conn,$update)) {
                    header("location:../../phpmailer/accept_email.php?child_id=$id");
                    
                }
            }

            


        }

        if(isset($_POST['registerStatus'])){

            $status=$_POST['registerStatus'];
            $id=$_POST['id'];
            $reason=$_POST['child_rejectReason'];

            $update="UPDATE child SET 
            child_registerStatus='$status',
            child_rejectReason = '$reason'
             WHERE child_id= $id";

            if(mysqli_query($conn,$update)) {
                header("location:../../phpmailer/reject_email.php?child_id=$id");
            }
        }

        if(isset($_POST['new_register'])){

            $father_copy_ic = $_FILES['father_copy_ic']['name']!='' ?addslashes(file_get_contents($_FILES['father_copy_ic']['tmp_name'])):NULL;
            $father_name = $_POST['father_name'];
            $email = $_POST['email'];
            $father_ic = $_POST['father_ic'];
            $father_phone = $_POST['father_phone'];
            $father_work = $_POST['father_work'];
            $father_wAddress = $_POST['father_wAddress'];
            $mother_copy_ic = $_FILES['mother_copy_ic']['name']!='' ? addslashes(file_get_contents($_FILES['mother_copy_ic']['tmp_name'])):NULL;
            $mother_name = $_POST['mother_name'];
            $mother_ic = $_POST['mother_ic'];
            $mother_phone = $_POST['mother_phone'];
            $mother_work = $_POST['mother_work'];
            $mother_wAddress = $_POST['mother_wAddress'];
            $parent_address = $_POST['parent_address'];
            $parent_town = $_POST['parent_town'];
            $parent_postcode = $_POST['parent_postcode'];
            $parent_state = $_POST['parent_state'];

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
            $child_type=$_POST['health_allergic_exp']!=''?$_POST['health_allergic_exp']:'';
            $health_allergic_doc = addslashes(file_get_contents($_FILES['health_allergic_doc']['tmp_name']));
            $reg_date = date("Y-m-d");
            $rewnew = date("Y"); 

            $contact_name = $_POST['contact_name'];
            $contact_phone = $_POST['contact_phone'];
            $contact_relationship = $_POST['contact_relationship'];

           $username=$_POST['father_ic']!=''?$_POST['father_ic']:$_POST['mother_ic'];
           $password=$_POST['father_ic']!=''?$_POST['father_ic']:$_POST['mother_ic'];

            echo $parent_state;

            $insert="INSERT INTO parent
            (email,father_name, father_IC, father_phoneNum, copy_icFather, copy_icMonther, mother_name, mother_IC, mother_phoneNum, parent_address, parent_town, parent_postcode, parent_state, father_work, father_workAddress, mother_work, mother_workAddress) 
            VALUES 
            ('$email','$father_name','$father_ic','$father_phone','$father_copy_ic','$mother_copy_ic','$mother_name','$mother_ic','$mother_phone','$parent_address','$parent_town ','$parent_postcode' ,'$parent_state','$father_work','$father_wAddress','$mother_work ','$mother_wAddress')";
            mysqli_query($conn,$insert) ;

            $last_id = $conn->insert_id;
            $hashPassword = password_hash($password , PASSWORD_DEFAULT);
            

            $user="INSERT INTO user (user_id ,username, user_password, user_type) VALUES ( '$last_id', '$username' , '$hashPassword', 'PARENT')";

            mysqli_query($conn,$user);

            $child_insert="INSERT INTO child
            (child_name, child_image, child_registerDate,  renew_register, child_gender, child_age, child_nickname, child_DOB, child_myKidNum, child_race, child_religion, health_problem, health_type, health_proof, copy_mykid, copy_birthCertificate, group_id, parent_id) 
            VALUES 
            ('$child_name','$child_img ','$reg_date ','$rewnew','$child_gender',$child_age,'$child_nickname','$child_dob ','$child_mykid','$child_race','$child_religion','$child_health','$child_type','$health_allergic_doc','$child_copy_mykid ','$child_copy_birth',$group_id, $last_id)";

            
            mysqli_query($conn,$child_insert);
               
            
            $child_id = $conn->insert_id;
            $invoice_no='IN'.rand(10000000,99999999);
            $fee_description='Fee registration';
            $query = " INSERT INTO  fee (fee_date, fee_desc, fee_amount, child_id, remain_paid,invoice_no, staff_id) VALUES ('$reg_date', '$fee_description', 100, $child_id ,100,'$invoice_no', 20000) ";

            $insert_contact="INSERT INTO emergency_contact( contact_name, contact_relationship, contact_phoneNum, child_id) 
            VALUES ('$contact_name','$contact_relationship','$contact_phone',$child_id)";
            if(  mysqli_query($conn,$insert_contact) && mysqli_query($conn,$query)){
                header("location:../new_register.php?success=The registration has been created");

            }
                        

        }

        if(isset($_GET['delete'])){

            $child_id=$_GET['delete'];
            echo $child_id;

            $sql_delete="DELETE FROM child WHERE child_id = $child_id";

            if(  mysqli_query($conn,$sql_delete)){
                header("location:../rejected_register.php?info=The registration has been deleted");
            }


        }

        
        if(isset($_GET['delete_all'])){

            $child_id=$_GET['delete_all'];
            echo $child_id;

            $sql_delete="DELETE FROM child WHERE child_id = $child_id";

            if(  mysqli_query($conn,$sql_delete)){
                header("location:../child_list.php?info=The child's details has been deleted");
            }


        }

        if(isset($_POST['update_child'])){

            $child_id = $_POST['child_id'];

            $contact_name = $_POST['contact_name'];
            $contact_phone = $_POST['contact_phone'];
            $contact_relationship = $_POST['contact_relationship'];
    
            $emergency_update="UPDATE emergency_contact SET 
            contact_name='$contact_name',contact_relationship='$contact_relationship', contact_phoneNum='$contact_phone' 
            WHERE child_id=$child_id";

            mysqli_query($conn,$emergency_update);

            $child_id = $_POST['child_id'];
            $session = $_POST['session'];
            $child_name = $_POST['child_name'];
            $child_mykid = $_POST['child_mykid'];
            $child_nickname = $_POST['child_nickname'];
            $child_gender = $_POST['child_gender'];
            $child_dob = $_POST['child_dob'];
            $child_age = date('Y') - date("Y", strtotime($_POST['child_dob']));;
            $child_race = $_POST['child_race'];
            $child_religion = $_POST['child_religion'];
            $group_id = $_POST['group_id'];
            $child_type= $_POST['child_health']=='Yes' ? $_POST['health_allergic_exp']:'';
            $child_health = $_POST['child_health'];

            $child_img = $_FILES['child_img']['error'] == 0 ? addslashes(file_get_contents($_FILES['child_img']['tmp_name'])):'';
            $sql_img= $_FILES['child_img']['error'] == 0 ? " ,child_image ='$child_img'" :'';

            $mykid = $_FILES['child_copy_mykid']['error'] == 0 ? addslashes(file_get_contents($_FILES['child_copy_mykid']['tmp_name'])):'';
            $sql_mykid= $_FILES['child_copy_mykid']['error'] == 0 ? " ,copy_mykid ='$mykid'" :'';

            $certificate = $_FILES['child_copy_birth']['error'] == 0 ? addslashes(file_get_contents($_FILES['child_copy_birth']['tmp_name'])):'';
            $sql_certificate= $_FILES['child_copy_birth']['error'] == 0 ? " ,copy_birthCertificate ='$certificate'" :'';

            if(isset($_FILES['health_allergic_doc'])){
            $doc = $_FILES['health_allergic_doc']['error'] == 0 ? addslashes(file_get_contents($_FILES['health_allergic_doc']['tmp_name'])):'';
            $sql_doc= $_FILES['health_allergic_doc']['error'] == 0 ? " ,health_proof ='$doc'" :'';}
           
           

            $child_update="UPDATE child SET 
            child_name='$child_name',
            renew_register=$session,
            child_gender='$child_gender ',
            child_age='$child_age',
            child_nickname='$child_nickname',
            child_DOB='$child_dob',
            child_myKidNum='$child_mykid',
            child_race='$child_race',
            child_religion='$child_religion',
            health_problem='$child_health',
            health_type='$child_type',
            group_id=$group_id";
            $child_update .= $sql_img;
            $child_update .= $sql_mykid;
            $child_update .= $sql_certificate;
            if(isset($_FILES['health_allergic_doc'])){
            $child_update .= $sql_doc;}
            $child_update .= " WHERE child_id=$child_id";
        

     
       

        if(  mysqli_query($conn,$child_update)){
            header("location:".$_SERVER['HTTP_REFERER']."&info=The details has been updated");
        }
        else{
            echo mysqli_error($conn);
        }
    }

    if(isset($_POST['update_parent'])){

        $parent_id=$_POST['parent_id'];
        $email=$_POST['email'];
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
        echo $parent_id;

            $copy_father = $_FILES['father_copy_ic']['error'] == 0 ? addslashes(file_get_contents($_FILES['father_copy_ic']['tmp_name'])):'';
            $sql_father= $_FILES['father_copy_ic']['error'] == 0 ? " ,copy_icFather ='$copy_father'" :'';

            $copy_mother = $_FILES['mother_copy_ic']['error'] == 0 ? addslashes(file_get_contents($_FILES['mother_copy_ic']['tmp_name'])):'';
            $sql_mother= $_FILES['mother_copy_ic']['error'] == 0 ? " ,copy_icMonther ='$copy_mother'" :'';

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
        $parent_update .= $sql_father;
        $parent_update .= $sql_mother;

       $parent_update.=" WHERE parent_id=$parent_id";

        if(  mysqli_query($conn,$parent_update)){
            header("location:".$_SERVER['HTTP_REFERER']."&info=The details has been updated");

        }

        



    }

?>