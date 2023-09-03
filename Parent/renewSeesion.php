<div class="modal fade" id="renewSession<?php echo isset($detail['child_id'])? $detail['child_id']:'' ?>" tabindex="-1" role="dialog" aria-labelledby="attendanceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModal"><b>Registration for New </b></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
               <div class="modal-body">
                 <div class="m-4 row ">
                        <div class="col-md-12">

                            <label for="child_name" class="form-label">Full Name</label>
                            <input name="child_name" type="text" class="form-control " value="<?php echo isset($detail['child_id']) ? $detail['child_name'] : '' ?>" id="child_name" disabled>
                        </div>
                        <div class="col-md-6">
                        <label for="child_name" class="form-label mt-3">Session</label>
                            <input name="child_name" type="text" class="form-control " value="<?php echo date('Y')+1 ?>" id="child_name" disabled>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">

                                <input type="hidden" name="renew" value="<?php echo $detail['child_id']?>">

                                <label for="child_name" class="form-label">Group</label>
                           
                                <label for="inputPassword4" class="form-label mt-3">Group</label>
                                <select id="group_id" name="group_id" class="form-control" name="child_group" >
                                <option >Select</option>
                                <?php 
                                $group2 = $conn->query("SELECT * from child_group ");
                                while($row5=$group2->fetch_assoc()): ?>
                                <option value="<?php echo $row5['group_id'] ?>" ><?php echo $row5['group_name'] ?></option>
                                <?php endwhile; ?>
                                </select>
                
                        </div>
                        <div class="col-md-6">
                        </div>
                 </div>
               </div>
                
          
        </div>
    </div>
</div>