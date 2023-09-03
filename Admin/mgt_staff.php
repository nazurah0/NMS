<html lang="en">
<?php
        
        include('../db_connect.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Management - Staff</title>

    
    <?php include "header.php";
        
        if($_SESSION['signin']!=1){
            header('location:../index.php');}
    
    ?>
    

</head>
<body id="page-top">


     <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3bb78f;
background-image: linear-gradient(315deg, #3bb78f 0%, #0bab64 74%);">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand  align-items-center justify-content-center mb-3" href="dashboard.php">
            <div class="sidebar-brand-icon ">
            <img class="mb-2" src="../image/logo1.png" width="80"style="-webkit-filter: drop-shadow(5px 5px 5px #666666);
                    filter: drop-shadow(5px 5px 5px #666666);" alt="">
            </div>
            
</a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item  ">
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
                         <?php 
                            $register = $conn->query("SELECT * from 
                            staff s
                            JOIN  user u ON u.user_id = s.staff_id
                            order by staff_id asc");
                         ?>

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                         <h1 class="h3 mb-0 text-gray-800">Staff</h1>
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

                        <!--Table-->
                        <div class="row g-2">
                            <div class="col-md-4">
                            <form action="handler/mgt_staff_handler.php" method="POST" id="manage-staff">
                                <div class="card shadow mb-4 ">
                                        <div class="card-header py-3 ">

                                            <h6 class="font-weight-bold d-inline  ">Create New Staff</h6>

                        
                                        </div>
                                        

                                        <div class="card-body">

                                                <div class="col-md-12">
                                                    
                                                    <input type="hidden" class="form-control " id="inputEmail4" name="staff_ID" autocomplete="off" >
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="inputEmail4" class="form-label">Name</label>
                                                    <input type="text" class="form-control " id="inputEmail4" name="staff_name" required="true" required>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="inputPassword4" class="form-label mt-3 ">Role</label>
                                                    <input type="text" class="form-control" id="inputPassword4" name="staff_role" required="true" required>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="inputPassword4" class="form-label mt-3">Username</label>
                                                    <input type="text" class="form-control" id="inputPassword4" name="staff_username" required="true" required>                                            </div>

                                               

                                        
                                    
                                        </div>

                                        <div class="card-footer text-center">
                                            <button class="btn btn-success" type="submit" >Save</button>
                                            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"  
                                            onclick="$('#manage-staff').get(0).reset()">Cancel</button>
                                        </div>
                                    
                                        
                                    
                                </div>
                                </form>
                            </div>

                            <div class="col-md-8"> 
                                <div class="card shadow mb-4 ">
                                    <div class="card-header py-3 ">

                                        <h6 class="font-weight-bold d-inline  ">Staff List</h6>

                    
                                    </div>

                                    <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="thead-light">
                                                    <th class="col-2">Staff ID</th>
                                                    <th class="col-3">Name</th>
                                                    <th class="col-2">Role</th>
                                                    <th class="col-2">Username</th>
                                                    <th class="col-3">Action</th>
                                                </tr>
                                            </thead>

                                            


                                            <tbody>
                                                <?php while($row=$register->fetch_assoc()):?>
                                                <tr>
                                                <td><?php echo $row['staff_id'] ?></td>
                                                    <td><?php echo $row['staff_name'] ?></td>
                                                    <td><?php echo $row['user_type'] ?></td>
                                                    <td><?php echo $row['username'] ?></td>
                                                    <td>
                                                        <button class="btn btn-primary editBtn" type="submit" 
                                                        data-id="<?php echo $row['staff_id'] ?>" 
                                                        data-name="<?php echo $row['staff_name'] ?>"
                                                        data-role="<?php echo $row['user_type'] ?>"
                                                        data-username="<?php echo $row['username'] ?>">Edit</button>
                                                        <button class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteModal<?php echo $row['staff_id'] ?>"><a>Delete</a></button>
                                                        <?php include "delete_modal.php"; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            
                                                endwhile;   
                                            
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
       
    <?php include "script.php"; ?>

      

   
    <script>
        $('.editBtn').click(function() {

            var cat = $('#manage-staff')
            cat.get(0).reset()
            cat.find("[name='staff_ID']").val($(this).attr('data-id'))
            cat.find("[name='staff_name']").val($(this).attr('data-name'))
            cat.find("[name='staff_role']").val($(this).attr('data-role'))
            cat.find("[name='staff_username']").val($(this).attr('data-username'))

        })
        
       

    </script>
      


    
</body>
</html>