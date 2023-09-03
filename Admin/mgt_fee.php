<html lang="en">
<?php
        
        include('../db_connect.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Management - Fee</title>

    
    <?php include "header.php";
        
        if($_SESSION['signin']!=1){
            header('location:../index.php');}
    
    ?>
    




    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

</head>
<style>
    table.dataTable tr.dtrg-group td{background-color:#e0e0e0}table.dataTable tr.dtrg-group.dtrg-level-0 td{font-weight:bold}table.dataTable tr.dtrg-group.dtrg-level-1 td,table.dataTable tr.dtrg-group.dtrg-level-2 td,table.dataTable tr.dtrg-group.dtrg-level-3 td,table.dataTable tr.dtrg-group.dtrg-level-4 td,table.dataTable tr.dtrg-group.dtrg-level-5 td{background-color:#f0f0f0;padding-top:.25em;padding-bottom:.25em;padding-left:2em;font-size:.9em}table.dataTable tr.dtrg-group.dtrg-level-2 td{background-color:#f3f3f3;padding-left:2.5em}table.dataTable tr.dtrg-group.dtrg-level-3 td{background-color:#f3f3f3;padding-left:3em}table.dataTable tr.dtrg-group.dtrg-level-4 td{background-color:#f3f3f3;padding-left:3.5em}table.dataTable tr.dtrg-group.dtrg-level-5 td{background-color:#f3f3f3;padding-left:4em}
</style>
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
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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
        <li class="nav-item ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-child"></i>
                <span>Children</span>
            </a>
            <div id="collapsePages" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                
                    <a class="collapse-item" href="child_list.php">List</a>
                    <a class="collapse-item " href="child_attendance.php">Attendance</a>

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

        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-money-bill"></i>
                <span>Financial</span>
            </a>
            <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                
                    <a class="collapse-item active" href="mgt_fee.php">Fee</a>
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
                     $i=1;
                     $group = $conn->query("SELECT * from child_group ");
                         $year = date('Y');
                    
                        $fee= $conn->query("SELECT * , DATE_FORMAT(fee_date,'%M') AS fee_date1 ,f.fee_id,  month(fee_date) AS fee_date2 from 
                        child c 
                        JOIN child_group g ON c.group_id = g.group_id
                        JOIN fee f ON c.child_id = f.child_id
                        LEFT OUTER JOIN  parent m ON (m.parent_id=c.parent_id)
                        WHERE year(fee_date)= $year
                        order by f.fee_id asc");
                     
                    ?>  

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        
                        <h1 class="h3 mb-0 text-gray-800">Fee</h1>
                        <button type = "button" class=" btn btn-success text-right d-inline " href="#" data-toggle="modal" data-target="#setFeeModal">Set Fee</button>    
                            
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
                    <!-- Set fee Modal-->
                    <?php include "fee_modal.php"; ?>

                        

                    <!--Table-->
                    <div class="card shadow mb-4 ">
                        

                        <div class="card-body">
                        <form method="get" action="">
                                    <div class="form-inline">
                                        <label class="pr-2">Date </label>

                                        <select class="form-control" name="fee_date" id="select-date">
                                            <option value="0">All</option>

                                            <?php
                                            $month=date('Y');
                                            echo $month;
                                            $date = $conn->query("SELECT DISTINCT DATE_FORMAT(fee_date,'%M') AS fee_date1,  MONTH(fee_date) AS fee_date2  FROM fee   GROUP BY fee_date2, fee_date1");
                                            while($row1=$date->fetch_assoc()):
                                            ?>

                                            <option value='<?php echo $row1['fee_date2']; ?>' <?php echo  isset($_GET['fee_date']) ? $row1['fee_date2'] == $_GET['fee_date'] ? 'selected':'':''?>>
                                                <?php echo $row1['fee_date1'] ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>

                                    </div>
                        </form>

                            <div class="table-responsive">
                                <div class="container-fee">
                                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="thead-light">
                        
                                                <th class="col-1">#</th>
                                                <th class="col-1">Staff</th>
                                                <th class="col-1">Date</th>
                                                <th class="col-1">Group</th>
                                                <th class="col-1">Amount</th>
                                                <th class="col-3">Child</th>
                                                <th class="col-1">Status</th>
                                                <th class="col-2 ">Action</th>
                                            </tr>
                                        </thead>

                                    


                                        <tbody>
                                            <?php while($row=$fee->fetch_assoc()): ?>
                                            <tr >
                                            
                                                <td>
                                                    <?php echo $row['fee_id'] ?>
                                                    
                                                
                                                </td>
                                                <td><?php echo $row['staff_id'] ?></td>
                                                <td><?php echo $row['fee_date1'] ?></td>
                                                <td><?php echo $row['group_name'] ?></td>
                                                <td>RM <?php echo number_format($row['fee_amount'],2) ?></td>
                                                <td><?php echo $row['child_name'] ?></td>
                                                <td>
                                                    <?php if($row['fee_status'] == 'UNPAID' || $row['fee_status'] == 'WAITING'): ?>
                                                    <span class="font-weight-bold"><p class="text-danger text-center">UNPAID</p></span>
                                                    <?php elseif($row['fee_status'] == 'PAID'): ?>
                                                    <span class="font-weight-bold"><p class="text-success text-center">PAID</p></span>
                                                    <?php endif; ?>
                                                </td>
                                            
                                                
                        
                                                <td class=" text_center">
                                                    <button class="btn btn-primary " href="#" data-toggle="modal" data-target="#feeModal<?php echo $row['fee_id'] ?>"><a>View</a></button>
                                                    
                                                    <a  href="pdf_generator.php?id=<?php echo $row['fee_id'] ?>" target="_blank"><button class="btn btn-outline-primary" type="submit">Invoice</button></a>
                                                    <!-- Set fee Modal-->
                                                 
                                                    <?php include "fee_modal.php"; ?>
                                                    
                                                    
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        
                                        

                                        </tbody>
                                    </table>
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
      <script>
          
       

        $(document).ready(function() {
            $('#dataTable1').DataTable( {
                "search": {
                    "search": "<?php  echo  isset($_GET['name'])?$_GET['name']:''?>"
                },
                "columnDefs": [
                { "visible": false, "targets": [2,3] }
            ],

            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: [2]
            }
        });

        $("#select-date").on('change',function(){
                var date = $(this).val();
                

                //alert(value);

                $.ajax({
                    url:"ajax/fetch_fee.php",
                    type:"POST",
                    data: "request_date="+date,
                    success:function(data){
                        $('.container-fee').html(data);
                    }
                });


        });


    });

      </script>
     
      

  
      


    
</body>
</html>