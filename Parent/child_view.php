<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Child-View</title>
    
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


    
.img-section{
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;


}
  
  #display-image, #display-image-mother{
	
	height:220; width: 250px; 
	border: 1px solid #B4B9BC;
	background-position: center;
	background-size: cover;
	object-fit: cover;
	border-radius: 2%;
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


            <li class="nav-item active ">
                <a class="nav-link" href="children.php">
                <i class="fa-solid fa-chalkboard-user" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Children</span></a>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item  " >
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
                      $group = $conn->query("SELECT * from child_group ");
                        $child = $conn->query("SELECT DISTINCT  *  from 
                        child c 
                        JOIN parent p ON c.parent_id = p.parent_id
                        JOIN emergency_contact g ON c.child_id = g.child_id
                        WHERE c.child_id='".$_GET['id']."'");

                        $attendance=$conn->query("SELECT DISTINCT  *, DATE_FORMAT(attendance_date,'%d %b %Y') AS attendance_date1 , a.attendance_id from
                        attendance a 
                        JOIN child c ON c.child_id = a.child_id
                        LEFT OUTER JOIN pickup p ON (a.attendance_id=p.attendance_id)
                        WHERE c.child_id='".$_GET['id']."'");

                        $fee=$conn->query("SELECT * , f.fee_id,f.fee_amount, DATE_FORMAT(fee_date,'%M') AS fee_date1 , payment_id from 
                        fee f
                        LEFT OUTER JOIN payment p ON ( f.fee_id=p.fee_id)
                        JOIN  child c ON c.child_id = f.child_id
                        WHERE c.child_id='".$_GET['id']."'");

                        $detail= mysqli_fetch_assoc($child);

                        
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

                        <div class="d-sm-flex align-items-center  mb-4">
                            <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="children.php">Child List</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $detail['child_name'] ?></li>
                            </ol>
                            </nav>
                        </div>
                          <!--card-->
                        <div class="card shadow mb-4 ">
                            

                            <div class="card-body">

                                <div class="nav nav-pills nav-fill" id="v-pills-tab" role="tablist">
                                    <a class="nav-link active " id="v-pills-child-tab" data-toggle="pill" href="#v-pills-child" role="tab" aria-controls="v-pills-child" aria-selected="true">Child's Details</a>
                                    <a class="nav-link" id="v-pills-attendance-tab" data-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="false">Attendance</a>
                                    <a class="nav-link" id="v-pills-messages-fee" data-toggle="pill" href="#v-pills-fee" role="tab" aria-controls="v-pills-fee" aria-selected="false">Fee</a>
                                </div>

                                <div class="tab-content  pt-3" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-child" role="tabpanel" aria-labelledby="v-pills-child-tab">
                                        <form action="handler/child_handler.php" method="POST" enctype="multipart/form-data">    
                                            <div class="card  mb-4 ">

                                                <div class="card-body row m-3">
                                                    <div class=" col-md-12 text-center  mb-5 img-section ">

                                                        <div class="">
                                                      
                                                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($detail['child_image']); ?>" class="rounded  d-block ml-4 mb-3" alt="..." width="200">

                                                      
                                                            <div class=" custom-file mt-2 ">
                                                                        <input type="file" class=" image-input custom-file-input" name="child_img" id="inputGroupFile04" accept="image/jpeg, image/png, image/jpg" style="width: 250px;" >
                                                                        <label class="custom-file-label text-left" for="inputGroupFile04">Choose file</label>
                                                                        <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p>  
                                                            </div>
                                                               
                                                        </div>
                                                    </div>

                                                    <!--Child part-->
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="child_id" value="<?php echo $detail['child_id']?>">
                                                        <input type="hidden" name="update" value="<?php echo $detail['child_id']?>">

                                                        <label for="child_name" class="form-label">Full Name</label>
                                                        <input name="child_name" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['child_name'] : '' ?>" id="child_name">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="child_myKidNum" class="form-label ">MyKid Number</label>
                                                        <input name="child_mykid" type="text" class="form-control" value="<?php echo isset($detail['child_id']) ? $detail['child_myKidNum'] : '' ?>" id="child_myKidNum" disabled>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label mt-3">Session </label>
                                                        <input name="session" type="number" class="form-control " id="session" value="<?php echo isset($detail['child_id']) ? $detail['renew_register'] : '' ?>"  <?php echo $detail['renew_register']==date('Y') ? 'disabled' : '' ?> >
                                                        <p style="font-size: 12px;"><i>Change the date if you want to register the children for the next session</i></p>
                                                    </div>

                                                    <fieldset class="col-md-6" disabled>
                                                        <label for="inputPassword4" class="form-label mt-3">Group</label>
                                                        <select id="group_id"  class="form-control" name="child_group" >
                                                        <option >Select</option>
                                                        <?php while($row1=$group->fetch_assoc()): ?>
                                                        <option value="<?php echo $row1['group_id'] ?>" <?php echo $detail['group_id']== $row1['group_id']? 'selected':'' ?>><?php echo $row1['group_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        </select>
                                                    </fieldset>

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

                                                    





                                                    <!--Health part-->
                                                    <div class="col-md-12 mt-5">
                                                        <h5 class="text-dark "><b>Health's Detail</b></h5>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="health_problem" class="form-label mt-3 ">Health Problem</label>
                                                        <select id="child_health" class="form-control" name="child_health"  >
                                                                <option selected disabled>Select</option>
                                                                <option value="Yes" <?php echo $detail['health_problem']!='No'?'Selected':'' ;?> >Yes</option>
                                                                <option value="No" <?php echo $detail['health_problem']=='No'?'Selected':'' ;?>  >No</option>
                                                        </select>                             
                                                    </div>

                                                    <?php  if( $detail['health_problem']!='No' ):?>  

                                                        <div class="col-md-12">
                                                            <label for="health_problem" class="form-label mt-3 ">Type of health problem</label>
                                                            <textarea name="health_allergic_exp" class="form-control" id="" cols="100" rows="5"><?php echo $detail['health_type'];?></textarea>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="health_problem" class="form-label mt-3 ">Document from Hospital</label>
                                                                <div class="custom-file">
                                                                <input name="health_allergic_doc" type="file" class="custom-file-input" id="inputGroupFile04" name="pdf_mykid"  accept="application/pdf" >
                                                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                                </div>
                                                                <p style="font-size:14px"><i>*File must be in pdf format</i></p>  
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
                                                    
                                                </div>

                                            
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
                                        <div class="card  mb-4 ">
                                          
                                               
                                            
                                            <div class="card-body">
                                                
                                               
                                                <div class="table-responsive">
                                                    <table class="table table-bordered display" id="dataTable2" width="100%" cellspacing="0">
                                                        <thead>
                                                            <tr class="thead-light">
                                                                <th class="col-2"># </th>
                                                                <th >Date</th>
                                                                <th class="col-2">Arrival Time</th>
                                                                <th class="col-2">Pick up Time</th>
                                                                <th class="col-1 text-center">Status</th>
                                                                <th class="col-1 text-center">Pick Up</th>
                                                                
                                                            </tr>
                                                        </thead>

                                                        


                                                        <tbody>
                                                       <?php  
                                                       $number=1;
                                                       while($row1=$attendance->fetch_assoc()): ?>
                                                            <tr>

                                                                <td><?php echo $number ?></td>

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

                                                                <td class="col-2 ">
                                                                    <?php if(isset($row1['pickup_id'])):?>

                                                                        <button class="btn btn-outline-primary" href="#" data-toggle="modal" data-target=<?php  echo isset($row1['pickup_id']) ? "#setPickUpModal".$row1['pickup_id']:'' ?> ><a>Pick Up</a></button>
                                                                        <!-- attendance Modal-->
                                                                        <?php include "attendance_modal.php"; ?>


                                                                    <?php endif;?>
                                                                </td>

                                                               

                                                            </tr>
                                                        <?php 
                                                            $number++;
                                                            endwhile; 
                                                            ?>
                                                        
                                                        

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
                                                    <table class="table table-bordered display" id="dataTable3" width="100%" cellspacing="0">
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
                                                       <?php  $num=1;
                                                       while($row2=$fee->fetch_assoc()): ?>
                                                            <tr>

                                                                <td><?php echo $num?></td>

                                                                <td><?php echo $row2['fee_date1'] ?></td>
                                                                

                                                                <td>
                                                                    <p><?php echo $row2['fee_desc'] ?></p>
                                                                </td>

                                                                <td>
                                                                    <p> RM <?php echo number_format($row2['fee_amount'],2) ?></p>
                                                                </td>

                                                                <td>
                                                                    <?php if($row2['fee_status'] == 'UNPAID'): ?>
                                                                    <span class="font-weight-bold"><p class="text-danger text-center">UNPAID</p></span>
                                                                    <?php elseif($row2['fee_status'] == 'PAID'): ?>
                                                                    <span class="font-weight-bold"><p class="text-success text-center">PAID</p></span>
                                                                    <?php endif; ?>
                                                                </td>

                                                                <td class="text-center">
                                                                    <a class='btn btn-outline-secondary' target="_blank" type='button' href=<?php echo $row2['fee_status'] == 'PAID'? 'pdf_receipt.php?id='.$row2['payment_id']:'pdf_generator.php?id='.$row2['fee_id']  ?>> <?php echo $row2['fee_status'] == 'PAID'? 'Receipt':'Invoice'?></a>
                                                                </td>
                                                               

                                                            </tr>
                                                        <?php $num++;
                                                    endwhile; ?>
                                                        
                                                        

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
        document.getElementById('session').addEventListener('change', function() {
        
                document.getElementById('group_id').disabled = false;
            
            });
       
        $(document).ready(function() {
        $('#dataTable2').DataTable();



        } );

        $(document).ready(function() {
        $('#dataTable3').DataTable();



        } );
      </script>

  
</body>
</html>