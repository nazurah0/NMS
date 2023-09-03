
<!-- attendance Info Modal-->
<div class="modal fade" id="attendanceModal<?php echo isset($row['attendance_id'])? $row['attendance_id']:'' ?>" tabindex="-1" role="dialog" aria-labelledby="attendanceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModal">Attendance Detail</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form  action="handler/attendance_handler.php" method='POST'>
                <div class="modal-body  row g-2 m-4">

                
                        

                        <div class="col-md-12 ">
                            
                        <h5 class="font-weight-bold">Child Information</h5>
                        </div>
                        
                        <fieldset disabled  class="col-md-6">
                            
                                <label for="inputEmail4" class="form-label">Name</label>
                                <input type="text" class="form-control"  value="<?php echo isset($row['attendance_id']) ? $row['child_name'] : '' ?>" id="disabledTextInput">
                            
                        </fieldset>
                        <fieldset disabled  class="col-md-6">
                            
                                <label for="inputEmail4" class="form-label">Group</label>
                                <input type="text" class="form-control " value="<?php echo isset($row['attendance_id']) ? $row['group_name'] : '' ?>" id="disabledTextInput">
                        
                        </fieldset>

                        <div class="col-md-12 pt-3">
                        <hr class="solid">
                        </div>

        
                        <div class="col-md-12 mt-2">
                            <input type="hidden" class="form-control " value="<?php echo isset($row['attendance_id']) ? $row['attendance_id'] : '' ?>" name="attendance_id">
                            <label for="inputEmail4" class="form-label">Date</label>
                            <input disabled id="disabledTextInput" type="date" class="form-control " value="<?php echo isset($row['attendance_id']) ? $row['attendance_date'] : '' ?>" name="attendance_date">
                        </div>



                        <div class="col-md-12 mt-3">
                        
                        <h5 class="font-weight-bold">Time:</h5>
                        </div>

                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Arrival</label>
                            <input  id="disabledInput" type="time" class="form-control " value="<?php echo isset($row['attendance_id']) ? $row['attendance_arrivalTime'] : '' ?>"  name="attendance_arrivalTime">
                        </div>
                        

                        <?php if(isset($row['attendance_arrivalTime'])){


                            $pickupTime=$row['attendance_pickupTime'];

                            echo "<div class='col-md-6'>
                            <label for='inputEmail4' class='form-label'>PickUp</label>
                            <input type='time' class='form-control' value='$pickupTime' name='attendance_pickupTime'> </div>";

                        }

                            ?>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger" type="button" href="handler/attendance_handler.php?delete=<?php echo $row['attendance_id'] ?>">Delete</a>
                    <button class="btn btn-success" type='submit'>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- set pickup Modal-->
<div class="modal fade" id="setPickUpModal<?php echo isset($row['attendance_id'])? $row['attendance_id']:''?>" tabindex="-1" role="dialog" aria-labelledby="setPickUpModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <form  action="handler/pickup_handler.php"  method="POST">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="attendanceModal">Pick Up Detail</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="row g-2 modal-body m-4">
                    <input type="hidden" class="form-control " value="<?php echo isset($row['attendance_id']) ? $row['attendance_id'] : '' ?>" name="attendance_id">

                    <input type="hidden" class="form-control " value="<?php echo isset($row['pickup_id']) ? $row['pickup_id'] : '' ?>" name="pickup_id">

                        <fieldset disabled class="col-md-12">

                                <label for="inputEmail4" class="form-label">Name</label>
                                <input type="text" class="form-control"  value="<?php echo isset($row['attendance_id']) ? $row['child_name'] : '' ?>" id="disabledDateInput">
                        
                        </fieldset>

                            <fieldset disable class="col-md-12">
                                <label for="inputEmail4" class="form-label mt-3">Date</label>
                                <input disabled type="date" class="form-control " value="<?php echo isset($row['attendance_id']) ? $row['attendance_date']: '' ?>" id="disabledTextInput">
                            </fieldset>

                            <div class="col-md-12 mt-4 ">
                            
                            <h5 class="font-weight-bold">Time:</h5>
                            </div>

                            <fieldset disabled class="col-md-6">
                                <label for="inputEmail4" class="form-label">Arrival</label>
                                <input type="time" class="form-control " value="<?php echo isset($row['attendance_id']) ? $row['attendance_arrivalTime'] : '' ?>" id="attendance_arrivalTime">
                            </fieldset>

                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Pick Up</label>
                                <input type="time" class="form-control " value="<?php echo isset($row['attendance_id']) ? $row['attendance_pickupTime'] : '' ?>" name="attendance_pickupTime">
                            </div>

                            <div class="col-md-12 mt-4 ">
                            
                            <h5 class="font-weight-bold">Pick Up Details:</h5>
                            </div>

                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Name</label>
                                <input type="text" class="form-control " value="<?php echo isset($row['pickup_id']) ? $row['pickup_name'] : '' ?>" name="pickup_name" required>
                            </div>

                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Phone Number</label>
                                <input type="text" class="form-control " value="<?php echo isset($row['pickup_id']) ? $row['pickup_phoneNum'] : '' ?>" name="pickup_phoneNum" required>
                            </div>

                            <div class="col-md-12">
                                <label for="parent_state" class="form-label mt-3">Relationship</label>
                                <input type="text"  class="form-control " name='pickup_relationship' value="<?php echo isset($row['pickup_id']) ? ucwords(strtolower ($row['pickup_relationship'] )): '' ?>" required>

                            </div>

                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit"  value="submit">Save</button>
                    </div>
                
                </div>
        </form>
    </div>
</div>

<!-- alert modal-->
<div class="modal align-middle fade" id="alertModal<?php echo $row['attendance_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-body text-center my-3">
                    <div class="my-2">

                        <div class="icon mb-3" style="opacity:50%">
                        <i class="fa-solid fa-circle-exclamation fa-10x"></i>
                        </div>
                        
                        <h4> <b>There is no arrived time has been set! </b></h4>       
                        <p> Please set the arrived time before you want to insert the pick up details</p>
                    </div>

                    <div>
                    <button class="btn btn-success" type="button" data-dismiss="modal">Okay</button>
                    
                    </div>

                </div>
                
                
            </div>
        </div>
</div>





<!-- set attendance Modal-->
<div class="modal fade" id="setAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="setattendanceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

    <form  action="handler/attendance_handler.php"  method="POST">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attendanceModal">Attendance Detail</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="row g-2 modal-body m-4">
                <div class="col-md-12">

                        <label for="inputPassword4" class="form-label pr-4">Group</label>

                        <?php 
                           
                            while($row=$group->fetch_assoc()): ?>
                                <!-- Default checked -->
                                <label class="custom-control overflow-checkbox ml-3">
                                    <input type="checkbox" class="overflow-control-input" name="group[]" value=<?php echo $row['group_id'] ?> required>
                                    <span class="overflow-control-indicator"></span>
                                    <span class="overflow-control-description"><?php echo $row['group_name'] ?></span>
                                </label>
                            

                            <?php 
                         endwhile; ?>
  </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label mt-3">Date</label>
                            <input type="date" class="form-control " id="attendance_date" name="attendance_date" min="<?= date('Y-m-d'); ?>" required>
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

<script>
    var today = new Date().toISOString().split('T')[0];
document.getElementsByName("attendance_date")[0].setAttribute('min', today);
</script>



