    <?php 
        $parent_id=$_SESSION['id'];
        $user = $conn->query("SELECT * from 
        user u JOIN parent p  ON p.parent_id=u.user_id
        WHERE p.parent_id=$parent_id " );
        $user= mysqli_fetch_assoc($user);
    
    
    
    ?>
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
</style>
    
    
    
    <!-- Manage User Modal-->
<div class="modal fade" id="ManageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
<div class="modal-dialog" role="document">
        <form action="handler/user_handler.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body m-2 row g-2">

                    <input name="id" type="hidden" class="form-control " value="<?php echo isset($user['parent_id']) ? $user['parent_id'] : '' ?>" >


                    <div class="col-md-12">
                        <label for="parent_workAddress" class="form-label mt-3"> Username</label>
                        <input name="username" id="username" type="text" class="form-control " value="<?php echo isset($user['parent_id']) ? $user['username'] : '' ?>" >
                    </div>
                    <div class="col-md-12 pt-1" id="uname_response" ></div>

                    <div class="col-md-12">
                        <label for="parent_workAddress" class="form-label mt-3"> Email</label>
                        <input name="email" type="email" class="form-control " value="<?php echo isset($user['parent_id']) ? $user['email'] : '' ?>" >
                    </div>

                    <div class="col-md-12">
                        <label for="parent_workAddress" class="form-label mt-3"> Password</label>
                        <input name="password" type="password" class="form-control " id="psw" value="" >
                    </div>
                        <div class="col-md-12" >

                    
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
                    

                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function(){

   $("#username").keyup(function(){

      var username = $(this).val().trim();

      if(username != ''){

         $.ajax({
            url: 'ajax/user_check.php',
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

document.getElementById("message").style.display = "none";

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