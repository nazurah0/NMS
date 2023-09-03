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

<style>
    a.nav-link{
        color: gray;
    }
    .form-label{
        font-weight: bold;
    }
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
                        $group = $conn->query("SELECT * from child_group ");
                        $child = $conn->query("SELECT DISTINCT  *  from 
                        child c 
                       JOIN parent p ON c.parent_id = p.parent_id
                        JOIN emergency_contact g ON c.child_id = g.child_id
                        WHERE c.child_id='".$_GET['id']."'");

                        $attendance=$conn->query("SELECT DISTINCT  *, DATE_FORMAT(attendance_date,'%d %b %Y') AS attendance_date1 , a.attendance_id from
                        attendance a 
                        JOIN child c ON c.child_id = a.child_id
                        WHERE c.child_id='".$_GET['id']."'");

                        $fee=$conn->query("SELECT * , DATE_FORMAT(fee_date,'%M') AS fee_date1 from 
                        fee f
                        JOIN  child c ON c.child_id = f.child_id
                        WHERE c.child_id='".$_GET['id']."'");

                        $detail= mysqli_fetch_assoc($child);

                        
                        ?> 

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center  mb-4">
                            <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="child_list.php">Child List</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $detail['child_name'] ?></li>
                            </ol>
                            </nav>
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

                                <div class="nav nav-pills nav-fill" id="v-pills-tab" role="tablist">
                                    <a class="nav-link active " id="v-pills-child-tab" data-toggle="pill" href="#v-pills-child" role="tab" aria-controls="v-pills-child" aria-selected="true">Child's Details</a>
                                    <a class="nav-link " id="v-pills-parent-tab" data-toggle="pill" href="#v-pills-parent" role="tab" aria-controls="v-pills-parent" aria-selected="false">Parent's Details</a>
                                    <a class="nav-link" id="v-pills-attendance-tab" data-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="false">Attendance</a>
                                    <a class="nav-link" id="v-pills-messages-fee" data-toggle="pill" href="#v-pills-fee" role="tab" aria-controls="v-pills-fee" aria-selected="false">Fee</a>
                                </div>

                                <div class="tab-content  pt-3" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-child" role="tabpanel" aria-labelledby="v-pills-child-tab">
                                        <form action="handler/child_handler.php" method="POST" enctype="multipart/form-data">    
                                            <div class="card  mb-4 ">
                                            
                                                    <div class="card-body detail row g-2 m-3">


                                                         <div class="col-md-12 text-center ">
                                                            <?php 
                                                            if (isset($detail['child_id'])){
                                                            ?>
                                                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($detail['child_image']); ?>" class="rounded mx-auto d-block mb-3" alt="..." width="200">
                                                            <?php }
                                                            
                                                            else{
                                                            ?>
                                                            <img src="../img/undraw_profile.svg" class="rounded mx-auto d-block mb-3" alt="..." width="200">
                                                            <?php }?>
                                                            <div class="text-center">

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mt-2 mb-4 mr-5 ">

                                                            <div class="detail row ">
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-4 ">
                                                                    <div class="custom-file mt-2 ">
                                                                        <input type="file" class=" image-input custom-file-input" name="child_img" id="inputGroupFile04" accept="image/jpeg, image/png, image/jpg" style="width: 250px;" >
                                                                        <label class="custom-file-label text-left" for="inputGroupFile04">Choose file</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4"></div>

                                                            </div>
                                                                

                                                        </div>

                                                

                                                        <!--Child part-->
                                                        <input name="update_child" type="hidden" class="form-control "  id="child_name">
                                                        <input name="child_id" type="hidden" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['child_id'] : '' ?>" id="child_name">


                                                        <div class="col-md-6">
                                                            <label for="child_name" class="form-label">Full Name</label>
                                                            <input name="child_name" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['child_name'] : '' ?>" id="child_name">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="child_myKidNum" class="form-label ">MyKid Number</label>
                                                            <input name="child_mykid" type="text" class="form-control" value="<?php echo isset($detail['child_id']) ? $detail['child_myKidNum'] : '' ?>" id="child_myKidNum">
                                                        </div>

                                                        <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label mt-3">Session </label>
                                                        <input name="session" type="number" class="form-control " id="session" value="<?php echo isset($detail['child_id']) ? $detail['renew_register'] : '' ?>"   >
                                                        <p style="font-size: 12px;"><i>Change the date if you want register the children for the next session</i></p>
                                                    </div>

                                                    <div class="col-md-6">
                                                            <label for="inputPassword4" class="form-label mt-3">Group</label>
                                                            <select id="group_id" name="group_id" class="form-control" >
                                                            <option >Select</option>
                                                            <?php while($row1=$group->fetch_assoc()): ?>
                                                            <option value="<?php echo $row1['group_id'] ?>" <?php echo $detail['group_id']== $row1['group_id']? 'selected':'' ?>><?php echo $row1['group_name'] ?></option>
                                                            <?php endwhile; ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="child_nickname" class="form-label mt-3">Nickname</label>
                                                            <input name="child_nickname" type="text" class="form-control" value="<?php echo isset($detail['child_id']) ? $detail['child_nickname'] : '' ?>" id="child_nickname">
                                                        </div>

                                                        <div class=" col-md-4" >
                                                            
                                                            <label for="child_gender" class="form-label mt-3">Gender</label>
                                                            <select id="child_gender" class="form-control" name="child_gender"  >
                                                                <option >Select</option>
                                                                <option value="MALE" <?php echo $detail['child_gender'] == "MALE" ?  'selected="selected"': '' ?>>Male</option>
                                                                <option value="FEMALE" <?php echo $detail['child_gender'] == "FEMALE" ?  'selected="selected"': '' ?>>Female</option>
                                                            </select>  
                                                        
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label for="child_age" class="form-label mt-3">Age</label>
                                                            <input name="child_age" type="number" min="1" max="4" class="form-control"  value="<?php echo isset($detail['child_id']) ? $detail['child_age'] : '' ?>" id="child_age">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="child_DOB" class="form-label mt-3">Date of Birth</label>
                                                            <input name="child_dob" type="date" class="form-control"  value="<?php echo isset($detail['child_id']) ? $detail['child_DOB'] : '' ?>" id="child_DOB">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="child_race" class="form-label mt-3">Race</label>
                                                            <select id="child_race" class="form-control" name="child_religion">
                                                                <option selected disabled>Select</option>
                                                                <option value="ISLAM" <?php echo $detail['child_religion'] == "ISLAM" ?  'selected="selected"': '' ?>>Islam</option>
                                                                <option value="CHRISTIAN" <?php echo $detail['child_religion'] == "CHRISTIAN" ?  'selected="selected"': '' ?>>Christian</option>
                                                                <option value="BUDDHA"<?php echo $detail['child_religion'] == "BUDDHA" ?  'selected="selected"': '' ?>>Buddha</option>
                                                                <option value="HINDU" <?php echo $detail['child_religion'] == "HINDU" ?  'selected="selected"': '' ?>>Hindu</option>
                                                                <option value="OTHER" <?php echo $detail['child_religion'] == "OTHER" ?  'selected="selected"': '' ?>>Other</option>

                                                            </select>
                                                        </div>


                                                        <div class="col-md-4">
                                                            <label for="child_race" class="form-label mt-3">Race</label>
                                                            <select id="child_race" class="form-control" name="child_race">
                                                                <option selected disabled>Select</option>
                                                                <option value="MALAY" <?php echo $detail['child_race'] == "MALAY" ?  'selected="selected"': '' ?>>Malay</option>
                                                                <option value="CHINESE" <?php echo $detail['child_race'] == "CHINESE" ?  'selected="selected"': '' ?>>Chinese</option>
                                                                <option value="INDIAN"<?php echo $detail['child_race'] == "INDIAN" ?  'selected="selected"': '' ?>>Indian</option>
                                                                <option value="OTHER" <?php echo $detail['child_race'] == "OTHER" ?  'selected="selected"': '' ?>>Other</option>
                                                            </select>
                                                        </div>


                                                        <div class="col-md-6 mt-3">

                                                            <label for="health_information" class="form-label mt-3">Attachment of MyKid</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                <input name="child_copy_mykid" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" accept="application/pdf"  >
                                                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                            </div> 
                                                            <div class="input-group-append">
                                                                <a class="btn btn-outline-secondary" target='_blank' href="handler/view.php?id=<?php echo $detail['child_id'] ?>&type=pdf_mukid"  id="inputGroupFileAddon04">View</a>
                                                            </div>
                                                            </div>
                                                                                                                    
                                                        </div>

                                                        <div class="col-md-6 mt-3">

                                                        <label for="health_information" class="form-label mt-3">Attachment of Birth Certificate </label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                <input name="child_copy_birth" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  accept="application/pdf"  >
                                                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                            </div> 
                                                            <div class="input-group-append">
                                                                <a class="btn btn-outline-secondary" target='_blank' href="handler/view.php?id=<?php echo $detail['child_id'] ?>&type=pdf_certificate"  id="inputGroupFileAddon04">View</a>
                                                            </div>
                                                            </div>
                                                            
                                                            
                                                        
                                                        </div>

                                                        <!--Health part-->
                                                        <div class="col-md-12 mt-5">
                                                            <h5 class="text-dark "><b>Health's Detail</b></h5>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="health_problem" class="form-label mt-3 ">Health Problem</label>
                                                            <select id="child_health" class="form-control" name="child_health"  >
                                                                    <option selected disabled>Select</option>
                                                                    <option value="Yes" <?php echo $detail['health_problem']=='Yes'?'Selected':'' ;?> >Yes</option>
                                                                    <option value="No" <?php echo $detail['health_problem']!='Yes'?'Selected':'' ;?>  >No</option>
                                                            </select>                             
                                                        </div>

                                                        <?php  if( $detail['health_problem']=='Yes' ):?>  

                                                            <div class="col-md-12">
                                                                <label for="health_problem" class="form-label mt-3 ">Type of health problem</label>
                                                                <textarea name="health_allergic_exp" class="form-control" id="" cols="100" rows="5"><?php echo $detail['health_type'];?></textarea>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="health_information" class="form-label mt-3">Document from Doc </label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                    <input name="health_allergic_doc" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"   accept="application/pdf"  >
                                                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                                </div> 
                                                                <div class="input-group-append">
                                                                    <a class="btn btn-outline-secondary" target='_blank' href="handler/view.php?id=<?php echo $detail['child_id']?>&type=health_proof"  id="inputGroupFileAddon04">View</a>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>


                                                                                    

                                                        <!--Emergency part-->
                                                        <div class="col-md-12 mt-5">
                                                            <h5 class="text-dark "><b>Emergency Contact's Detail</b></h5>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="contact_name" class="form-label mt-3">Contact Name</label>
                                                            <input name="contact_name" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['contact_name'] : '' ?>" id="contact_name">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="contact_phoneNum" class="form-label mt-3">Contact Number</label>
                                                            <input name="contact_phone" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['contact_phoneNum'] : '' ?>" id="contact_phoneNum">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="contact_relationship" class="form-label mt-3">Relationship with Children</label>
                                                            <input name="contact_relationship" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ?ucwords(strtolower ($detail['contact_relationship'])) : '' ?>"  id="contact_phoneNum">
                                                        </div>

                                                    </div>

                                                <div class="modal-footer bg-light">

                                                    <button class='btn btn-success ' type='submit' >Save</button>
                                                    <a class='btn btn-danger' type='button'  href='handler/child_handler.php?delete_all=<?php echo $detail['child_id']?>'>Delete</a>
         
                                                </div>

                                            
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-parent" role="tabpanel" aria-labelledby="v-pills-parent-tab">
                                        <form action="handler/child_handler.php" method="POST" enctype="multipart/form-data">    
                                            <div class="card  ">
                                            
                                                <div class="card-body detail row m-3 g-2">
                                                    
                                                   <!--parent part-->
                                                    <input name="update_parent" type="hidden" class="form-control "  >

                                                    <input name="parent_id" type="hidden" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['parent_id'] : '' ?>" >

                                                    <?php if($detail['father_IC']!=NULL):?>  

                                                    <div class="col-md-12 mt-3">
                                                        <h4 class="text-dark "><b>Father/Guardian's Detail</b></h4>
                                                    </div>


                                                 
                                                
                                                    <div class="col-md-6">
                                                        <label for="parent_name" class="form-label mt-3">Father/Guardian Name</label>
                                                        <input name="father_name" type="text" class="form-control "  value="<?php echo isset($detail['child_id']) ? $detail['father_name'] : '' ?>" id="father_name">
                                                    </div>

                                                    
                                                    <div class="col-md-6">
                                                        <label for="parent_IC" class="form-label mt-3">Father/Guardian Identity Card Number</label>
                                                        <input name="father_ic" type="text" class="form-control "  value="<?php echo isset($detail['child_id']) ? $detail['father_IC'] : '' ?>" id="father_IC">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="parent_phoneNum" class="form-label mt-3"> Father/Guardian Phone Number</label>
                                                        <input name="father_phone" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['father_phoneNum'] : '' ?>" id="father_phoneNum">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="parent_work" class="form-label mt-3">Father/Guardian Occupation</label>
                                                        <input name="father_work" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['father_work'] : '' ?>" id="father_work">
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <label for="parent_workAddress" class="form-label mt-3">Father/Guardian Work Address</label>
                                                        <input name="father_wAddress" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['father_workAddress'] : '' ?>" id="father_workAddress">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="health_information" class="form-label mt-3">Attachment of Father/Guardian's Identity Card</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                <input name="father_copy_ic" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"   accept="application/pdf"  >
                                                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                            </div> 
                                                            <div class="input-group-append">
                                                                <a class="btn btn-outline-secondary" target='_blank' href="handler/view.php?parent_id=<?php echo $detail['parent_id']?>&type=father_copy"  id="inputGroupFileAddon04">View</a>
                                                            </div>
                                                            </div>
                                                    </div>

                                                    <?php 
                                            
                                                    endif;

                                                    
                                                    ?>
                                                    <?php if($detail['mother_IC']!=NULL){?>  
                                                    
                                                    <div class="col-md-12 mt-5">
                                                        <h4 class="text-dark "><b>Mother's Detail</b></h4>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <label for="parent_name" class="form-label mt-3">Mother Name</label>
                                                        <input name="mother_name" type="text" class="form-control "  value="<?php echo isset($detail['child_id']) ? $detail['mother_name'] : '' ?>" id="mother_name">
                                                    </div>

                                                    
                                                    <div class="col-md-6">
                                                        <label for="parent_IC" class="form-label mt-3">Mother Identity Card Number</label>
                                                        <input name="mother_ic" type="text" class="form-control "  value="<?php echo isset($detail['child_id']) ? $detail['mother_IC'] : '' ?>" id="mother_IC">
                                                    </div>

                                                

                                                    <div class="col-md-6">
                                                        <label for="parent_phoneNum" class="form-label mt-3"> Mother Phone Number</label>
                                                        <input name="mother_phone" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['mother_phoneNum'] : '' ?>" id="mother_phoneNum">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="parent_work" class="form-label mt-3">Mother Occupation</label>
                                                        <input name="mother_work" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['mother_work'] : '' ?>" id="mother_work">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="parent_workAddress" class="form-label mt-3">Mother Work Address</label>
                                                        <input name="mother_wAddress" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['mother_workAddress'] : '' ?>" id="mother_workAddress">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="health_information" class="form-label mt-3">Attachment of Mother's Identity Card</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                <input name="mother_copy_ic" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"   accept="application/pdf"  >
                                                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                            </div> 
                                                            <div class="input-group-append">
                                                                <a class="btn btn-outline-secondary" target='_blank' href="handler/view.php?parent_id=<?php echo $detail['parent_id']?>&type=mother_copy"  id="inputGroupFileAddon04">View</a>
                                                            </div>
                                                            </div>
                                
                                                    
                                                    </div>

                                                    <?php 
                                        
                                                    }
                                                    ?>

                                                    <div class="col-md-12 mt-5">
                                                        <h5 class="text-dark "><b>Home Address's Detail</b></h5>
                                                    </div>
                                            
                                                    <div class="col-md-12">
                                                        <label for="parent_address" class="form-label mt-3 ">Address</label>
                                                        <input name="parent_address" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['parent_address'] : '' ?>" id="parent_address">
                                                    </div>

                                                
                                                    <div class="col-md-4">
                                                        <label for="parent_town" class="form-label mt-3">Town</label>
                                                        <input name="parent_town" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['parent_town'] : '' ?>" id="parent_town">
                                                    </div>

                                                    
                                                    <div class="col-md-4">
                                                        <label for="parent_postcode" class="form-label mt-3">Postcode</label>
                                                        <input name="parent_postcode" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['parent_postcode'] : '' ?>" id="parent_postcode">
                                                    </div>

                                                    
                                                    <div class="col-md-4">
                                                        <label for="parent_state" class="form-label mt-3">State</label>
                                                        <select id="parent_state" class="form-control" name="parent_state">
                                                            <option disabled selected>Select</option>
                                                            <option value="Johor" <?php echo $detail['parent_state']=='Johor' ? 'selected' : '' ?>>Johor</option>
                                                            <option value="Kedah" <?php echo $detail['parent_state']=='Kedah' ? 'selected' : '' ?> >Kedah</option>
                                                            <option value="Kelantan"  <?php echo $detail['parent_state']=='Kelantan' ? 'selected' : '' ?>>Kelantan</option>
                                                            <option value="Malacca"  <?php echo $detail['parent_state']=='Malacca' ? 'selected' : '' ?>>Malacca</option>
                                                            <option value="Negeri Sembilan"  <?php echo $detail['parent_state']=='Negeri Sembilan' ? 'selected' : '' ?>>Negeri Sembilan</option>
                                                            <option value="Pahang"  <?php echo $detail['parent_state']=='Pahang' ? 'selected' : '' ?>>Pahang</option>
                                                            <option value="Penang"  <?php echo $detail['parent_state']=='Penang' ? 'selected' : '' ?>>Penang</option>
                                                            <option value="Penang"  <?php echo $detail['parent_state']=='Penang' ? 'selected' : '' ?>>Perak</option>
                                                            <option value="Perlis"  <?php echo $detail['parent_state']=='Perlis' ? 'selected' : '' ?>>Perlis</option>
                                                            <option value="Sabah"  <?php echo $detail['parent_state']=='Sabah' ? 'selected' : '' ?>>Sabah</option>
                                                            <option value="Sarawak"  <?php echo $detail['parent_state']=='Sarawak' ? 'selected' : '' ?>>Sarawak</option>
                                                            <option value="Selangor" <?php echo $detail['parent_state']=='Selangor' ? 'selected' : '' ?>>Selangor</option>
                                                            <option value="Terengganu" <?php echo $detail['parent_state']=='Terengganu' ? 'selected' : '' ?>>Terengganu</option>
                                                            <option value="Kuala Lumpur"  <?php echo $detail['parent_state']=='Kuala Lumpur' ? 'selected' : '' ?>>Kuala Lumpur</option>
                                                            <option value="Labuan"  <?php echo $detail['parent_state']=='Labuan' ? 'selected' : '' ?>>Labuan</option>
                                                            <option value="Putrajaya"  <?php echo $detail['parent_state']=='Putrajaya' ? 'selected' : '' ?>>Putrajaya</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="parent_postcode" class="form-label mt-3">Email</label>
                                                        <input name="email" type="email" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['email'] : '' ?>" id="email">
                                                    </div>


                                                
                                                </div>
                                                
                                                <div class="modal-footer bg-light">

                                                        <button class='btn btn-success ' type='submit' >Save</button>
            
                                                </div>

                                        
                                            </div>
                                            </form>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
                                        <div class="card  mb-4 ">
                                          
                                               
                                            
                                            <div class="card-body">
                                                
                                               
                                                <div class="table-responsive">
                                                    <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                                                        <thead>
                                                            <tr class="thead-light">
                                                                <th class="col-2"># </th>
                                                                <th >Date</th>
                                                                <th class="col-2">Arrival Time</th>
                                                                <th class="col-2">Pick up Time</th>
                                                                <th class="col-1">Status</th>
                                                                <th class="text-center">Action</th>
                                                                
                                                            </tr>
                                                        </thead>

                                                        


                                                        <tbody>
                                                       <?php  while($row1=$attendance->fetch_assoc()): ?>
                                                            <tr>

                                                                <td><?php echo $row1['attendance_id'] ?></td>

                                                                <td><?php echo $row1['attendance_date1'] ?></td>
                                                                

                                                                <td>
                                                                    <p><?php echo $row1['attendance_pickupTime'] ?></p>
                                                                </td>
                                                                <td>
                                                                    <p> <?php echo $row1['attendance_pickupTime'] ?></p>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    if ($row1['attendance_status'] == "PRESENT") {
                                                                        echo "<span class='font-weight-bold'><p class='text-success text-center'>PRESENT</p></span>";}
                                                                    
                                                                        else{
                                                                        echo "<span class='font-weight-bold'><p class='text-danger text-center'>ABSENT</p></span>";}
                                                                    
                                                                        ?>
                                                                </td>

                                                                <td class="text-center">
                                                                <a class='btn btn-outline-secondary' type='button' href="child_attendance.php?name=<?php echo $row1['child_name'] ?>&attendance_date=<?php echo $row1['attendance_date'] ?>">View</a>
                                                                </td>
                                                               

                                                            </tr>
                                                        <?php endwhile; ?>
                                                        
                                                        

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-fee" role="tabpanel" aria-labelledby="v-pills-fee-tab">
                                        <div class="card  mb-4 ">
                                            <div class="card-body">
                                            <div class="table-responsive">
                                                    <table class="table table-bordered display" id="dataTable2" width="100%" cellspacing="0">
                                                        <thead>
                                                            <tr class="thead-light">
                                                                <th class="col-2"># </th>
                                                                <th >Date</th>
                                                                <th class="col-3">Description</th>
                                                                <th class="col-2">Amount</th>
                                                                <th class="col-1">Status</th>
                                                                <th class="text-center">Action</th>
                                                                
                                                            </tr>
                                                        </thead>

                                                        


                                                        <tbody>
                                                       <?php  while($row2=$fee->fetch_assoc()): ?>
                                                            <tr>

                                                                <td><?php echo $row2['fee_id'] ?></td>

                                                                <td><?php echo $row2['fee_date1'] ?></td>
                                                                

                                                                <td>
                                                                    <p><?php echo $row2['fee_desc'] ?></p>
                                                                </td>

                                                                <td>
                                                                    <p> <?php echo $row2['fee_amount'] ?></p>
                                                                </td>

                                                                <td>
                                                                    <?php if($row2['fee_status'] == 'UNPAID'): ?>
                                                                    <span class="font-weight-bold"><p class="text-danger text-center">UNPAID</p></span>
                                                                    <?php elseif($row2['fee_status'] == 'PAID'): ?>
                                                                    <span class="font-weight-bold"><p class="text-success text-center">PAID</p></span>
                                                                    <?php endif; ?>
                                                                </td>

                                                                <td class="text-center">
                                                                <a class='btn btn-outline-secondary' type='button' href="mgt_fee.php?name=<?php echo $row2['child_name'] ?>&fee_date=<?php echo $row2['fee_date'] ?>">View</a>
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
        $('#dataTable2').DataTable();



        } );
      </script>
     
      
      


    
</body>
</html>