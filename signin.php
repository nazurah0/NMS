<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo1.png" >

    <title>Nursery Management System</title>
   
    <?php 
    session_start();
    include("session_expired.php") ;
     
     if(isset($_SESSION['signin'])){
       if($_SESSION['type']=='PARENT')
        header('location:Parent/home.php');

        else if($_SESSION['type']=='ADMIN' || $_SESSION['type']=='STAFF' )
        header('location:Admin/dashboard.php');
    }
     include 'header.php';?>
  
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>
<body >


<section class="vh-100 gradient-custom s">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100 ">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-white text-black shadow-lg bg-body" style="border-radius: 0.5rem;">

    

            <!--sing in form-->
            
          <div class="card-body p-5 text-left signin_form " >

            <div class="p-4 text-center signin_form">
            <img src="image/logo1.png" width="300" >
            </div>
            <div >
                <?php 

                if(@$_GET['alert']==true)
                {
                ?>
                    <div class="alert alert-danger  block  alert-dismissible" >
                      
                            <button type="button" class="close mt-3" data-bs-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                            </button>

                            <div>
                            <p class="text-justify font-weight-light mt-3 text-xl-left" width="90";><?php echo $_GET['alert']?></p>
                            </div>
                    </div>
                <?php }?>
              </div>
         
            <form class="user" method="POST" action="signin_handler.php" id="signin-form">  

              <div class="mb-3">
              <input type="hidden" class="form-control form-control-user"  name="role"  value="<?php echo $_GET['role'] ?>" >
                <input type="username" class="form-control form-control-user" name="username" placeholder="Username" >
              </div>

              <div class="mb-3">
              
              <input type="password" class="form-control form-control-user" name="password" placeholder="Password" >
              </div>
              
              <div class="container" >

                <div class="row">

                  <div class="col">
                  <button type="submit" class="btn btn-secondary btn-user btn-block ">Sign In</button>
                  </div>

                  <div class="col">
                  <a  class="btn btn-outline-dark btn-user btn-block" href="index.php">Cancel</a>
                  </div>

                </div>
              </div>
            </form>
            <?php if($_GET['role']=="PARENT"):?>
              <hr class="sidebar-divider" style="height:0.3px;">

            

              
              <div class="text-center p-1 ">
                <div>
                <a   href="#" class="text-secondary small " data-toggle="modal" data-target="#forgotModal"> Forgot Password!</a>
                </div>
                <div>
                <a  href="signup.php" class="text-secondary small "> Create New Account!</a>
                </div>
              </div>
              <?php endif ?>
            

          </div>
       


        </div>
      </div>
    </div>
  </div>
</section>
        



</body>
</html>


    <div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Forgot Password?</b></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body  text-center">
                      <div class="m-auto">
                      <i class="fa-solid fa-square-phone" style="font-size:150px"></i>
                      </div>  
                
                <h5><b>Please contact nursery if you want reset the password!</b></h5></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>
    
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src = "https://code.jquery.com/jquery-3.3.1.slim.min.js" 
         integrity = "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
         crossorigin = "anonymous">
      </>
      
      <script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
         integrity = "sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
         crossorigin = "anonymous">
      </script>
      
      <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
         integrity = "sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
         crossorigin = "anonymous">
      </script>