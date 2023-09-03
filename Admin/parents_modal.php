<style>
      .form-label{
        font-weight: bold;
    }
</style>
    
    <div class="modal fade" id="parentsModal<?php echo isset($row['parent_id']) ? $row['parent_id'] : '' ?>" tabindex="-1" role="dialog" aria-labelledby="parentsModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="parentsModal">Parents Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <form  action="handler/parent_handler.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body row m-3">
                                <input type="hidden" class="form-control "  value="<?php echo isset($row['parent_id']) ? $row['parent_id'] : '' ?>" name="parent_id">

                                <input name="update_parent" type="hidden" class="form-control "  >
                    
                                <!--parent part-->
                                <input name="update_parent" type="hidden" class="form-control "  >

                                <input name="parent_id" type="hidden" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['parent_id'] : '' ?>" >

                                <?php if($row['father_IC']!=NULL):?>  

                                <div class="col-md-12 mt-3">
                                    <h4 class="text-dark "><b>Father/Guardian's Details</b></h4>
                                </div>



                            
                                <div class="col-md-6">
                                    <label for="parent_name" class="form-label mt-3"> Name</label>
                                    <input name="father_name" type="text" class="form-control "  value="<?php echo isset($row['parent_id']) ? $row['father_name'] : '' ?>" id="father_name">
                                </div>

                                
                                <div class="col-md-6">
                                    <label for="parent_IC" class="form-label mt-3"> Identity Card Number</label>
                                    <input name="father_ic" type="text" class="form-control "  value="<?php echo isset($row['parent_id']) ? $row['father_IC'] : '' ?>" id="father_IC">
                                </div>

                                <div class="col-md-6">
                                    <label for="parent_phoneNum" class="form-label mt-3">  Phone Number</label>
                                    <input name="father_phone" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['father_phoneNum'] : '' ?>" id="father_phoneNum">
                                </div>

                                <div class="col-md-6">
                                    <label for="parent_work" class="form-label mt-3"> Occupation</label>
                                    <input name="father_work" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['father_work'] : '' ?>" id="father_work">
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="parent_workAddress" class="form-label mt-3"> Work Address</label>
                                    <input name="father_wAddress" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['father_workAddress'] : '' ?>" id="father_workAddress">
                                </div>

                                <div class="col-md-12">
                                <label for="health_information" class="form-label mt-3">Attachment of Father/Guardian's IC</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="father_copy_ic" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" accept="application/pdf"  >
                                                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                                </div> 
                                                                <div class="input-group-append">
                                                                    <a class="btn btn-outline-secondary" target='_blank' href="handler/view.php?parent_id=<?php echo $row['parent_id']?>&type=father_copy"  id="inputGroupFileAddon04">View</a>
                                                                </div>
                                                            </div>                            
                                </div>

                                <?php 
                        
                                endif;

                                
                                ?>
                                <?php if($row['mother_IC']!=NULL){?>  
                                
                                <div class="col-md-12 mt-5">
                                    <h4 class="text-dark "><b>Mother's Details</b></h4>
                                </div>


                                <div class="col-md-6">
                                    <label for="parent_name" class="form-label mt-3"> Name</label>
                                    <input name="mother_name" type="text" class="form-control "  value="<?php echo isset($row['parent_id']) ? $row['mother_name'] : '' ?>" id="mother_name">
                                </div>

                                
                                <div class="col-md-6">
                                    <label for="parent_IC" class="form-label mt-3"> Identity Card Number</label>
                                    <input name="mother_ic" type="text" class="form-control "  value="<?php echo isset($row['parent_id']) ? $row['mother_IC'] : '' ?>" id="mother_IC">
                                </div>

                            

                                <div class="col-md-6">
                                    <label for="parent_phoneNum" class="form-label mt-3">  Phone Number</label>
                                    <input name="mother_phone" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['mother_phoneNum'] : '' ?>" id="mother_phoneNum">
                                </div>

                                <div class="col-md-6">
                                    <label for="parent_work" class="form-label mt-3"> Occupation</label>
                                    <input name="mother_work" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['mother_work'] : '' ?>" id="mother_work">
                                </div>

                                <div class="col-md-12">
                                    <label for="parent_workAddress" class="form-label mt-3"> Work Address</label>
                                    <input name="mother_wAddress" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['mother_workAddress'] : '' ?>" id="mother_workAddress">
                                </div>

                                <div class="col-md-12">
                                <label for="health_information" class="form-label mt-3">Attachment of Mother's IC</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="mother_copy_ic" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"   accept="application/pdf"  >
                                                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                                </div> 
                                                                <div class="input-group-append">
                                                                    <a class="btn btn-outline-secondary" target='_blank' href="handler/view.php?parent_id=<?php echo $row['parent_id']?>&type=mother_copy"  id="inputGroupFileAddon04">View</a>
                                                                </div>
                                                            </div>
                                
                                                    
                                </div>   


                                <?php 
                    
                                }
                                ?>

                                <div class="col-md-12 mt-5">
                                    <h4 class="text-dark "><b>Home Address's Details</b></h4>
                                </div>
                        
                                <div class="col-md-12">
                                    <label for="parent_address" class="form-label mt-3 ">Address</label>
                                    <input name="parent_address" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['parent_address'] : '' ?>" id="parent_address">
                                </div>

                            
                                <div class="col-md-4">
                                    <label for="parent_town" class="form-label mt-3">Town</label>
                                    <input name="parent_town" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['parent_town'] : '' ?>" id="parent_town">
                                </div>

                                
                                <div class="col-md-4">
                                    <label for="parent_postcode" class="form-label mt-3">Postcode</label>
                                    <input name="parent_postcode" type="text" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['parent_postcode'] : '' ?>" id="parent_postcode">
                                </div>

                                
                                <div class="col-md-4">
                                    <label for="parent_state" class="form-label mt-3">State</label>
                                    <select id="parent_state" class="form-control" name="parent_state">
                                        <option disabled selected>Select</option>
                                        <option value="Johor" <?php echo $row['parent_state']=='Johor' ? 'selected' : '' ?>>Johor</option>
                                        <option value="Kedah" <?php echo $row['parent_state']=='Kedah' ? 'selected' : '' ?> >Kedah</option>
                                        <option value="Kelantan"  <?php echo $row['parent_state']=='Kelantan' ? 'selected' : '' ?>>Kelantan</option>
                                        <option value="Malacca"  <?php echo $row['parent_state']=='Malacca' ? 'selected' : '' ?>>Malacca</option>
                                        <option value="Negeri Sembilan"  <?php echo $row['parent_state']=='Negeri Sembilan' ? 'selected' : '' ?>>Negeri Sembilan</option>
                                        <option value="Pahang"  <?php echo $row['parent_state']=='Pahang' ? 'selected' : '' ?>>Pahang</option>
                                        <option value="Penang"  <?php echo $row['parent_state']=='Penang' ? 'selected' : '' ?>>Penang</option>
                                        <option value="Penang"  <?php echo $row['parent_state']=='Penang' ? 'selected' : '' ?>>Perak</option>
                                        <option value="Perlis"  <?php echo $row['parent_state']=='Perlis' ? 'selected' : '' ?>>Perlis</option>
                                        <option value="Sabah"  <?php echo $row['parent_state']=='Sabah' ? 'selected' : '' ?>>Sabah</option>
                                        <option value="Sarawak"  <?php echo $row['parent_state']=='Sarawak' ? 'selected' : '' ?>>Sarawak</option>
                                        <option value="Selangor" <?php echo $row['parent_state']=='Selangor' ? 'selected' : '' ?>>Selangor</option>
                                        <option value="Terengganu" <?php echo $row['parent_state']=='Terengganu' ? 'selected' : '' ?>>Terengganu</option>
                                        <option value="Kuala Lumpur"  <?php echo $row['parent_state']=='Kuala Lumpur' ? 'selected' : '' ?>>Kuala Lumpur</option>
                                        <option value="Labuan"  <?php echo $row['parent_state']=='Labuan' ? 'selected' : '' ?>>Labuan</option>
                                        <option value="Putrajaya"  <?php echo $row['parent_state']=='Putrajaya' ? 'selected' : '' ?>>Putrajaya</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                                        <label for="parent_postcode" class="form-label mt-3">Email</label>
                                                        <input name="email" type="email" class="form-control " value="<?php echo isset($row['parent_id']) ? $row['email'] : '' ?>" id="email">
                                                    </div>

                            
                        </div> 
                        
                    
      
                

                    <div class="modal-footer justify-content-between ">
                    
                    <div class="text-left">
                    <?php if($_SESSION['type']=='ADMIN'){?>
                        <a class='btn btn-outline-primary' href="handler/parent_handler.php?reset=<?php echo $row['parent_id'] ?>"><i class="fa-solid fa-rotate"></i>  Reset Password</a>
                        <?php }?>
                    </div>
                   
                    <div>
                        <button  class='btn btn-danger' type='button' data-dismiss='modal' href='#' data-toggle='modal' data-target='#deleteModal<?php echo isset($row['parent_id']) ? $row['parent_id'] : '' ?>'>Delete</button>
                        <button class="btn btn-success" type="submit" >Save</button>
                    </div>
                    </div>

                </form>
               
            </div>
        </div>
    </div>
    <div class="modal align-middle fade" id="deleteModal<?php echo isset($row['parent_id']) ? $row['parent_id'] : '' ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="handler/parent_handler.php" method='POST'>
                    <div class="modal-body  my-3">

                        <div class="mt-2 text-center">
                        <i class="fa-solid fa-triangle-exclamation fa-8x" style=''></i>
                            <h3><b>Are sure want delete the data?</b></h3>  
                            <p>All the data related with this details also will be deleted</p>  
                            <input type="hidden" class="form-control" id="inputPassword4" name="delete" value="<?php echo $row['parent_id']  ?>">
                        </div>

                    </div>

                    <div class='modal-footer'>
                    
                    <div>
                        <button  class='btn btn-danger' type='submit' >Delete</button>
                        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>

                </form>
                
                
            </div>
        </div>
</div>
    