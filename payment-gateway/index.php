<html lang="en">
<?php
        
        include('../db_connect.php');
        $bank=$_GET['bank'];
        $sql=$conn->query("SELECT * FROM bank where id=$bank");
        foreach($sql->fetch_array() as $k => $val){
         $$k=$val;
       }
     
     ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment - <?php echo $name?></title>
    <link rel="icon" href="bank-img/Bank-Islam.png" >


    <?php include '../header.php'; ?>
</head>
<body style="background-color:<?php echo $color?>;">
<section class="vh-100 gradient-custom s">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100 ">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-white text-black shadow-lg bg-body" style="border-radius: 0.5rem;">

        
          <!--sign option-->
          <div class="card-body  p-5 text-center signin_option   ">

            
              <img src="bank-img/<?php echo $image?>" width="250" >
              <h5 class="text-black-50 mb-5  mt-3  font-weight-light">WELCOME TO <?php echo Strtoupper ($name)?> INTERNET BANKING</h5>
             
             
           
              <form class="user" method="POST" action="config.php" id="signin-form">  

                    <div class="mb-3">
                    
                    <input type="username" class="form-control form-control-user" name="username" placeholder="Username" required>
                    <input type="hidden" class="form-control form-control-user" name="bank" value="<?php echo $_GET['bank']?>">
                    <input type="hidden" class="form-control form-control-user" name="fee_id" value="<?php echo $_GET['fee_id']?>">
                    

                    </div>

                    <div class="mb-3">

                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                    </div>

                    <div class="container" >

                    <div class="row">

                        <div class="col">
                        <button type="submit" class="btn btn-secondary btn-user btn-block " >Login</button>
                        </div>

                        <div class="col">
                        <a  class="btn btn-outline-dark btn-user btn-block" href='../Parent/fee.php'>Cancel</a>
                        </div>

                    </div>
                    </div>
                    </form>
              

           

          </div>

        </div>
      </div>
    </div>
  </div>
</section>


    
</body>
</html>