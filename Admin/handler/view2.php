<?php 
    include('../../db_connect.php');




    $id=$_GET['parent_id'];
    $stat=$conn->query('SELECT * from parent where parent_id='.$id);
    $row=$stat->fetch_assoc();

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





   
?>