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

   if(isset($_SESSION['signup'])){
    $_SESSION['signup']='0';
   }
   

    if(isset($_SESSION['signin'])){
    if($_SESSION['type']=='PARENT')
    header('location:Parent/home.php');

    else if($_SESSION['type']=='ADMIN' || $_SESSION['type']=='STAFF')
    header('location:Admin/dashboard.php');
    }
      include 'header.php';
   
   ?>
 
   <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    

</head>
<body>



<section class="vh-100 gradient-custom s">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100 ">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-white text-black shadow-lg bg-body" style="border-radius: 0.5rem;">

        
          <!--sign option-->
          <div class="card-body  p-5 text-center signin_option   ">

            
              <img src="image/logo1.png" width="250" >
              <h5 class="text-black-50 mb-3  mt-5 font-weight-light">Please select the option</h5>
             
             
           
            <div class="d-grid gap-3 col-6 mx-auto user">
             <a class="btn btn-secondary  btn-block font-weight-light "  href='signin.php?role=PARENT' style="border-radius: 24px;"><i class="fas fa-user mr-2"  ></i>  Parents</a> 
              <a type="submit" class="btn btn-secondary   btn-block font-weight-light " href='signin.php?role=STAFF' style="border-radius: 24px;" ><i class="fas fa-users mr-2"  ></i>  Staff</a>
            </div>
            
              

           

          </div>

        </div>
      </div>
    </div>
  </div>
</section>




</body>
</html>