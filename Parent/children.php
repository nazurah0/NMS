<html lang="en">
<?php
        
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Children</title>
    
    <?php 
    
    session_start();
    include "header.php";
    
    if($_SESSION['signin']!='1'){
        header('location:../index.php');
    }
    include('../db_connect.php');
    
    
    ?>
     
 
  
</head>
<style>
    .card {
    transition: all 0.2s ease;
    cursor: pointer
}

.card:hover {
    box-shadow: 5px 6px 6px 2px #e9ecef;
    transform: scale(1.1)
}




</style>
<body id="page-top">


     <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3bb78f;
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
            <li class="nav-item  ">
                <a class="nav-link " href="home.php">
                <i class="fa-solid fa-house" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Home</span></a>
            </li>

            <li class="nav-item parent" >
                <a class="nav-link parent_btn" href="parent.php">
                <i class="fas fa-user-friends" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Parent</span></a>
            </li>


            <li class="nav-item active">
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

                <?php 
                        $id=$_SESSION['id'];
                        $child = $conn->query("SELECT * from 
                        child c 
                        JOIN child_group g ON c.group_id = g.group_id
                        JOIN emergency_contact e ON c.child_id = e.child_id
                        WHERE c.child_registerStatus = 'ACCEPT' AND
                        c.parent_id = $id
                        order by c.child_id asc");

                        
                ?> 

                <!-- Begin Page Content -->
                <div class="container-fluid"> 
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
                    <!-- Page Heading -->
                    <div class="text-center  pt-3 ">
                         <h1 class="h3 mb-0 text-gray-800 "><b>List of Children</b> </h1>
                        
                        </div>

                        

                    

                    <div class="row g-2 ml-4">
                        
                        <?php while($row=$child->fetch_assoc()): ?>
                        <div class="col-lg-4 d-flex align-items-stretch " >
                            
                            <a class="card shadow mx-4 my-4 text-secondary" style="border-radius: 40px;  text-decoration:none; " href="child_view.php?id=<?php echo $row['child_id']; ?>" >

                            
                                <div class="card-body">
                                    <div class="image-child text-center pt-2" >
                                        <img   src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['child_image']); ?>"  style=" height:220; width: 250px;  object-fit: cover; border-radius: 30px; padding-bottom:20px;" >
                                    </div>

                                    <div class="content  mx-3 ">
                                        <h5 class="card-title"><b><?php echo $row['child_nickname'] ?></b></h5>
                                        

                                        <div class="card-text">
                                            <div class="row pb-3">
                                                <label  class="col-sm-4 ">Group</label>
                                                <div class="col-sm-8">
                                                    <b><?php echo $row['group_name'] ?></b>                                          
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-text">
                                            <div class="row pb-1">
                                                <label  class="col-sm-4 ">MyKid </label>
                                                <div class="col-sm-8">
                                                <b><?php $number = $row['child_myKidNum'];
                                                    $formatted_number = preg_replace("/^(\d{6})(\d{2})(\d{4})$/", "$1-$2-$3", $number); 
                                                    echo $formatted_number  ?></b>                                          
                                                </div>
                                            </div>
                                                    
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="card-footer btn " style="border-bottom-left-radius: 40px; border-bottom-right-radius: 40px; ">
                                    <b>view</b>
                                </div>
                             
                            
                            </a>
                        </div>

                        
                        <?php endwhile; ?>  

                        <div class="col-lg-4 d-flex align-items-stretch " >
                        
                            <a class="card shadow card-add mx-4 my-4 btn" style=" height:auto; display:flex; align-items:center; justify-content:center;border-radius: 40px" href="register_form.php" >
                            
                                <div class="mx-5 mt-3 text-center d-block" style="opacity: 0.5;">
                                        <svg xmlns="http://www.w3.org/2000/svg"  height="200" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"  class="text-center d-block ">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        <p class="pt-3">New Registration</p>
                                    </div> 
                                </a>  
                             
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

    <!-- manage user  Modal-->
    <?php include "manage_user.php"; ?>


       

    <!-- Script-->
    <?php include "script.php"; ?>


  
</body>
</html>