<html lang="en">
<?php
        
        include('../db_connect.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Dashboard</title>

   
    <?php include "header.php";
        
        if($_SESSION['signin']!=1){
            header('location:../index.php');
            exit();
        }
    
    ?>
</head>
<style>
    .card-link{
        text-decoration:none;
        transition: all 0.2s ease;
    cursor: pointer
    }
    

.card-link:hover {
    box-shadow: 5px 6px 6px 2px #e9ecef;
    transform: scale(1.1)
}
</style>
<body id="page-top">


     <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion " id="accordionSidebar" style="background-color: #3bb78f;
background-image: linear-gradient(315deg, #3bb78f 0%, #0bab64 74%);" >

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand  align-items-center justify-content-center mb-3" href="dashboard.php">
            <div class="sidebar-brand-icon ">
            <img class="mb-2" src="../image/logo1.png" width="80"style="-webkit-filter: drop-shadow(5px 5px 5px #666666);
                    filter: drop-shadow(5px 5px 5px #666666);" alt="">
            </div>
            
</a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0 ">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active  ">
                <a class="nav-link " href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider (line) -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-scroll"></i>
                    <span>Registration</span>
                </a>
                <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <a class="collapse-item " href="new_register.php">Registration</a>
                        <a class="collapse-item" href="rejected_register.php">Rejected Registration</a>
                    </div>
                </div>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Information
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-child"></i>
                    <span>Children</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    
                        <a class="collapse-item" href="child_list.php">List</a>
                        <a class="collapse-item" href="child_attendance.php">Attendance</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item parent" >
                <a class="nav-link parent_btn" href="parents.php">
                <i class="fas fa-user-friends"></i>
                <span>Parent</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Management
            </div>

            <?php if($_SESSION['type']=='ADMIN'){?>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="mgt_group.php">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>Group</span></a>
        </li>
    <?php }?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-money-bill"></i>
                    <span>Financial</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    
                        <a class="collapse-item" href="mgt_fee.php">Fee</a>
                        <a class="collapse-item" href="mgt_payment.php">Payment</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="report.php">
                <i class="fas fa-sticky-note"></i>
                <span>Report</span></a>
            </li>

            <?php if($_SESSION['type']=='ADMIN'){?>
            <!-- Nav Item - Charts -->
            <li class="nav-item ">
                <a class="nav-link" href="mgt_staff.php">
                <i class="fas fa-user-edit"></i>
                <span>Staff</span></a>
            </li>
            <?php }?>




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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    

                    <div class="row">
                        
                         <!-- Card  -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <?php 
                            
                                $sql = "SELECT * FROM child WHERE child_registerStatus='WAITING'";
                                $result = mysqli_query($conn, $sql);
                                $countReq = mysqli_num_rows( $result );
                            ?>
                            <a href="new_register.php"  class="card  card-link shadow h-100 py-2"  style="border-left-color:#29A2C6; border-left-width:4px ">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#29A2C6;">
                                                    Waiting List</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countReq?></div>
                                            </div>
                                            <div class="col-auto">
                                            
                                                <i class="fa-solid fa-pen-to-square fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                        </div>

                        <!-- Card  -->
                        <div class="col-xl-3 col-md-6 mb-4 ">
                             <?php 
                                
                                $sql1 = "SELECT * FROM payment WHERE payment_status='WAITING'";
                                $result1 = mysqli_query($conn, $sql1);
                                $countPayment  = mysqli_num_rows( $result1 );
                            ?>
                            <a href="mgt_payment.php"  class="card card-link shadow h-100 py-2" style="border-left-color:#73B66B; border-left-width:4px ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#73B66B;" >
                                                New Payment </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countPayment?></div>
                                        </div>
                                        
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Card  -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <?php 
                                
                                $sql1 = "SELECT * FROM child WHERE child_registerStatus='ACCEPT'";
                                $result1 = mysqli_query($conn, $sql1);
                                $countChild = mysqli_num_rows( $result1 );
                            ?>
                            <a href="child_list.php"  class="card card-link shadow h-100 py-2" style="border-left-color:#EF597B; border-left-width:4px ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#EF597B;">
                                                Total Registered Children</div>
                                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $countChild?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-child fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        

                        <!-- Card  -->
                        <div class="col-xl-3 col-md-6 mb-4 ">
                            <?php 
                                
                                $sql2 = "SELECT * FROM attendance WHERE attendance_status='PRESENT' AND attendance_date = CURRENT_DATE";
                                $result2 = mysqli_query($conn, $sql2);
                                $countAttendance = mysqli_num_rows( $result2 );
                            ?>
                            <a href="child_attendance.php"  class="card card-link shadow h-100 py-2" style="border-left-color:#FFCB18; border-left-width:4px ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#FFCB18;">Total attendance (<?php echo date('d F'); ?>)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format(($countAttendance/$countChild)*100,1) ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width:<?php echo ($countAttendance/$countChild)*100 ?>%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                       
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div  class="col-md-7 d-flex ">
                            <div class="card shadow mb-4 flex-fill">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-secondary">Attendance</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                
                                <div class="card-body">
                                <h5><b>Total Present Children</b></h5>
                                    <div class="chart-area mb-3" >
                                        <canvas id="myAreaChart" ></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <!-- Pie Chart -->
                        <div class="col-md-5 d-flex">
                            <div class="card shadow mb-4  flex-fill">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-secondary">Total Child per Group</h6>
                                    <
                                </div>
                                <!-- Card Body -->
                                <div class="card-body ">
                                    <div class="chart-pie mb-3">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <!-- Illustrations -->
                
                        

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