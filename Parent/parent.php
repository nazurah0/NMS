<html lang="en">
<?php
       
        
        
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Parent</title>
    
    <?php 
        session_start();
        include "header.php";
        include('../db_connect.php');
        if($_SESSION['signin']!='1'){
            header('location:../index.php');
        }
        ?>
     
 
  
</head>
<body id="page-top">


     <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3bb78f;
background-image: linear-gradient(315deg, #3bb78f 0%, #0bab64 74%);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand  align-items-center justify-content-center mb-1" href="home.php">
                <div class="sidebar-brand-icon ">
                <img class="mb-1" src="../image/logo1.png" width="75"style="-webkit-filter: drop-shadow(5px 5px 5px #666666);
                        filter: drop-shadow(5px 5px 5px #666666);" alt="">
                </div>
                
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0 mt-4" >

            <!-- Nav Item - Dashboard -->
            <li class="nav-item " >
                <a class="nav-link " href="home.php">
                <i class="fa-solid fa-house" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Home</span></a>
            </li>

            <li class="nav-item active" >
                <a class="nav-link parent_btn" href="parent.php">
                <i class="fas fa-user-friends" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Parent</span></a>
            </li>


            <li class="nav-item ">
                <a class="nav-link" href="children.php">
                <i class="fa-solid fa-chalkboard-user" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Children</span></a>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item " >
                <a class="nav-link " href="fee.php">
                <i class="fa-solid fa-file-invoice-dollar" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Fee</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column"> 

             <!-- Main Content -->
             <div id="content"> 

                 <!-- Topbar -->
                <?php include "topbar.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid"> 
                    <?php 
                        $id=$_SESSION['id'];
                        $parent = $conn->query("SELECT * from 
                        parent  
                        WHERE parent_id= $id" );
                        foreach($parent->fetch_array() as $k => $val){
                            $$k=$val;
                        }
                    ?>
                    <div >
                            <?php 

                            if(@$_GET['success']==true)
                            {
                            ?>
                                <div class="alert alert-success  block  alert-dismissible" >
                                    
                                        <button type="button" class="close mt-3" data-dismiss="alert">&times;</button>

                                        <div>
                                        <p class="text-justify  mt-3 text-xl-left"><i class="fa-solid fa-circle-check"></i> <?php echo $_GET['success']?></p>
                                        </div>
                                </div>
                            <?php }

                            

                            else if(@$_GET['info']==true)
                            {
                            ?>
                                <div class="alert alert-info  block  alert-dismissible" >
                                    
                                        <button type="button" class="close mt-3" data-dismiss="alert">&times;</button>

                                        <div>
                                        <p class="text-justify  mt-3 text-xl-left"><i class="fa-solid fa-circle-info"></i> <b>Success! </b><?php echo $_GET['info']?></p>
                                        </div>
                                </div>
                            <?php }
                            
                                else if(@$_GET['error']==true)
                                {
                                ?>
                                    <div class="alert alert-danger  block  alert-dismissible" >
                                    
                                            <button type="button" class="close mt-3" data-dismiss="alert">&times;</button>

                                            <div>
                                            <p class="text-justify  mt-3 text-xl-left"><i class="fa-solid fa-circle-info"></i> <?php echo $_GET['error']?></p>
                                            </div>
                                    </div>
                                <?php }?>
                        </div>   
                    <div class="row g2">

                        <div class="col-md-6">
                            <div class="container mt-5">
                                <div class="card  shadow">
                                    <div class=" card-header px-4 pt-5 " style="background-color:#9589A9">
                                            <h4 class=" card-title text-light"> <b>Father's Details</b></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row pb-3">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext font-weight-bold"  value="<?php echo $father_name ?>">
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">IC Number</label>
                                            <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext font-weight-bold"  value="<?php  
                                            $number = $father_IC;
                                            $formatted_number = preg_replace("/^(\d{6})(\d{2})(\d{4})$/", "$1-$2-$3", $number); 
                                            echo $formatted_number ?>"> </div>
                                         </div>

                                         <div class="row pb-3">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Phone Number</label>
                                            <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext font-weight-bold"  value="<?php 
                                            $number = $father_phoneNum;
                                            $formatted_number = preg_replace("/^(\d{3})(\d{7})$/", "$1-$2", $number); 
                                            echo $formatted_number
                                            ?>">
                                            </div>   
                                        </div>

                                        <div class="text-right">
                                        <button class="btn btn-outline-secondary" href="#" data-toggle="modal" data-target="#fatherModal<?php echo $parent_id ?>">Edit</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="container mt-5">
                                <div class="card  shadow">
                                    <div class=" card-header px-4 pt-5 " style="background-color:#F8A2A8">
                                        <h4 class=" card-title text-light"> <b>Mother's Details</b></h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row pb-3">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext font-weight-bold"  value="<?php echo $mother_name ?>">
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">IC Number</label>
                                            <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext font-weight-bold"  value="<?php 
                                            $number = $mother_IC;
                                            $formatted_number = preg_replace("/^(\d{6})(\d{2})(\d{4})$/", "$1-$2-$3", $number); 
                                            echo $formatted_number
                                            ?>"  >  
                                            </div>                                       
                                        </div>
                                        <div class="row pb-3">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Phone Number</label>
                                            <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext font-weight-bold"  value="<?php 
                                            $number = $mother_phoneNum;
                                            $formatted_number = preg_replace("/^(\d{3})(\d{7})$/", "$1-$2", $number); 
                                            echo $formatted_number
                                            ?>">
                                            </div>   
                                        </div>
                                        <div class="text-right">
                                        <button class="btn btn-outline-secondary href="#" data-toggle="modal" data-target="#motherModal<?php echo $parent_id ?>">Edit</button>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>  

                        <div class="col-md-12 pb-5">
                            <div class="container mt-5">
                                <form action="handler/parent_handler.php" method="POST" >
                                <div class="card  shadow">
                                    <div class=" card-header px-4 pt-5 " style="background-color:#475250">
                                        <h4 class=" card-title text-light"> <b>Home Address</b></h4>
                                    </div>

                                    <div class="card-body">
                                        <input type="hidden" class="form-control "  value="1" name="address">
                                        <input type="hidden" class="form-control "  value="<?php echo isset($parent_id) ? $parent_id : '' ?>" name="parent_id">

                                        <div class="row pb-3">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                            <textarea type="text"  class="form-control font-weight-bold" name="parent_address"><?php echo $parent_address ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Town</label>
                                            <div class="col-sm-5">
                                            <input type="text"  class="form-control font-weight-bold"  value="<?php echo $parent_town?>" name="parent_town">  
                                            </div>                                       
                                        </div>
                                        <div class="row pb-3">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Postcode</label>
                                            <div class="col-sm-3">
                                            <input type="text"  class="form-control   font-weight-bold"  value="<?php echo $parent_postcode ?>" name="parent_postcode">
                                            </div>   
                                        </div>

                                        <div class="row pb-3">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">State</label>
                                            <div class="col-sm-5">
                                            <input type="text"  class="form-control   font-weight-bold"  value="<?php echo $parent_state ?>" name="parent_state">
                                            </div>   
                                        </div>
                                        
                                        <div class="text-right">
                                        <button class="btn btn-outline-success" type="submit">Save</button>
                                        </div>
                                    </div>
                                    </form>
                                    
                                </div>
                            </div>
                            
                        </div>                       

                    </div>
                    
                        

                </div>
                <!-- End Page Content -->

             </div>
             <!-- End of Main Content -->

              <!-- Footer -->
              <?php include "footer.php"; ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
     <!-- End of Page Wrapper -->

    <!-- signout Modal-->
    <?php include "signout.php"; ?>

    <!-- Parent Modal-->
    <?php include "parent_modal.php"?>

    <!-- manage user  Modal-->
    <?php include "manage_user.php"; ?>

       

    <!-- Script-->
    <?php include "script.php"; ?>


  
</body>
</html>