<html lang="en">
<?php
     session_start();   
   include('../db_connect.php');
   $bank=$_GET['bank'];
   
   $sql=$conn->query("SELECT * FROM bank where id=$bank");
   foreach($sql->fetch_array() as $k => $val){
    $$k=$val;
  }
  $sql2=$conn->query("SELECT * FROM fee where fee_id=".$_SESSION['fee_id']);
  foreach($sql2->fetch_array() as $l => $value){
   $$l=$value;
 }
  

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment - <?php echo $name?></title>
    <link rel="icon" href="bank-img/Bank-Islam.png" >
    <link href="../fontawesome-free-6.0.0-web/css/all.css" rel="stylesheet">



    <?php include '../header.php'; ?>
</head>
<body >
<section >
  <div class=" ">
    <div class="row d-flex justify-content-center align-items-center  ">
    

      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="text-center py-4">
        <img src="bank-img/<?php echo $image?>" width="450" >
        </div>
     
        <div class="card bg-white text-black mb-5  bg-body" style="border-radius: none;">
          <div class="card-header" style="background-color:<?php echo $color?>;">
                  <h5 class="text-<?php echo $text_color?> p-3 font-weight-light"><i class="fa-solid fa-lock"></i>  Your are in a secure site</h5>
          </div>

          <!--sign option-->
          <div class="card-body  p-4     ">

            <h5 style="opacity:70%"><b>Thrid Party Account Transfer (Step 2 of 3)</b> </h5>
            <div class="pull-right">
              <p class="">as at <?php date_default_timezone_set("Asia/Kuala_Lumpur");  echo date('d-m-y h:i:s')  ?></p>
              </div>
              <table class="table">
                <thead style="border-bottom:0px;">
                    <tr style="background-color:<?php echo $color?>; border-bottom:hidden; ">
                      <th colspan="5" class="text-<?php echo $text_color?> p-3"  >
                        Transfer Details
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                      <td class="p-3"></td>
                      <td class="p-3">From Account</td>
                      <td class="p-3">:</td>
                      <td class="p-3">Saving Account - 0893098321 MYR</td>
                      <td class="p-3"></td>
                    </tr>
                    <tr >
                      <td class="p-3"></td>
                      <td class="p-3">Transfer Type</td>
                      <td class="p-3">:</td>
                      <td class="p-3">Fund Transfer to Saving/Current</td>
                      <td class="p-3"></td>
                    </tr>
                    <tr >
                      <td class="p-3"></td>
                      <td class="p-3">Transfer Amount</td>
                      <td class="p-3">:</td>
                      <td class="p-3">MYR <?php echo number_format($remain_paid ,2) ?></td>
                      <td class="p-3"></td>
                    </tr>
                    <tr style="border-bottom:hidden;">
                      <td class="p-3"></td>
                      <td class="p-3">Effective Date</td>
                      <td class="p-3">:</td>
                      <td class="p-3">Today</td>
                      <td class="p-3"></td>
                    </tr>

                </tbody>
              </table>
             
              <table class="table">
                <thead style="border-bottom:0px;">
                    <tr style="background-color:<?php echo $color?>; border-bottom:hidden; ">
                      <th colspan="5" class="text-<?php echo $text_color?> p-3"  >
                        Recipient Details
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                      <td class="p-3"></td>
                      <td class="p-3">Recipient Account</td>
                      <td class="p-3">:</td>
                      <td class="p-3">Saving Account - 0893098321 MYR</td>
                      <td class="p-3"></td>
                    </tr>
                    <tr >
                      <td class="p-3"></td>
                      <td class="p-3">Recipient Name</td>
                      <td class="p-3">:</td>
                      <td class="p-3">TASKA UMMI SAKIZA</td>
                      <td class="p-3"></td>
                    </tr>
                    <tr style="border-bottom:hidden;">
                      <td class="p-3"></td>
                      <td class="p-3">References</td>
                      <td class="p-3">:</td>
                      <td class="p-3"><?php echo $fee_desc ?></td>
                      <td class="p-3"></td>
                    </tr>


                </tbody>
              </table>




             
           
                    
              

           

          </div>

          <div class="card-footer " style="background-color:white;">
          <a href="../Parent/fee.php?error=Payment Unsuccessful" class="btn text-white pull-right mx-2  "  style="background-color:<?php echo $color?>; ">Cancel</a>
            <a href="config.php?bank=<?php echo $bank?>&payment" class="btn text-white pull-right" style="background-color:<?php echo $color?>;" >Confirm</a>
            
          </div>

        </div>
      </div>
    </div>
  </div>
</section>


    
</body>
</html>