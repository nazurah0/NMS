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

    ?>
  
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style_wizard.css?v=<?php echo time(); ?>">

</head>
<style>
    /* The message box is shown when the user clicks on the password field */
#message {
    background-color:#F3F3F3;

}

#message p {
  padding: 2px 35px;
  font-size: 15px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
    font-family: "FontAwesome";
  position: relative;
  left: -35px;
  content: "\f00c";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
    font-family: "FontAwesome";
  position: relative;
  left: -35px;
  content: "\f00d";
}

@import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

.title-tb {
 font-family: 'Fredoka One', cursive;
font-size: 30px; 
color:#EBEBE8;



}
</style>

<body class="vh-100 gradient-custom ">
    <nav class="navbar navbar-expand-sm shadow " style="background-color:#188C5A">
    <div class="pull-right">
            <img src="image/logo1.png" width="80" class="mr-3">
        </div>
    <div class="ml-2 mt-3">
        


        <h5 class="title-tb" >Taska Ummi Sakiza</h5>
    </div>



    <ul class="navbar-nav ml-auto ">
    <li class="nav-item">
      <a class="btn btn-light" style="text-decoration:none;" href="index.php"><i class="fa-solid fa-house"></i> Home</a>
    </li>
  </ul>




    </nav>
    


    <div class="container" >
        

        <div class="row align-items-center  " style="padding-top:50px">
            <div class="text-center text-light pb-5">
                <h2 ><b>Create New Parent Account! </b></h2>
             
            </div>
            <div class="card o-hidden border-0 shadow-lg  mb-5  ">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    
                    <div class="p-5">

                        <form class="user " action="signup_handler.php" method="POST" enctype="multipart/form-data">

                            <nav hidden>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                        <a class="nav-item nav-link active" id="nav-signin-tab" data-toggle="tab" href="#nav-signin" role="tab" aria-controls="nav-signin" aria-selected="true" style="color:gray;">Father/Guardian's Details</a>

                                        <a class="nav-item nav-link " id="nav-father-tab" data-toggle="tab" href="#nav-father" role="tab" aria-controls="nav-father" aria-selected="true" style="color:gray;">Father/Guardian's Details</a>
                                    
                                    
                                        <a class="nav-item nav-link" id="nav-mother-tab" data-toggle="tab" href="#nav-mother" role="tab" aria-controls="nav-mother" aria-selected="false" style="color:gray;">Mother's Details</a>
                                    
                                    
                                        <a class="nav-item nav-link" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab" aria-controls="nav-address" aria-selected="false" style="color:gray;">Home Address</a>
                                    

                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-pane fade  show active" id="nav-signin" role="tabpanel" aria-labelledby="nav-signin-tab">

                                        <div class="form-group row ">
                                            <div class="col-md-12 mt-3">
                                            
                                                <h4 class="section-title"><b>User's Detail</b></h4>
                                                <p style="font-size:15px" class="text-danger"><i><b>(*) Required field</b></i></p>  
                                        
                                            
                                            </div>
                                        </div>
                                        <div   div class="ml-5 mr-2">
                                            <div class="form-group">

                                                <label for="staticEmail" class="col-form-label " ><b>Username</b><b class="text-danger">*</b></label>
                                              
                                                <input type="text" class="form-control" id="username" name="username" required="true" style="width:500px;">
                                                                                       
                                            </div>
                                            <div class="col-md-12 pt-1" id="uname_response" ></div>
                                            <div class="form-group">

                                                <label for="staticEmail" class="col-form-label "><b>Password</b><b class="text-danger">*</b></label>
                                                <input type="password" class="form-control" name="password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required style="width:500px;"> 
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="card mt-3" id="message">
                                                            <div class="card-body" >
                                                            
                                                                    <h5 class="pb-2" ><b>Password must contain the following: </b></h5>
                                                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                                                    <p id="number" class="invalid">A <b>number</b></p>
                                                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" ></div>
                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label for="staticEmail" class="col-form-label "><b>Email</b><b class="text-danger">*</b> <i> (e.g:name@mail.com)</i></label>
                                                <input type="email" class="form-control" name="email" required="true" style="width:500px;">
                                                <p style="font-size:14px"><i><b>Important noted!</b> : All information will sent to this email</i></p>                                        

                                            </div>
                                        
                                        </div>

                                       
                                </div>


                                <div class="tab-pane fade" id="nav-father" role="tabpanel" aria-labelledby="nav-father-tab">
                                   
                                    <div class="form-group row ">
                                            <div class="col-md-12 mt-3">
                                            
                                                <h4 class="section-title"><b>Father/Guardian's Details</b></h4>
                                        
                                            
                                            </div>
                                    </div>

                                   
                                    
                                    <div class="ml-5 mr-2">
                                    
                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label "><b>Full Name</b><?php echo isset($_GET['father_ic'])? "<b class='text-danger'>*</b>":''?></label>
                                            <input type="text" class="form-control" name="father_name" <?php echo isset($_GET['father_ic'])? 'required':''?> >

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Identity Card Number</b> <?php echo isset($_GET['father_ic'])? "<b class='text-danger'>*</b>":''?> <i style="font-size:14px"> (without '-' symbol e.g:950828011387)</i></label>
                                            <input type="text" class="form-control " onkeypress="return isNumberKey(event)" maxlength = "12" name="father_ic_signup" value="<?php echo isset($_GET['father_ic'])?  $_GET['father_ic']:''?>" <?php echo isset($_GET['father_ic'])? 'required':''?>>

                                        </div>

                                        
                                        <div class="form-group mt-2  ">

                                            <label for="staticEmail" class="col-form-label " ><b>Attachment of Identity Card</b><?php echo isset($_GET['father_ic'])? "<b class='text-danger'>*</b>":''?></label>

                                            <input type="file" class="form-control" name="father_copy" accept="application/pdf"  <?php echo isset($_GET['father_ic'])? 'required':''?>   >
                                            <i style="font-size:14px">*File must be in pdf format</i>
                                                                        
                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Phone Number</b><?php echo isset($_GET['father_ic'])? "<b class='text-danger'>*</b>":''?> <i  style="font-size:14px"> (without '-' symbol e.g:0138794768)</i></label>
                                            <input type="text" class="form-control" name="father_phoneNum"  maxlength = "10" onkeypress="return isNumberKey(event)" <?php echo isset($_GET['father_ic'])? 'required':''?>>

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Occupation</b></label>
                                                    <input type="text" class="form-control" name="father_work">

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Work Address</b></label>
                                                    <textarea type="text" class="form-control " id="inputPassword4" rows="3" name="father_workAddress"></textarea>

                                        </div>

                                    </div>  
                                </div>

                                <div  class="tab-pane fade " id="nav-mother" role="tabpanel" aria-labelledby="nav-mother-tab">

                                    <div class="form-group row ">
                                            <div class="col-md-12 mt-3">
                                            
                                                <h4 class="section-title"><b>Mother's Details</b></h4>
                                        
                                            
                                            </div>
                                    </div>                                    
                                    
                                    <div class="ml-5 mr-2">
                                    

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Full Name</b><?php echo isset($_GET['mother_ic'])? "<b class='text-danger'>*</b>":''?></label>
                                                    <input type="text" class="form-control" name="mother_name" <?php echo isset($_GET['mother_ic'])? 'required':''?> >

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Identity Card Number</b><?php echo isset($_GET['mother_ic'])? "<b class='text-danger'>*</b>":''?> <i style="font-size:14px"> (without '-' symbol e.g:950828011387)</i></label>
                                                    <input type="text" class="form-control "  maxlength = "12" onkeypress="return isNumberKey(event)" name="mother_ic_signup" value="<?php echo isset($_GET['mother_ic'])?  $_GET['mother_ic']:''?>"  <?php echo isset($_GET['mother_ic'])? 'required':''?>>

                                        </div>

                                        <div class="form-group mt-2  ">

                                            <label for="staticEmail" class="col-form-label " ><b>Attachment of Identity Card</b><?php echo isset($_GET['mother_ic'])? "<b class='text-danger'>*</b>":''?></label>

                                            <input type="file" class="form-control" name="mother_copy" accept="application/pdf"  <?php echo isset($_GET['mother_ic'])? 'required':''?> >
                                            <i style="font-size:14px">*File must be in pdf format</i>
                                                                    
                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Phone Number</b><?php echo isset($_GET['mother_ic'])? "<b class='text-danger'>*</b>":''?> <i style="font-size:14px"> (without '-' symbol e.g:0138794768)</i></label>
                                                    <input type="text" class="form-control"  maxlength = "10" onkeypress="return isNumberKey(event)" name="mother_phoneNum" <?php echo isset($_GET['mother_ic'])? 'required':''?>>

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Occupation</b></label>
                                                    <input type="text" class="form-control" name="mother_work">

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Work Address</b></label>
                                                    <textarea type="text" class="form-control " id="inputPassword4" rows="3" name="mother_WorkAddress"></textarea>

                                        </div>

                                    </div>

                                </div>

                                
                                <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">


                                    <div class="form-group row ">
                                            <div class="col-md-12 mt-3">
                                            
                                                <h4 class="section-title"><b>Home Address</b></h4>
                                        
                                            
                                            </div>
                                    </div>   

                                    <div class="ml-5 mr-2">

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Address</b><b class="text-danger">*</b></label>
                                                <textarea type="text" class="form-control " id="inputPassword4" rows="3" name="parent_address" required></textarea>

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Town</b><b class="text-danger">*</b></label>
                                                    <input type="text" class="form-control " name="parent_town" required>

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>Postcode</b><b class="text-danger">*</b><i style="font-size:14px"> (e.g:81560)</i></label>
                                                    <input type="text" class="form-control"  maxlength = "5" onkeypress="return isNumberKey(event)" name="parent_postcode" required>

                                        </div>

                                        <div class="form-group">

                                            <label for="staticEmail" class="col-form-label"><b>State</b><b class="text-danger">*</b></label>
                                           
                                                <select id="parent_state" class="form-control" name="parent_state" required>
                                                    <option disabled selected>Select</option>
                                                    <option value="Johor" >Johor</option>
                                                    <option value="Kedah"  >Kedah</option>
                                                    <option value="Kelantan"  >Kelantan</option>
                                                    <option value="Malacca"  >Malacca</option>
                                                    <option value="Negeri Sembilan"  >Negeri Sembilan</option>
                                                    <option value="Pahang"  >Pahang</option>
                                                    <option value="Penang"  >Penang</option>
                                                    <option value="Penang"  >Perak</option>
                                                    <option value="Perlis"  >Perlis</option>
                                                    <option value="Sabah"  >Sabah</option>
                                                    <option value="Sarawak"  >Sarawak</option>
                                                    <option value="Selangor" >Selangor</option>
                                                    <option value="Terengganu" >Terengganu</option>
                                                    <option value="Kuala Lumpur"  >Kuala Lumpur</option>
                                                    <option value="Labuan"  >Labuan</option>
                                                    <option value="Putrajaya"  >Putrajaya</option>
                                                </select>
                                         
                                        </div>

                                        

                                    </div>
                                   
                                    
                                </div>
                            </div>

                            <button class="btn btn-success float-right mt-3 " type="submit">Submit</button>
                            <a href="signup.php"class="btn btn-secondary float-right mt-3 me-2" >Cancel</a>
 
                        </form>

                  

                            <button class="prevtab btn btn-outline-secondary mt-3">Prev</button>
                        
                            <button class="nexttab btn btn-outline-secondary mt-3">Next</button>

                      
                    </div>

                            
                </div>

               
                    
               
            </div>
        </div>
    </div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    function bootstrapTabControl(){
    var i, items = $('.nav-link'), pane = $('.tab-pane');
    // next
    $('.nexttab').on('click', function(){
        for(i = 0; i < items.length; i++){
            if($(items[i]).hasClass('active') == true){
                break;
            }
        }
        if(i < items.length - 1){
            // for tab
            $(items[i]).removeClass('active');
            $(items[i+1]).addClass('active');
            // for pane
            $(pane[i]).removeClass('show active');
            $(pane[i+1]).addClass('show active');
        }

    });
    // Prev
    $('.prevtab').on('click', function(){
        for(i = 0; i < items.length; i++){
            if($(items[i]).hasClass('active') == true){
                break;
            }
        }
        if(i != 0){
            // for tab
            $(items[i]).removeClass('active');
            $(items[i-1]).addClass('active');
            // for pane
            $(pane[i]).removeClass('show active');
            $(pane[i-1]).addClass('show active');
        }
    });
    }
    bootstrapTabControl();

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

$(document).ready(function(){

$("#username").keyup(function(){

   var username = $(this).val().trim();

   if(username != ''){

      $.ajax({
         url: 'Parent/ajax/user_check.php',
         type: 'post',
         data: {username: username},
         success: function(response){

             $('#uname_response').html(response);

          }
      });
   }else{
      $("#uname_response").html("");
   }

 });

});


var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}


</script>




</body>
</html>