<style>
    .error span {
    color: red;
}

.success span {
    color: green;
}
</style>



<div class="modal fade" id="payModal<?php echo isset($row2['fee_id'])? $row2['fee_id']:'' ?>" tabindex="-1" role="dialog" aria-labelledby="attendanceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form method="POST" id="myform" action="handler/payment_handler.php" enctype="multipart/form-data">
 
                <div class="modal-header">
                    <h5 class="modal-title" id="attendanceModal"><b>Payment </b></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body m-3 row g-2">

                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Remain Fee</label>
                                <div class="input-group">
                                        <div   div class="input-group-prepend">
                                        <div class="input-group-text">RM</div>
                                        </div>

                                <input type="number" class="form-control remain_paid"  name='remain_paid' id="remain_paid" value=<?php echo $row2['remain_paid']?>>           
</div>     
                            </div>

                                <div class="col-md-12">
                                <input type="hidden" class="form-control  " name='fee_id' value="<?php echo $row2['fee_id']?>">
                                    <label for="inputEmail4" class="form-label mt-3">Date</label>
                                    <input type="date" class="form-control " name='payment_date' required>
                                </div>

                                <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label mt-3">Payment Method</label>
                                    <input type="text" class="form-control" name="payment_method" value="CASH">
                                </div>

                                <div class="col-md-6" >
                                    <label for="inputEmail4" class="form-label mt-3">Payment Amount</label>
                                    <div class="input-group">
                                        <div   div class="input-group-prepend">
                                        <div class="input-group-text">RM</div>
                                        </div>
                                    <input type="number" class="form-control payment_amount "  name='payment_amount' id="payment_amount" max="<?php echo $row2['remain_paid']?>" title="The amount cannot be greater than RM<?php echo $row2['remain_paid']?>" required>
                                        </div> 
                                    <div class="mt-1">                   
                                    <i><span class="error " id="amount_err" style="font-size:13px; color:red; "> </span></i>
                                    </div>
                                </div>


                                

                                
                                    
                </div>
                <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="submitbtn" >Save</button>
            
                </div>
                </form> 
          
        </div>
      
    </div>
    

</div>


<div class="modal fade" id="onlineBankingModal<?php echo isset($row2['fee_id'])? $row2['fee_id']:'' ?>" tabindex="-1" role="dialog" aria-labelledby="attendanceModal"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
        
 
                <div class="modal-header">
                    <h5 class="modal-title" id="attendanceModal"><b>Online Banking </b></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                 <div class="modal-body">

                        <div class="container ">
                            <h3>Bank: </h3>
                            <div class="card mt-3" style="width: 18rem; margin:auto;">
                                <div class="card-header">Select Bank:</div>
                                <ul class="list-group list-group-flush">
                                       
                             <?php 
                            $sql=$conn->query("SELECT * FROM bank");
                             while($row=$sql->fetch_assoc()): ?>

                                    <li class="list-group-item"><a href="../payment-gateway/index.php?bank=<?php echo $row['id'] ?>&fee_id=<?php echo $row2['fee_id'] ?>" style="text-decoration:none;"><img  class="pr-2" src="../payment-gateway/bank-img/<?php echo $row['icon'] ?>" alt="Card image" style="width:30; height:30;  object-fit: scale-down;"><?php echo $row['name'] ?></a></li>

                                    <?php endwhile; ?>
                            
                                </ul>
                            </div>
                        </div>
                   
                     

                             
                              
                                 
                                
                            

                        </div>

                    
              
          
        </div>
      
    </div>
</div>

