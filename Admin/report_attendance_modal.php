<div class="modal fade" id="attendModal<?php echo $group_id.$row6['attend_date2'] ?>" tabindex="-1" role="dialog" aria-labelledby="parentsModal"aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="parentsModal">Attendance Report</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
                <div class="modal-body m-3">
                    <?php 
                        $date=$row6['attend_date2'];
                        $group2=$group_id;

                        $group_select = $conn->query("SELECT * from 
                        child_group  
                        WHERE group_id= $group2" );
                        foreach($group_select->fetch_array() as $k => $val){
                            $$k=$val;
                        }
                        
                    $list_attend=$conn->query("SELECT * FROM attendance a JOIN child c ON a.child_id=c.child_id WHERE DATE_FORMAT(attendance_date,'%d%c%Y')=$date AND group_id=$group2")
                    ?>
                    <div class="text-center">
                        <h5><b>List of Attendance for <?php echo $group_name ?></b></h5>
                        <p><?php echo $row6['attend_date3']; ?></p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" >

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php  while($row9=$list_attend->fetch_assoc()):?>
                                <tr>
                                    <td><?php echo $row9['child_name'] ?></td>
                                    <td><?php echo $row9['attendance_status'] ?></td>
                                </tr>
                                <?php   endwhile; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            
        </div>
    </div>
</div>