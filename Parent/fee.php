<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Fee</title>
    
    <?php 
        session_start();
        include "header.php";
        include('../db_connect.php');
        if($_SESSION['signin']!='1'){
            header('location:../index.php');
        }
        ?>
     
 
  
</head>
<style>
    a.nav-link{
        color: gray;
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


            <li class="nav-item ">
                <a class="nav-link" href="children.php">
                <i class="fa-solid fa-chalkboard-user" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Children</span></a>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item active " >
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
                <div >
                           
                           <?php 
                           if(@$_GET['success']==true){
                           ?>
                               <div class="alert alert-success  block  alert-dismissible" >
                                
                                       <button type="button" class="close mt-3" data-dismiss="alert">&times;</button>

                                       <div>
                                       <p class="text-justify  mt-3 text-xl-left"><i class="fa-solid fa-circle-info"></i> <b>Success! </b><?php echo $_GET['success']?></p>
                                       </div>
                               </div>
                           <?php }
                           
                            else if(@$_GET['info']==true)
                            {
                            ?>
                                <div class="alert alert-info  block  alert-dismissible" >
                                 
                                        <button type="button" class="close mt-3" data-dismiss="alert">&times;</button>

                                        <div>
                                        <p class="text-justify  mt-3 text-xl-left"><i class="fa-solid fa-circle-info"></i> <?php echo $_GET['info']?></p>
                                        </div>
                                </div>
                            <?php }?>
                   </div>

                        <div class="card shadow mb-4 ">
                            <div class="card-body">
                                 <?php 
                                    $parent_id=$_SESSION['id'];
                                    $child=$conn->query("SELECT * FROM child WHERE parent_id=$parent_id AND child_registerStatus IN('ACCEPT','WAITING') ")
                                ?>
                                 
                                    <div class="form-inline">
                                        <label class="pr-2">Name </label>

                                        <select class="form-control" id="child-id">
                                            <option value=0>Select Name</option>
                                           <?php  while($row1=$child->fetch_assoc()): ?>
                                            <option value='<?php echo $row1['child_id']; ?>' <?php echo  isset($_GET['child_id']) ? $row1['child_id'] == $_GET['child_id'] ? 'selected':'':''?>>
                                                <?php echo $row1['child_name'] ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>

                                        

                                    </div>
                               
                            </div>
                        </div>

                        <div class="card shadow mb-4 " >
                            
                                <div class="card-body">
                                    <div class="container-fee">
                        
                                        <div  style='height:400px'>
                                            <div class="my-2 text-center" style="padding-top:70px; opacity: 0.5;">
                                                <h1 class="my-4">
                                                    <lord-icon
                                                        src="https://cdn.lordicon.com/pvbutfdk.json"
                                                        trigger="loop"
                                                        style="width:auto;height:60px">
                                                    </lord-icon>
                                                </h1>
                                                        <h4> <b>Please select the children name first </b></h4>       
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

<script type="text/javascript">
        $(document).ready(function() {
    $('#dataTable5').DataTable();
  

    
} );



     $(document).ready(function(){
                    $("#child-id").on('change',function(){
                        var value = $(this).val();
                        //alert(value);

                        $.ajax({
                            url:"ajax/fetch-fee.php",
                            type:"POST",
                            data: 'child_id='+value,
                            success:function(data){
                                $(".container-fee").html(data);
                            }
                        });
                    });
                });
        
</script>



  
</body>
</html>