
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Attendance</title>
    
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
            <li class="nav-item active ">
                <a class="nav-link " href="home.php">
                <i class="fa-solid fa-house" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Home</span></a>
            </li>

            <li class="nav-item parent" >
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
                        $attendance = $conn->query("SELECT DISTINCT  *  from 
                        attendance a
                        JOIN child c ON c.child_id=a.child_id
                        JOIN child_group g ON g.group_id=c.group_id
                        WHERE a.attendance_id='".$_GET['attendance_id']."'");

                        $detail= mysqli_fetch_assoc($attendance);
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
                        <div class="card shadow mb-5">
                            <div class="card-body"> 
               
                                            <div class="col-md-12 text-center " >
                                                         
                                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($detail['child_image']); ?>" class=" mx-auto d-block mb-3 " alt="..." width="200" style="border-radius: 50%;width: 250px; height: 250px;object-fit: cover;">
                                                         

                                            </div>

                                            <div class="text-center pt-4" >
                                                        
                                                            <a class="btn btn-success btn-lg <?php echo $detail['attendance_arrivalTime']!=NULL? 'disabled':'' ?>  " href="handler/attendance_handler.php?clockin=<?php echo $detail['attendance_id'] ?>" style="width:200px"  > Clock in </a>

                                                        
                                                        <a class="btn btn-danger btn-lg <?php echo $detail['attendance_arrivalTime']==NULL || $detail['attendance_pickupTime']!=NULL  ? 'disabled' :'' ?>" href="handler/attendance_handler.php?clockout=<?php echo $detail['attendance_id'] ?>" style="width:200px" <?php echo $detail['attendance_arrivalTime']==NULL ? 'disabled':'' ?>   > Clock Out </a>
                                                        
                                            </div>

                                            <div class="card   " style="margin-left:150px; margin-right:150px; margin-top:30px; margin-bottom:30px; background-color:#F3F5F9; border:  none; border-radius:10px" >
                                                <div class="card-body mx-5">

                                                    <div class="row pb-3">
                                                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                                        <div class="col-sm-10">
                                                        <p  class="form-control-plaintext font-weight-bold" ><?php echo $detail['child_name'] ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="row pb-3">
                                                        <label for="staticEmail" class="col-sm-2 col-form-label">Group</label>
                                                        <div class="col-sm-10">
                                                        <p  class="form-control-plaintext font-weight-bold" ><?php echo $detail['group_name'] ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="row pb-3">
                                                        <label for="staticEmail" class="col-sm-2 col-form-label" >Date</label>
                                                        <div class="col-sm-10">
                                                        <p  class="form-control-plaintext font-weight-bold" ><?php echo date( 'd F Y ',strtotime( $detail['attendance_date']) )  ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="row pb-3 mt-4">
                                                        
                                                        <div class="col-sm-6 ">
                                                            <div class="row py-2   mr-2" style="outline: #C0C9CC solid 2px; border-radius:25px">
                                                                <label for="staticEmail" class="col-sm-4 col-form-label" style="border-right: 2px solid #C0C9CC;">Arrival Time </label>
                                                                <div class="col-sm-8">
                                                                <p  class="form-control-plaintext font-weight-bold" ><?php echo $detail['attendance_arrivalTime']!=NULL? date( 'h:i A ',strtotime( $detail['attendance_arrivalTime']) ) : '' ?></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="row py-2 ml-2 " style="outline: #C0C9CC solid 2px; border-radius:25px">
                                                                <label for="staticEmail" class="col-sm-4 col-form-label" style="border-right: 2px solid #C0C9CC;">Pick up Time</label>
                                                                <div class="col-sm-8">
                                                                <p  class="form-control-plaintext font-weight-bold" ><?php echo $detail['attendance_pickupTime']!=NULL ?   date( 'h:i A ',strtotime( $detail['attendance_pickupTime']) ) :'' ?></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row py-2 " style="outline: #C0C9CC solid 2px; border-radius:25px; width:350px; margin: auto;">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label" style="border-right: 2px solid #C0C9CC;">Status</label>
                                                        <div class="col-sm-8">
                                                        <input type="text" readonly class="form-control-plaintext font-weight-bold <?php echo $detail['attendance_status']=='PRESENT'? 'text-success':'text-danger' ?>"  value="<?php echo $detail['attendance_status'] ?>">
                                                        </div>
                                                    </div>

                                                    
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

    <!-- manage user  Modal-->
    <?php include "manage_user.php"; ?>


       

    <!-- Script-->
    <?php include "script.php"; ?>

    <!--chart -->
    <?php include "../js/chart/chart-area-demo.php"; ?>
    <?php include "../js/chart/chart-pie-demo.php"; ?>
  
</body>
</html>