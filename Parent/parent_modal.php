<div class="modal fade" id="fatherModal<?php echo isset($parent_id) ? $parent_id : '' ?>" tabindex="-1" role="dialog" aria-labelledby="parentsModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  action="handler/parent_handler.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    
                    <div class="modal-header" >
                        <h4 class="modal-title font-weight-bold" id="parentsModal">Father/Guardian's Detail</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <input type="hidden" class="form-control "  value="1" name="father">

                    <input type="hidden" class="form-control "  value="<?php echo isset($parent_id) ? $parent_id : '' ?>" name="parent_id">

                    <div class="modal-body m-2 row g-2">

                   
                            
                                <div class="col-md-6">
                                    <label for="parent_name" class="form-label mt-3"> Name</label>
                                    <input name="father_name" type="text" class="form-control "  value="<?php echo isset($parent_id) ? $father_name : '' ?>" id="father_name" required>
                                </div>

                                
                                <div class="col-md-6">
                                    <label for="parent_IC" class="form-label mt-3"> IC Number</label>
                                    <input name="father_ic" type="text" class="form-control "  value="<?php echo isset($parent_id) ? $father_IC : '' ?>" id="father_IC" <?php echo $father_IC!='' ? 'disabled':'' ?> required>
                                </div>

                                <div class="col-md-6">
                                    <label for="parent_phoneNum" class="form-label mt-3">  Phone Number</label>
                                    <input name="father_phone" type="text" class="form-control " value="<?php echo isset($parent_id) ? $father_phoneNum : '' ?>" id="father_phoneNum" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="parent_work" class="form-label mt-3"> Work</label>
                                    <input name="father_work" type="text" class="form-control " value="<?php echo isset($parent_id) ? $father_work : '' ?>" id="father_work" required>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="parent_workAddress" class="form-label mt-3"> Work Address</label>
                                    <input name="father_wAddress" type="text" class="form-control " value="<?php echo isset($parent_id) ? $father_workAddress : '' ?>" id="father_workAddress" required>
                                </div>

                                <?php if($father_IC==''):?>

                                    <div class="col-md-12">
                            <label for="health_information" class="form-label mt-3">Copy of IC </label>
                            <div class="custom-file">
                            <input name="father_copy_ic" type="file"class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  accept="application/pdf" >
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>                             
                        
                        </div>

                                    <?php endif;?>
                            
                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" >Save</button>
                    </div>

                </div>

            </form>
        </div>
</div>

<div class="modal fade" id="motherModal<?php echo isset($parent_id) ? $parent_id : '' ?>" tabindex="-1" role="dialog" aria-labelledby="parentsModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  action="handler/parent_handler.php" method="POST" enctype="multipart/form-data" >
                <div class="modal-content">
                    
                    <div class="modal-header" >
                        <h4 class="modal-title font-weight-bold" id="parentsModal">Mother's Detail</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <input type="hidden" class="form-control "  value="1" name="mother">

                    <input type="hidden" class="form-control "  value="<?php echo isset($parent_id) ? $parent_id : '' ?>" name="parent_id">

                    <div class="modal-body m-2 row g-2">

    

                                <div class="col-md-6">
                                    <label for="parent_name" class="form-label mt-3"> Name</label>
                                    <input name="mother_name" type="text" class="form-control "  value="<?php echo isset($parent_id) ? $mother_name : '' ?>" id="mother_name" required>
                                </div>

                                
                                <div class="col-md-6">
                                    <label for="parent_IC" class="form-label mt-3"> IC</label>
                                    <input name="mother_ic" type="text" class="form-control "  value="<?php echo isset($parent_id) ? $mother_IC : '' ?>" id="mother_IC" <?php echo $mother_IC!='' ? 'disabled':'' ?> required>
                                </div>

                            

                                <div class="col-md-6">
                                    <label for="parent_phoneNum" class="form-label mt-3">  Phone Number</label>
                                    <input name="mother_phone" type="text" class="form-control " value="<?php echo isset($parent_id) ? $mother_phoneNum : '' ?>" id="mother_phoneNum" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="parent_work" class="form-label mt-3"> Work</label>
                                    <input name="mother_work" type="text" class="form-control " value="<?php echo isset($parent_id) ? $mother_work: '' ?>" id="mother_work" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="parent_workAddress" class="form-label mt-3"> Work Address</label>
                                    <input name="mother_wAddress" type="text" class="form-control " value="<?php echo isset($parent_id) ? $mother_workAddress: '' ?>" id="mother_workAddress" required>
                                </div>

                                  <?php if($mother_IC==''):?>

                                    <div class="col-md-12">
                                        <label for="health_information" class="form-label mt-3">Copy of IC </label>
                                        <div class="custom-file">
                            <input name="mother_copy_ic" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  accept="application/pdf" >
                              <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>                                         
                                    
                                    </div>

                                    <?php endif;?>
                                
                            
                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" >Save</button>
                    </div>

                </div>

            </form>
        </div>
</div>