<?php
    session_start();
    include('../db_connect.php');
    echo $_SESSION['id'];
    $id=$_SESSION['id'];

    $sql=$conn->query("SELECT * FROM child c JOIN parent p ON c.parent_id=p.parent_id WHERE p.parent_id=$id");
    $countRow = mysqli_num_rows( $sql );
    if($countRow==0){
        header('location:../child_register.php');
    }
    else if($countRow>0){
        header('location:home.php');
    }



?>