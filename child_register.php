<?php 
    session_start();
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo1.png" >

    <title>Nursery Management System</title>

   
    <?php 
    
    include 'header.php';
    include('db_connect.php');
    ?>
   <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">  
    <link rel="stylesheet" href="css/style_wizard.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>



</head>
<style>
    body{
        font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";

    }
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

.title-tb {
 font-family: 'Fredoka One', cursive;
font-size: 30px; 
color:#EBEBE8;



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
<body >
<nav class="navbar navbar-expand-sm shadow " style="background-color:#188C5A">
    <div class="pull-right">
            <img src="image/logo1.png" width="80" class="mr-3">
        </div>
    <div class="ml-2 mt-3">
        


        <h5 class="title-tb" >Taska Ummi Sakiza</h5>
    </div>



    <ul class="navbar-nav ml-auto ">
    <li class="nav-item">
      <a class="btn btn-light" style="text-decoration:none;" href="Parent/handler/signout.php?signout"><i class="fa-solid fa-house"></i> Home</a>
    </li>
  </ul>




    </nav>
    


<section >


    <div class="container" >
        

        <div class="row align-items-center " style="padding-top:50px">
        <div class="text-center text-light pb-5"><h2><b>Child Registration</b></h2></div>
        <form class="user " action="child_register_handler.php" method="POST" enctype="multipart/form-data">
            <div class="card o-hidden border-0 shadow-lg  mb-5  ">

                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    
                    <div class="p-5">

                        <div class="form-group row ">
                            <div class="col-md-12 mt-3">
                            
                                <h4 class="section-title"><b>Child's Detail</b></h4>
                                <p style="font-size:15px" class="text-danger"><i><b>(*) Required field</b></i></p>  
                        
                            
                            </div>
                        </div>

                        <div class="ml-5 mr-2 mb-3 img-section ">
                            <div>
                                <div id="display-image"></div>
                                <input required type="file" class=" mt-2" name="child_image" id="image-input" accept="image/jpeg, image/png, image/jpg" style="width: 250px;">
                                <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p> 
                            </div>
                        </div>

                        <div class="ml-5 mr-2">
                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label " ><b >Name</b><b class="text-danger">*</b></label>
                               
                                <input required type="text" class="form-control" name="child_name" >
                                                                       
                            </div>
                            <div class=" form-group row">

                                    <div class="col-md-6 ">

                                        <label for="staticEmail" class=" col-form-label "><b>Group</b><b class="text-danger">*</b></label>
                                        <select id="group_id" name="group_id" class="form-control" required>
                                            <option selected>Select</option>
                                            <?php 
                                                $group = $conn->query("SELECT * from child_group ");
                                                while($row=$group->fetch_assoc()): ?>
                                            <option value="<?php echo $row['group_id'] ?>"><?php echo $row['group_name'] ?> (RM <?php echo number_format($row['group_price'],2)  ?>)</option>
                                            <?php endwhile; ?>
                                        </select>

                                    </div>  

                                    <div class="form-group col-md-6 ">

                                        <label for="staticEmail" class=" col-form-label"><b>Session</b></label>

                                        <input required type="text" class="form-control" value="<?php echo date('Y') ?>"   disabled  >                                        


                                    </div>
                            </div>                                    

                        

                            <div class="row">

                                <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class=" col-form-label "><b>MyKid Number</b><b class="text-danger">* </b> <i style="font-size:14px"> (without '-' symbol e.g:190828011387)</i></label>
                                
                                    <input required type="text" class="form-control" id="mykid" name="child_mykid"  maxlength = "12" onkeypress="return isNumberKey(event)"   >                                        
                                    

                                </div>

                                <div class="form-group col-md-6  ">

                                    <label for="staticEmail" class=" col-form-label "><b>Nickname</b><b class="text-danger">*</b></label>
                                
                                    <input required type="text" class="form-control" name="child_nickname" >                                        
                                

                                </div> 
                            
                            </div>

                            <div class="row">

                                <div class="form-group col-md-4 ">

                                    <label for="staticEmail" class=" col-form-label"><b>Age</b></label>
                                
                                    <input required type="number" min="1" max="4" class="form-control" name="child_age" id="age"  onkeypress="return isNumberKey(event)"  >                                        
                                    

                                </div>

                                <div class="form-group col-md-4  ">

                                    <label for="staticEmail" class=" col-form-label"><b>Date of Birth</b></label>
                                
                                    <input required type="date" class="form-control" name="child_dob" id="dob"   >                                        
                                

                                </div> 

                                <div class="form-group col-md-4 ">

                                    <label for="staticEmail" class=" col-form-label"><b>Gender</b></label>

                                    <select required id="gender" name="child_gender" class="form-control"  >
                                        <option >Select</option>
                                        <option value="MALE" >Male</option>
                                        <option value="FEMALE" >Female</option>
                                    </select>                                      


                                </div> 

                            
                            </div>  
                            
                            <div class="row">

                                <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class=" col-form-label"><b>Religion</b></label>

                                    <select id="child_race" class="form-control" name="child_religion" >
                                        <option selected disabled>Select</option>
                                        <option value="ISLAM" >Islam</option>
                                        <option value="CHRISTIAN">Christian</option>
                                        <option value="BUDDHA">Buddha</option>
                                        <option value="HINDU" >Hindu</option>
                                        <option value="OTHER" >Other</option>

                                    </select>                                       
                                    

                                </div>

                                <div class="form-group col-md-6  ">

                                    <label for="staticEmail" class=" col-form-label"><b>Race</b></label>

                                    <select id="child_race" class="form-control" name="child_race" >
                                        <option selected disabled>Select</option>
                                        <option value="MALAY" >Malay</option>
                                        <option value="CHINESE" >Chinese</option>
                                        <option value="INDIAN">Indian</option>
                                        <option value="OTHER" >Other</option>
                                    </select>                                       


                                </div> 

                            </div>

                            <div class="form-group mt-2  ">

                                <label for="staticEmail" class="col-form-label " ><b>Attachment of MyKid</b><b class="text-danger">*</b></label>

                                <input type="file" class="form-control" name="child_copy_mykid"  accept="application/pdf" required  >
                                <p style="font-size:14px"><i>*File must be in pdf format</i></p>                                
                            </div>

                            <div class="form-group mt-2 ">

                                <label for="staticEmail" class="col-form-label " ><b>Attachment of Birth Certificate</b><b class="text-danger">*</b></label>

                                <input type="file" class="form-control" name="child_copy_birth"  accept="application/pdf"  required >
                                <p style="font-size:14px"><i>*File must be in pdf format</i></p>                           
                            </div>

                        </div>
                      
                    </div>

                    <div class="pl-5 pr-5 pb-5">

                        <div class="form-group row">
                            <div class="col-md-12 mt-3">
                            
                                <h4 class="section-title"><b>Health's Detail</b></h4>
                        
                            
                            </div>
                        </div>

                        <div class="ml-5 mr-2">


                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label " ><b>Health Problem</b><b class="text-danger">*</b></label>
                               
                                <select id="child_health" name="child_health" class="form-control"  required >
                                        <option >Select</option>
                                        <option value="Yes" >Yes</option>
                                        <option value="No" >No</option>
                                </select> 

                            </div>

                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label " ><b>If Yes, please state the health problem</b></label>

                                <input type="text" class="form-control" name="reason"  >
                                                                
                            </div>
                            
                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label " ><b>Document from hospital</b></label>

                                <input type="file" class="form-control" name="health_proof"  accept="application/pdf"  >
                                <p style="font-size:14px"><i>*File must be in pdf format</i></p>                                
                            </div>

                        </div>
                      
                    </div>

                    <div class="pl-5 pr-5 pb-5">

                        <div class="form-group row">
                            <div class="col-md-12 mt-3">
                            
                                <h4 class="section-title"><b>Emergency Contact</b></h4>
                        
                            
                            </div>
                        </div>

                        <div class="ml-5 mr-2">


                            <div class="form-group ">

                                <label for="staticEmail" class="col-form-label " ><b>Contact Name</b><b class="text-danger">*</b></label>                               
                                <input type="text" class="form-control" id="contact-name" name="contact_name" required >
                                <div  id="contact_response" > </div>
 

                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class="col-form-label " ><b>Contact Phone Number</b><b class="text-danger">*</b></label>

                                    <input type="text" class="form-control" id="contact-pnum" name="contact_phone" onkeypress="return isNumberKey(event)" required>
                                    <div  id="contact_response1" > </div>
                                                                    
                                </div>

                                <div class="form-group col-md-6 ">

                                    <label for="staticEmail" class="col-form-label " ><b>Contact Relationship with Child</b></label>
                                    <input type="text" class="form-control" name="contact_relationship"  >
                                    
                                                                    
                                </div>                           
                            </div>

                        </div>
                      
                    </div>

                   

              

                            
                </div>

                <div class="card-footer ">
                        <div class="p-2 text-right">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <a href="Parent/handler/signout.php?signout"class="btn btn-secondary " >Cancel</a>
                        </div>
                    </div>

               
                </form>
               
            </div>
        </div>
    </div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>


    const image_input = document.querySelector("#image-input");
    image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
    });
    reader.readAsDataURL(this.files[0]);
    });

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

$(document).ready(function(){

$("#contact-name").keyup(function(){

   var contact_name = $(this).val().trim();

   if(contact_name != ''){

      $.ajax({
         url: 'Parent/ajax/contact_check.php',
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
      url: 'Parent/ajax/contact_check.php',
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




</section>

</body>
</html>