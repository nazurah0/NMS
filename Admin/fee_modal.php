

    <div class="modal fade" id="feeModal<?php echo $row['fee_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="feeModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <form  action="handler/fee_handler.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="feeModal">Fee Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="row g-2 modal-body m-4">
                    

                <input type="hidden" class="form-control " value="<?php echo isset($row['fee_id']) ? $row['fee_id'] : '' ?>" name="fee_id">

                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Date Created</label>
                            <input type="date" class="form-control " value="<?php echo isset($row['fee_id']) ? $row['fee_date'] : '' ?>" name="fee_date">
                        </div>


                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label mt-3">Description</label>
                            <textarea type="text" class="form-control" id="inputPassword4" rows="3" name="fee_description"><?php echo isset($row['fee_id']) ? $row['fee_desc'] : '' ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label mt-3">Fee Status</label>
                            <select id="parent_state" class="form-control" name="fee_status">
                            <option >Select</option>
                            <option value="PAID" <?php echo $row['fee_status'] == "PAID" ?  'selected="selected"': '' ?>>Paid</option>
                            <option value="UNPAID" <?php echo $row['fee_status'] == "UNPAID" ? 'selected="selected"' : '' ?>>Unpaid</option>
                        </select>
                        </div>

                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label mt-3">Fee Amount</label>
                            <div class="input-group">
                                        <div   div class="input-group-prepend">
                                        <div class="input-group-text">RM</div>
                                        </div>
                            <input type="text" class="form-control " value="<?php echo isset($row['fee_id']) ? number_format($row['fee_amount'],2) : '' ?>" name="fee_amount">                    
</div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <hr class="solid">
                           <h5 class="font-weight-bold">Child Information</h5>
                        </div>


                        


                   

                   
                        <fieldset disabled class="col-md-6">
                            <label for="inputEmail4" class="form-label">Name</label>
                            <input type="text" class="form-control"  value="<?php echo isset($row['fee_id']) ? $row['child_name'] : '' ?>" id="disabledTextInput">
                        </fieldset>

                        <fieldset disabled class="col-md-6">
                            <label for="inputEmail4" class="form-label">Group</label>
                            <input type="text" class="form-control " value="<?php echo isset($row['fee_id']) ? $row['group_name'] : '' ?>" id="disabledTextInput">
                        </fieldset>
                  


          
                </div>
                <div class="modal-footer ">
                   
                    <a class="btn btn-danger" type="button" href="handler/fee_handler.php?delete=<?php echo $row['fee_id'] ?>">Delete</a>
                    <button class="btn btn-success" type="submit" >Save</button>
                </div>
                </form>
            </div>
        </div>
</div>

<!-- set attendance Modal-->
<div class="modal fade" id="setFeeModal" tabindex="-1" role="dialog" aria-labelledby="setFeeModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

    <form  action="handler/fee_handler.php"  method="POST">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feeModal">Fee Detail</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="row g-2 modal-body m-4">

                    <div class="col-md-12 mb-3"><i>**Please select at least one group to set fee.</i></div>
                        <div class="col-md-12">
                            
                            <label for="inputPassword4" class="form-label">Group</label>
                           
                          
                            <?php 
                           
                            while($row=$group->fetch_assoc()): ?>
                                <!-- Default checked -->
                                <label class="custom-control overflow-checkbox">
                                    <input type="checkbox" class="overflow-control-input" name="group[]" value=<?php echo $row['group_id'] ?> >
                                    <span class="overflow-control-indicator"></span>
                                    <span class="overflow-control-description"><?php echo $row['group_name'] ?></span>
                                </label>
                            

                            <?php 
                         endwhile; ?>
                            
                        </div>

                        

                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label mt-3">Description</label>
                            <textarea type="text" class="form-control" id="inputPassword4" rows="3" name="fee_description" required></textarea>
                        </div>

                    
                </div>

                <div class="modal-footer">
                     
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit"  value="submit">Create</button>
                </div>
            
            </div>
        </form>
    </div>
</div>


