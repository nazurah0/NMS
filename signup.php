<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo1.png" >

    <title>Nursery Management System</title>
   
    <?php 
    session_start();
    if(isset($_SESSION['signup'])){
        $_SESSION['signup']='0';
       }
    include 'header.php';
    ?>
  
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>
<body class="vh-100 gradient-custom s">


<div class="container ">
<div class="row align-items-center vh-100">
  <div class="col">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                   

                    <div >
                        <div class="p-5">
                            
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 ">Check the Existing of Information</h1>
                                <h6 >Please enter your IC number for verification</h6>
                                <h6 class="mb-4" style="font-size:13px"><i> (without '-' symbol e.g:950828011387)</i></h6>
                            </div>

                            <div >
                                <?php 

                                if(@$_GET['exist']==true)
                                {
                                ?>
                                    <div class="alert alert-danger  block  alert-dismissible" >
                                     
                                            <button type="button" class="close mt-3" data-bs-dismiss="alert">
                                                    <span aria-hidden="true">&times;</span>
                                            </button>

                                            <div>
                                            <p class="text-justify font-weight-light mt-3 text-xl-left" width="90";><?php echo $_GET['exist']?></p>
                                            </div>
                                    </div>
                                <?php }

                                else if(@$_GET['alert']==true)
                                {
                                ?>
                                    <div class="alert alert-info  block  alert-dismissible" >
                                     
                                        <button type="button" class="close mt-3" data-bs-dismiss="alert">
                                                        <span aria-hidden="true">&times;</span>
                                                </button>
                                            <div>
                                            <p class="text-justify  mt-3 text-xl-left"><i class="fa-solid fa-circle-info"></i> <?php echo $_GET['alert']?></p>
                                            </div>
                                    </div>
                                <?php } ?>

                            </div>

                            <form class="user" action="signup_handler.php" method="POST">
                                <div class="form-group row">
                                    
                                        <input type="text" class="form-control form-control-user" name="father_IC"
                                            placeholder="Father / Guardian Identity Card" maxlength = "12">
                                
                                </div>
                                <div class="form-group row text-center ">
                                    <p class="mt-3"> OR / AND</p>
                                </div>
                                <div class="form-group">

                                    <input type="text" class="form-control form-control-user" name="mother_IC"
                                        placeholder="Mother Identity Card " maxlength = "12">
                                </div>
                               
                            
                                   <button type="submit" class="btn btn-primary btn-user btn-block"> Check </button>
                              
                               
                            </form>
                            <hr>
                            
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Sign in!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
        
<!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




</body>
</html>