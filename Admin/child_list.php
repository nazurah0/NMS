<html lang="en">
<?php
        
        include('../db_connect.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Children - List</title>

    
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
            <a class="collapse-item " href="rejected_register.php">Rejected Registration</a>
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
<li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-child"></i>
        <span>Children</span>
    </a>
    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
           
            <a class="collapse-item active" href="child_list.php">List</a>
            <a class="collapse-item" href="child_attendance.php">Attendance</a>

        </div>
    </div>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item ">
    <a class="nav-link" href="parents.php">
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
    <a class="nav-link" href="mgt_group.php">
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
                         $i=1;
                        $register = $conn->query("SELECT * from 
                        child c 
                        JOIN child_group g ON c.group_id = g.group_id
                        JOIN parent p ON c.parent_id = p.parent_id
                        JOIN emergency_contact e ON c.child_id = e.child_id
                        WHERE c.child_registerStatus = 'ACCEPT' 
                        order by c.child_id asc");

                        
                        ?> 

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                         <h1 class="h3 mb-0 text-gray-800">List of Children </h1>
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

                        <!--card-->
                        <div class="card shadow mb-4 ">
                            

                            <div class="card-body">
                             
                                
                             <div class="table-responsive">
                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="thead-light">
                                            <th class="col-1">#</th>
                                            <th class="col-2">Image</th>
                                            <th class="col-4">Name</th>
                                            
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </thead>

                                    


                                    <tbody >
                                    <?php while($row=$register->fetch_assoc()): ?>
                                                
                                        

                                        <tr >
                                            <td class="align-middle"><?php echo $i; ?></td>
                                            <td> <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['child_image']); ?>" class='rounded mx-auto d-block mb-3' alt='...' width='200'></td>
                                            <td class="align-middle">
                                                <h6 class="font-weight-bold mb-3"><?php echo $row['child_name'] ?></h6>
                                                <div >
                                                    <p ><b>Age: </b><?php echo $row['child_age'] ?></p>
                                                    <p><b>Group: </b><?php echo $row['group_name'] ?></p>
                                                </div>  
                                            </td>
                                           
                                            <td class="align-middle">
                                                 <div>

                                                    <a class="btn btn-primary viewbtn"   href="child_details.php?id=<?php echo $row['child_id'] ?>"> View</a>


                                               
                                                    
                                                </div>

                                            </td>
                                        </tr>
                                        
                                        
                                        <?php $i++;endwhile; ?>

                                    </tbody>
                                </table>
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