
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Home</title>
    
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
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h6 class="h5 mb-0 text-gray-800 font-weight-light"> <b> Welcome <?php echo $_SESSION['username'] ?></b> &#128516;</h6>
                        </div>

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
                         
                        <div class="row">

                            <!-- Card  -->
                            <div class="col-xl-6 mb-4">
                                <?php 
                                    $parent_id=$_SESSION['id'];
                                    $sql2 = "SELECT * FROM child WHERE parent_id=$parent_id AND child_registerStatus='ACCEPT'";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $countChild = mysqli_num_rows( $result2 );
                                ?>
                                <div class="card  shadow h-100 py-2 " >
                                    <div class="card-body ">
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
                                </div>
                            </div>

                            <div class="col-xl-6 mb-4">
                                <?php 
                                    $parent_id=$_SESSION['id'];
                                    $sql2 = "SELECT * FROM child c JOIN fee f ON c.child_id = f.child_id WHERE c.parent_id=$parent_id AND f.fee_status='UNPAID' ";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $countfee = mysqli_num_rows( $result2 );
                                ?>
                                <div class="card  shadow h-100 py-2 " >
                                    <div class="card-body ">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#F8D210">
                                                    Unpaid Fee</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $countfee?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-child fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 d-flex">

                                <?php 
                                    $parent_id=$_SESSION['id'];
                                    $new_attend = $conn->query("SELECT * FROM 
                                    attendance a
                                    JOIN  child c ON a.child_id = c.child_id
                                    JOIN  parent p ON p.parent_id = c.parent_id
                                    WHERE p.parent_id=$parent_id AND attendance_date= CURRENT_DATE()");
                                    
                                ?>   

                                <div class="card shadow mb-4  flex-fill">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-secondary ">Today Attendance</h6>
                                        
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <h4 class="pb-3"><b><?php echo date('d F'); ?></b></h4>
                                        <div class="mb-3">
                                            <table class="table">
                                                <tbody>
                                                    <?php                                                     
                                                        while($row=$new_attend->fetch_assoc()): 
                                                    
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['child_name'] ?></td>
                                                        <td> <a class="btn btn-secondary" href="attendance_view.php?attendance_id=<?php echo $row['attendance_id'] ?>"> View</a></td>
                                                    </tr>
                                                    <?php 
                                                        endwhile;
                                                        
                                                        if(mysqli_num_rows( $new_attend )== 0){
                                                            echo "<p class='text-center my-5'>No Attendance</p>";
                                                        }
                                                        
                                                    
                                                    ?>
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 d-flex">
                                <?php 

                                    $child = $conn->query("SELECT * FROM 
                                    child 
                                    WHERE parent_id=$parent_id AND child_registerStatus != 'ACCEPT'");
                                    
                                ?>                            
                                <div class="card shadow mb-4  flex-fill">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-secondary ">Waiting List</h6>
                                        
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <div class="mb-3">
                                        
                                            <table class="table"  cellspacing="0" cellpadding="0" style="border:none;">
                                                <tbody >
                                                    <?php                                                     
                                                        while($row1=$child->fetch_assoc()): 
                                                    
                                                    ?>
                                                    <tr >
                                                        <td class="col-10" style="border:none;" > <?php echo $row1['child_name'] ?> </td>
                                                        <td class="col-10" style="border:none;" > 
                                                        <?php 
                                                        if($row1['child_registerStatus']=='WAITING'){
                                                            echo "<h6 class='text-info'><b>Waiting</b></h6>";
                                                        } 
                                                        else if($row1['child_registerStatus']=='REJECT'){
                                                            echo "<h6 class='text-danger'><b>Rejected</b></h6>";
                                                        }
                                                        ?> 
                                                        </td>
                                                        <td class="pt-1"style="border:none;"> 
                                                            <button class="btn btn-secondary" href="#" data-toggle="modal" data-target="#waitingModal<?php echo isset($row1['child_id'])? $row1['child_id']:'' ?>"> View</button>
                                                            <?php include "waiting_list.php"; ?>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                        endwhile;
                                                        
                                                        if(mysqli_num_rows( $child )== 0){
                                                            echo "<p class='text-center my-5'>No waiting list</p>";
                                                        }
                                                        
                                                    ?>
                                                </tbody>
                                            </table>
                                            
                                                
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


  
</body>
</html>