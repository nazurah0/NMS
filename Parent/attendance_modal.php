<!-- set pickup Modal-->
<div class="modal fade" id="setPickUpModal<?php echo isset($row1['pickup_id'])? $row1['pickup_id']:''?>" tabindex="-1" role="dialog" aria-labelledby="setPickUpModal"
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
                    <input type="hidden" class="form-control " value="<?php echo isset($row1['attendance_id']) ? $row1['attendance_id'] : '' ?>" name="attendance_id">

                    <input type="hidden" class="form-control " value="<?php echo isset($row1['pickup_id']) ? $row1['pickup_id'] : '' ?>" name="pickup_id">

                        <fieldset disabled class="col-md-12">

                                <label for="inputEmail4" class="form-label">Name</label>
                                <input type="text" class="form-control"  value="<?php echo isset($row1['attendance_id']) ? $row1['child_name'] : '' ?>" id="disabledDateInput">
                        
                        </fieldset>

                            <fieldset disable class="col-md-12">
                                <label for="inputEmail4" class="form-label mt-3">Date</label>
                                <input disabled type="date" class="form-control " value="<?php echo isset($row1['attendance_id']) ? $row1['attendance_date']: '' ?>" id="disabledTextInput">
                            </fieldset>

                            <div class="col-md-12 mt-4 ">
                            
                            <h5 class="font-weight-bold">Time:</h5>
                            </div>

                            <fieldset disabled class="col-md-6">
                                <label for="inputEmail4" class="form-label">Arrival</label>
                                <input type="time" class="form-control " value="<?php echo isset($row1['attendance_id']) ? $row1['attendance_arrivalTime'] : '' ?>" id="attendance_arrivalTime">
                            </fieldset>

                            <fieldset disabled class="col-md-6">
                                <label for="inputEmail4" class="form-label">Pick Up</label>
                                <input type="time" class="form-control " value="<?php echo isset($row1['attendance_id']) ? $row1['attendance_pickupTime'] : '' ?>" name="attendance_pickupTime">
                            </fieldset>

                            <div class="col-md-12 mt-4 ">
                            
                            <h5 class="font-weight-bold">Pick Up Details:</h5>
                            </div>

                            <fieldset disabled class="col-md-6">
                                <label for="inputEmail4" class="form-label">Name</label>
                                <input type="text" class="form-control " value="<?php echo isset($row1['pickup_id']) ? $row1['pickup_name'] : '' ?>" name="pickup_name">
                            </fieldset>

                            <fieldset disabled class="col-md-6">
                                <label for="inputEmail4" class="form-label">Phone Number</label>
                                <input type="text" class="form-control " value="<?php echo isset($row1['pickup_id']) ? $row1['pickup_phoneNum'] : '' ?>" name="pickup_phoneNum">
                            </fieldset>

                            <fieldset disabled class="col-md-6">
                                <label for="parent_state" class="form-label mt-3">Relationship</label>
                                <input type="text"  class="form-control " name='pickup_relationship' value="<?php echo isset($row1['pickup_id']) ? ucwords(strtolower ($row1['pickup_relationship'] )): '' ?>" >

                            </fieldset>

                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        
                    </div>
                
                </div>
        </form>
    </div>
</div>