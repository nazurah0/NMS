<html lang="en">
<?php
       
        
        
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/logo1.png" >
    <title>Register</title>

    
    <?php 
        session_start();
        include "header.php";
        include('../db_connect.php');
        if($_SESSION['signin']!='1'){
            header('location:../index.php');
        }
        ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

 
  
</head>

<style>
    
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
<script>
        $(document).ready(function() {
    var mykid =document.getElementById('mykid');
    var result = document.getElementById('dob');
    var result2 = document.getElementById('age');
    var result3 = document.getElementById('gender');
    $('#mykid').keyup(function(){
        var Year = mykid.value.toString().substr(0, 2);
        var Month = mykid.value.toString().substr(2, 2)
        var Day = mykid.value.toString().substr(4, 2)
        var dob = '20' + Year + '-' + Month + '-' + Day;
        result.value=dob
    });
    $('#mykid').keyup(function(){
        var birthdate = new Date(result.value);
         var cur = new Date();
         var diff = cur-birthdate;
         var age = Math.floor(diff/31536000000);
         result2.value = age;
    });

    $('#mykid').keyup(function(){
        var gender = mykid.value.toString().substr(11, 2);
        if(gender%2==0)
        result3.value = "FEMALE";
        else
        result3.value = "MALE";
    });
 });
</script>
<body id="page-top">


     <!-- Page Wrapper -->
<div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3bb78f;
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
            <li class="nav-item " >
                <a class="nav-link " href="home.php">
                <i class="fa-solid fa-house" style="font-size: 15px;"></i>
                <span style="font-size: 15px;">Home</span></a>
            </li>

            <li class="nav-item " >
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

                <!-- Begin Page Content -->
                <div class="container-fluid"> 
                    <?php 
                        $id=$_SESSION['id'];
                        $group = $conn->query("SELECT * from child_group "); 
                        $parent = $conn->query("SELECT * from 
                        parent  
                        WHERE parent_id= $id" );
                        foreach($parent->fetch_array() as $k => $val){
                            $$k=$val;
                        }
                        if(isset($_GET['child_id'])){
                        $child = $conn->query("SELECT DISTINCT  *  from 
                        child c 
                       JOIN parent p ON c.parent_id = p.parent_id
                        JOIN emergency_contact g ON c.child_id = g.child_id
                        WHERE c.child_id='".$_GET['child_id']."'");

                        $detail= mysqli_fetch_assoc($child);}
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
                    
                     <!-- Page Heading -->
                     <div class="text-center  pt-3 ">
                         <h1 class="h3 mb-0 text-gray-800 "><b>Child Registration <?php echo isset($detail['child_id']) ? '(Resubmit Form)': '' ?></b> </h1>
                        
                    </div>
                    <form action="handler/child_handler.php" method="POST" enctype="multipart/form-data">

                    <div class="card shadow my-4 mx-3 ">
                    <div class="card-body m-1">
                    <!-- Nested Row within Card Body -->
                    
                    <div class="p-3">

                        <div class="form-group row ">
                            <div class="col-md-12 mt-3">
                            
                                <h4 class="section-title"><b>Child's Detail</b></h4>
                                <h5 style="font-size:15px" class="text-danger"><i><b>(*) Required field</b></i></h5>  
                                <h5 style="font-size:15px" class="text-danger"><i><b><?php echo isset($detail['child_id']) ? 'Please reinsert image and copy of documents.': '' ?></b></i></h5>  
                            
                            </div>
                        </div>

                        <div class="ml-2 mr-2 mb-3 img-section ">
                            <div>
                                <div id="display-image"></div>
                                <div class="custom-file mt-2 ">

                                <input type="file" class="image-input custom-file-input" name="child_image" id="inputGroupFile04 image-input" accept="image/jpeg, image/png, image/jpg" style="width: 250px;" required>

                                <label class="custom-file-label text-left" for="inputGroupFile04">Choose file</label>
                                <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p>    

                            </div>
                        </div>

                        <div class="ml-2 mr-2">
                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label  mt-2" ><b>Name</b><b class="text-danger">*</b></label>
                                <input type="text" class="form-control" name="child_name"  value="<?php echo isset($detail['child_id']) ? $detail['child_name'] : '' ?>" id="child_name" required>

                               
                                <input type="hidden" class="form-control" name="register_status" value="<?php echo isset($detail['child_id']) ? $detail['child_registerStatus'] : '' ?>">
                                <input type="hidden" class="form-control" name="child_id" value="<?php echo isset($detail['child_id']) ? $detail['child_id'] : '' ?>">
                                     
                            </div>

                            <div class="row">
                            <div class="form-group col-md-6">
                                                            <label for="inputPassword4" class="form-label mt-3 "><b>Group</b><b class="text-danger">*</b></label>
                                                            <select id="group_id" name="group_id" class="form-control" name="child_group">
                                                            <option >Select</option>
                                                            <?php while($row1=$group->fetch_assoc()): ?>
                                                            <option value="<?php echo $row1['group_id'] ?>" <?php echo isset($detail['child_id']) ? $detail['group_id']== $row1['group_id']? 'selected':'' :'' ?>><?php echo $row1['group_name'] ?> (RM <?php echo number_format($row1['group_price'],2)  ?>)</option>
                                                            <?php endwhile; ?>
                                                            </select>
                                                        </div>

                                    <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class=" col-form-label  mt-2"><b>Session</b></label>

                                    <input  type="text" class="form-control" value="<?php echo date('Y')?>"  disabled >                                        


                                    </div>



                            </div>


                            <div class="row">

                                <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class=" col-form-label "><b>MyKid Num</b><b class="text-danger">*</b><i> (without '-' symbol e.g:190828011387)</i></label>
                                
                                    <input required type="text" class="form-control" id="mykid" name="child_mykid"  maxlength = "12" onkeypress="return isNumberKey(event)" value="<?php echo isset($detail['child_id']) ? $detail['child_myKidNum'] : '' ?>" id="child_myKidNum"  >                                        
                                    

                                </div>

                                <div class="form-group col-md-6  ">

                                    <label for="staticEmail" class=" col-form-label "><b>Nickname</b><b class="text-danger">*</b></label>
                                
                                    <input  type="text" class="form-control" name="child_nickname" value="<?php echo isset($detail['child_id']) ? $detail['child_nickname'] : '' ?>" id="child_nickname">                                        
                                

                                </div> 
                            
                            </div>

                            <div class="row">

                                <div class="form-group col-md-4 ">

                                    <label for="staticEmail" class=" col-form-label"><b>Age</b></label>
                                
                                    <input required type="number" min="1" max="4" class="form-control" name="child_age" id="age" value="<?php echo isset($detail['child_id']) ? $detail['child_age'] : '' ?>" id="child_age"  onkeypress="return isNumberKey(event)"  >                                        
                                    

                                </div>

                                <div class="form-group col-md-4  ">

                                    <label for="staticEmail" class=" col-form-label"><b>Date of Birth</b></label>
                                
                                    <input required type="date" class="form-control" name="child_dob" id="dob"   value="<?php echo isset($detail['child_id']) ? $detail['child_DOB'] : '' ?>" id="child_DOB" >                                        
                                

                                </div> 

                                <div class="form-group col-md-4 ">

                                    <label for="staticEmail" class=" col-form-label "><b>Gender</b></label>

                                        <select id="gender" class="form-control" name="child_gender" required  >
                                            <option >Select</option>
                                            <option value="MALE" <?php echo isset($detail['child_id']) ? $detail['child_gender'] == "MALE" ?  'selected="selected"': '' :''?>>Male</option>
                                            <option value="FEMALE" <?php echo isset($detail['child_id']) ? $detail['child_gender'] == "FEMALE" ?  'selected="selected"': '':'' ?>>Female</option>
                                        </select>                                       


                                </div> 

                            
                            </div>  
                            
                            <div class="row">

                                <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class=" col-form-label"><b>Religion</b></label>

                                    <select id="child_race" class="form-control" name="child_religion" >
                                        <option selected disabled>Select</option>
                                        <option value="ISLAM" <?php echo isset($detail['child_id']) ?$detail['child_religion'] == "ISLAM" ?  'selected="selected"': '':'' ?>>Islam</option>
                                        <option value="CHRISTIAN" <?php echo isset($detail['child_id']) ? $detail['child_religion'] == "CHRISTIAN" ?  'selected="selected"': '' :''?>>Christian</option>
                                        <option value="BUDDHA"<?php echo isset($detail['child_id']) ? $detail['child_religion'] == "BUDDHA" ?  'selected="selected"': '' :''?>>Buddha</option>
                                        <option value="HINDU" <?php echo isset($detail['child_id']) ? $detail['child_religion'] == "HINDU" ?  'selected="selected"': '':'' ?>>Hindu</option>
                                        <option value="OTHER" <?php echo isset($detail['child_id']) ? $detail['child_religion'] == "OTHER" ?  'selected="selected"': '' :'' ?>>Other</option>

                                    </select>                                     
                                    

                                </div>

                                <div class="form-group col-md-6  ">

                                    <label for="staticEmail" class=" col-form-label"><b>Race</b></label>
                                    <select id="child_race" class="form-control" name="child_race" >
                                        <option selected disabled>Select</option>
                                        <option value="MALAY" <?php echo isset($detail['child_id']) ?$detail['child_race'] == "MALAY" ?  'selected="selected"': '' :''?>>Malay</option>
                                        <option value="CHINESE" <?php echo isset($detail['child_id']) ?$detail['child_race'] == "CHINESE" ?  'selected="selected"': '':'' ?>>Chinese</option>
                                        <option value="INDIAN"<?php echo isset($detail['child_id']) ?$detail['child_race'] == "INDIAN" ?  'selected="selected"': '':'' ?>>Indian</option>
                                        <option value="OTHER" <?php echo isset($detail['child_id']) ?$detail['child_race'] == "OTHER" ?  'selected="selected"': '' :''?>>Other</option>
                                    </select>                                       


                                </div> 

                            

                            <div class="form-group col-md-6 mt-2  ">

                                <label for="staticEmail" class="form-label  " ><b>Attachment of MyKid</b><b class="text-danger">*</b></label>
                                <div class="custom-file">
                            <input name="child_copy_mykid" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"   accept="application/pdf"  required>
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>  
                            <p style="font-size:14px"><i>*File must be in pdf format</i></p>                                                                 
                                </div>

                            <div class="form-group col-md-6 mt-2 ">

                                <label for="staticEmail" class="form-label  " ><b>Attachment of Birth Certificate</b><b class="text-danger">*</b></label>

                                <div class="input-group">
                            <div class="custom-file">
                            <input name="child_copy_birth" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  accept="application/pdf" required >
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div> 
                            </div> 
                            <p style="font-size:14px"><i>*File must be in pdf format</i></p>                                                           
                            </div>

                        </div>

                        </div>
                      
                    </div>

                    <div class="pl-2 pr-5 pb-5">

                        <div class="form-group row">
                            <div class="col-md-12 mt-3">
                            
                                <h4 class="section-title"><b>Health's Detail</b></h4>
                        
                            
                            </div>
                        </div>

                        <div class="ml-2 mr-2">


                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label " ><b>Health Problem</b><b class="text-danger">*</b></label>
                               
                                <select id="child_health" class="form-control" name="child_health" required >
                                    <option selected disabled>Select</option>
                                    <option value="Yes" <?php echo isset($detail['child_id']) ?$detail['health_problem']=='Yes'?'Selected':'' :'';?> >Yes</option>
                                    <option value="No" <?php echo isset($detail['child_id']) ?$detail['health_problem']!='No'?'Selected':'':'' ;?>  >No</option>
                                </select>  

                            </div>

                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label " ><b>If Yes, please state the health problem</b></label>

                                <textarea name="health_allergic_exp" class="form-control" id="" cols="100" rows="5"><?php echo isset($detail['child_id']) ? $detail['health_type']:NULL;?></textarea>
                                                                
                            </div>

                            
                        <div class="form-group">
                        <label for="health_problem" class="form-label mt-3 ">Document from Hospital</label>
                            <div class="custom-file">
                            <input name="health_allergic_doc" type="file" class="custom-file-input" id="inputGroupFile04" name="pdf_mykid"  accept="application/pdf" >
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                            <p style="font-size:14px"><i>*File must be in pdf format</i></p> 
                        </div>

                            
                            

                        </div>
                        
                      
                    </div>

                    <div class="pl-2 pr-5 pb-5">

                        <div class="form-group row">
                            <div class="col-md-12 mt-3">
                            
                                <h4 class="section-title"><b>Emergency Contact</b></h4>
                        
                            
                            </div>
                        </div>

                        <div class="ml-2 mr-2">

                                 
                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label " ><b>Contact Name</b><b class="text-danger">*</b></label>                               
                                <input required name="contact_name" id="contact-name" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['contact_name'] : '' ?>" id="contact_name">
                                <div  id="contact_response" > </div>

 

                            </div>
                            
                            <div class="row">
                            
                                <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class="col-form-label  " ><b>Contact Phone Number</b><b class="text-danger">*</b> <i> (without '-' symbol e.g:0138794768)</i></label>

                                    <input required type="text" id="contact-pnum"class="form-control" maxlength="10" name="contact_phone" onkeypress="return isNumberKey(event)" value="<?php echo isset($detail['child_id']) ? $detail['contact_phoneNum'] : '' ?>">
                                    <div class="" id="contact_response1" ></div>
                                                                    
                                </div>

                                <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class="col-form-label" ><b>Contact Relationship with Child</b></label>

                                    <input  required type="text" class="form-control" name="contact_relationship" value="<?php echo isset($detail['child_id']) ?ucwords(strtolower ($detail['contact_relationship'])) : '' ?>" >
                                                                    
                                </div>                           
                            </div>

                        </div>
                      
                    </div>

                   

              

                            
                </div>
                            <div class=" card-footer text-right">
                                <button class='btn btn-success' type='submit' >Submit</button>
                            </div>

                       
                    </div>
                    </form>
                        

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

    <!-- Parent Modal-->
    <?php include "parent_modal.php"?>

    <!-- manage user  Modal-->
    <?php include "manage_user.php"; ?>


       

    <!-- Script-->
    <?php include "script.php"; ?>
    <!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>


    <script>
            function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
    const image_input = document.querySelector(".image-input");
    image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
    });
    reader.readAsDataURL(this.files[0]);
    });

$(document).ready(function(){

$("#contact-name").keyup(function(){

   var contact_name = $(this).val().trim();

   if(contact_name != ''){

      $.ajax({
         url: 'ajax/contact_check.php',
         type: 'post',
         data: {contact_name: contact_name},
         success: function(response){

             $('#contact_response').html(response);

          }
      });
   }else{
      $("#contact_response").html("");
   }

 });

 $("#contact-pnum").keyup(function(){

var contact_pnum = $(this).val().trim();

if(contact_pnum != ''){

   $.ajax({
      url: 'ajax/contact_check.php',
      type: 'post',
      data: {contact_pnum: contact_pnum},
      success: function(response1){

          $('#contact_response1').html(response1);

       }
   });
}else{
   $("#contact_response1").html("");
}

});

});


</script>
  
</body>
</html>