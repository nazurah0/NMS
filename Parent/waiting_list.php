<div class="modal fade" id="waitingModal<?php echo isset($row1['child_id'])? $row1['child_id']:'' ?>" tabindex="-1" role="dialog" aria-labelledby="attendanceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModal"><b>Registration Details</b></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
               <div class="modal-body">
                    <fieldset class="  row g-2 m-4 m-3" disabled>


                        <div class="col-md-12 text-center " >                                                           
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row1['child_image']); ?>" class="rounded mx-auto d-block mb-3 " alt="..." width="200">
                         </div>

                         <div class="col-md-12 " > 
                            <?php 
                                if($row1['child_registerStatus']=='WAITING'){
                                    echo "<h4 class='text-info'><b>#Waiting</b></h4>";
                                } 
                                else if($row1['child_registerStatus']=='REJECTED'){
                                    echo "<h4 class='text-danger'><b>#Rejected</b></h4>";
                                }
                            ?>                                                           
                         </div>

                        <div class="col-md-12 my-2 ">
                            <label for="child_name">Child Name</label>
                            <input type="text" class="form-control" id="disabledTextInput" value="<?php echo $row1['child_name']?>">
                        </div>
                        
                        <div class="col-md-6 my-1 ">
                            <label for="child_name">MyKid Num</label>
                            <input type="text" class="form-control" id="disabledTextInput" value="<?php echo $row1['child_myKidNum']?>">
                        </div>

                        <div class="col-md-6 my-1 ">
                            <label for="child_name">Register Date</label>
                            <input type="text" class="form-control" id="disabledTextInput" value="<?php echo $row1['child_registerDate']?>">
                        </div>

                        <?php 
                            if($row1['child_registerStatus']=='REJECT'){?>
                            <div class="col-md-12 my-1 ">
                                <label for="rejected_reason">Rejection Reasons</label>
                                <textarea type="text" class="form-control"  rows="3" name="rejected_reason"><?php echo $row1['child_rejectReason']?></textarea>
                            </div>
                        <?php }?>

                    </fieldset>
               </div>
                <?php 
                   if($row1['child_registerStatus']=='REJECT'){

                ?>
                <div class="modal-footer ">
                    <a class="btn btn-success" href="register_form.php?child_id=<?php echo $row1['child_id']?>">Resubmit</a>
                </div>

                <?php };?>
          
        </div>
    </div>
</div>