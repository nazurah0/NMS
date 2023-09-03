<?php
	    include_once '../db_connect.php';

	    if (isset($_GET['id'])) 
	           {
				     $id = $_GET['id'];
				     $query = "SELECT * FROM child WHERE child_id = '$id'";
				     $result = mysqli_query($conn,$query) or die('Error, query failed');
				     list($child_id,$child_name, $health_information) = mysqli_fetch_array($result);
				 				   //echo $id . $file . $type . $size;
				 				   //echo 'sampath';
                                   
				     header("Content-length: $fsize");
				     header("Content-type: $ftype");
				     header("Content-Disposition: attachment; filename=$child_name");
				     ob_clean();
				     flush();
                     $content = stripslashes($content);
				     echo $content;
				     mysqli_close($conn);
				     exit;
	           }

	       ?>