<?php 
    include('../../db_connect.php');
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $stat=$conn->query('SELECT *,health_proof from child where child_id='.$id);

    if($_GET['type']=='pdf_mukid'){

    $row=$stat->fetch_assoc();
    header('Content-Type:application/pdf');
    echo $row['copy_mykid'];
    }

    else if($_GET['type']=='pdf_certificate'){

    $row=$stat->fetch_assoc();
    header('Content-Type:application/pdf');
    echo $row['copy_birthCertificate'];
    }

    

    else if($_GET['type']=='health_proof'){

        $row=$stat->fetch_assoc();
        header('Content-Type:application/pdf');
        echo $row['health_proof'];
        }
    
}

else if(isset($_GET['parent_id'])){
    $id=$_GET['parent_id'];
    $stat=$conn->query('SELECT *,copy_icMonther,copy_icFather from parent where parent_id='.$id);
  

    if($_GET['type']=='father_copy'){

        $row=$stat->fetch_assoc();
        header('Content-Type:application/pdf');
        echo $row['copy_icFather'];
        }
    
    else if($_GET['type']=='mother_copy'){
    
        $row=$stat->fetch_assoc();
        header('Content-Type:application/pdf');
        echo $row['copy_icMonther'];
    }


}


   
?>