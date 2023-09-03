
 <div class="modal fade" id="paymentModal<?php echo isset($row['payment_id'])?  $row['payment_id'] :$row['fee_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="paymentModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <form class="" action="handler/payment_handler.php" method="POST">

                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModal"><?php echo isset($row['payment_id']) ? "Payment for Invoice <b>#".$row['invoice_no']. "</b>": 'Payment' ?></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3 row g-2">
                        <div class="col-md-6 mb-2 ">
                                <?php if(isset($row['payment_id'])): ?>
                                    
                                    <?php if($row['payment_status'] == 'REJECT'): ?>
                                    <h4 class="text-danger font-weight-bold">#REJECTED</h4>
                                    <?php endif; ?>

                                    <?php if($row['payment_status'] == 'ACCEPT'): ?>
                                    <h4 class="text-success font-weight-bold ">#ACCEPTED</h4>
                                    <?php endif; ?>

                                    <?php if($row['payment_status'] == 'WAITING'): ?>
                                    <h4 class=" text-primary font-weight-bold">#NEW PAYMENT</h4>
                                    <?php endif; ?>

                                <?php endif; ?>
                            </div>
                        
                        
                            <div class="col-md-12">
                                <input type="hidden" class="form-control "  value="<?php echo $row['fee_id'] ?>"  name="fee_id">
                                
                                <input type="hidden" class="form-control "  value="<?php echo isset($row['payment_id'])?  $row['payment_id'] :''?>"  name="payment_id">
                                <label for="inputEmail4" class="form-label">Date</label>
                                <input type="date" class="form-control " value="<?php echo isset($row['payment_id']) ? $row['payment_date'] : '' ?>" name='payment_date'>
                            </div>

                            <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label mt-3">Payment Method</label>
                                <select id="parent_state" class="form-control" name='payment_method'>
                                    <option >Select</option>
                                    <option value="CASH" <?php echo isset($row['payment_id']) ? $row['payment_type'] == "CASH" ?  'selected="selected"': '' :''?>>Cash</option>
                                    <option value="ONLINE BANKING" <?php echo isset($row['payment_id'])? $row['payment_type'] == "ONLINE BANKING" ? 'selected="selected"' : '' :'' ?>>Online Banking</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label mt-3">Payment Amount</label>
                                <div class="input-group">
                                        <div   div class="input-group-prepend">
                                        <div class="input-group-text">RM</div>
                                        </div>
                                <input type="text" class="form-control " value="<?php echo isset($row['payment_id']) ? number_format($row['payment_amount'],2) : '' ?>" name='payment_amount'>                    
                                    </div>
                            </div>

                            <div class="col-md-12">
                                <?php if(isset($row['payment_id'])&& $row['payment_type']=='ONLINE BANKING'): ?>
                                <label for="health_information" class="form-label mt-3">Transaction ID</label>

                                <fieldset disabled>
                                <input type="text" class="form-control " value="<?php echo isset($row['payment_id']) ? $row['transaction_id'] : '' ?>" name='transaction_id'>
                                </fieldset>
                                <?php endif;?>
                            </div>

                            

                                <?php if(isset($row['payment_id'])):?>

                                <div class="col-md-12 mt-3">
                                    <hr class="solid">
                                <h5 class="font-weight-bold">Payment By:</h5>
                                </div>

                                <fieldset disabled class="col-md-6">
                                    <label for="inputEmail4" class="form-label mt-3">Name</label>
                                    <input type="text" class="form-control " value=
                                    "<?php 
                                        if (isset($row['payment_id'])){ 
                                            if(!$row['father_name']=="" || !$row['father_name']==NULL )
                                                echo $row['father_name'];
                                            else
                                                echo $row['mother_name'] ; 
                                            }
                                        else
                                        echo "";
                                    ?>" 
                                    id="inputEmail4">                    

                                </fieldset>

                                <fieldset disabled class="col-md-6">
                                    <label for="inputEmail4" class="form-label mt-3">Phone Number</label>
                                    <input type="text" class="form-control " value=
                                    "<?php 
                                        if (isset($row['payment_id'])){ 
                                            if(!$row['father_phoneNum']=="" || !$row['father_phoneNum']==NULL )
                                                echo $row['father_phoneNum'];
                                            else
                                                echo $row['mother_phoneNum'] ; 
                                            }
                                        else
                                        echo "";
                                    ?>" id="inputEmail4">                    

                                </fieldset>
                                <?php endif ?>

                                
                    </div>
                    <div class="modal-footer">

                        <?php 
                        if (isset($row['payment_id'])){

                        
                            if($row['payment_status']=='ACCEPT' || $row['payment_status']=='REJECT'){     
                            echo "<a class='btn btn-danger' type='button' href='handler/payment_handler.php?delete=$row[payment_id]'>Delete</a>";
                            //echo "<button class='btn btn-success' type='button' data-dismiss='modal'>Save</button>";
                            }

                            else if($row['payment_status']=='WAITING'){
                           
                               $remain=$row['remain_paid']-$row['payment_amount'];
                              
                                echo "<a class='btn btn-danger' type='button'  href='handler/payment_handler.php?status=REJECT&id=$row[payment_id]&fee=$row[fee_id]'>Reject</a>";
                                echo "<a class='btn btn-success' type='button' href='handler/payment_handler.php?status=ACCEPT&id=$row[payment_id]&fee=$row[fee_id]&remain=$remain' >Accept</a>";  
                            }

                        }
                        else{
                            echo " <button class='btn btn-secondary' data-dismiss='modal' >Cancel</button>";
                            echo "<button class='btn btn-success' type='submit'>Create</button>" ;
                        }?>
                    </div>
                    </form>
            </div>
        </div>
</div>








