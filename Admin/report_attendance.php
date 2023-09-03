

<div class="form-inline">
    <label class="pr-2">Date </label>

    <select class="form-control ml-2 select-year" id="select-year" name="report-year">
        
        <?php
        $year=date('Y');
        $date = $conn->query("SELECT  DATE_FORMAT(attendance_date,'%Y') AS attendance_date2 FROM attendance GROUP BY attendance_date2 ");
        while($row1=$date->fetch_assoc()):
        ?>

        <option value='<?php echo $row1['attendance_date2']; ?>' <?php echo $row1['attendance_date2']==$year?'selected':'' ?> >
            <?php echo $row1['attendance_date2'] ?>
        </option>
        <?php endwhile; ?>
    </select>

    <select class="form-control select-month ml-2 " id="select-month" name="report-month">
        <option disabled selected="selected">Select</option>

        <?php
        $month=date('m');
        
        $date = $conn->query("SELECT DISTINCT DATE_FORMAT(attendance_date,'%M') AS attendance_date1,  MONTH(attendance_date) AS attendance_date2  FROM attendance   GROUP BY attendance_date2, attendance_date1");
        while($row1=$date->fetch_assoc()):
        ?>

        <option value='<?php echo $row1['attendance_date2']; ?>' >
            <?php echo $row1['attendance_date1'] ?>
        </option>
        <?php endwhile; ?>
    </select>

    

    

</div>

      

<div class="card mt-3">
    <div class="card-body">
        <div class="container-attendance">
        <?php 
        
                $sql2 = $conn->query("SELECT * FROM child_group ");
                
                $group = mysqli_num_rows( $sql2);
        
                $year = date('Y');
                $month =date('m');
                $mon_name = date("F", mktime(0, 0, 0, $month, 10));
                
                for ($group_id = 1; $group_id <= $group; $group_id ++){
                    
                    $attendance="SELECT attendance_date , DATE_FORMAT(attendance_date,'%d%c%Y') AS attend_date2, DATE_FORMAT(attendance_date,'%D %M %Y') AS attend_date3, g.group_id , g.group_name , SUM(IF(a.attendance_status ='PRESENT',1,0)) AS count_present, SUM(IF(a.attendance_status ='ABSENT',1,0)) AS count_absent FROM attendance a JOIN child c ON a.child_id=c.child_id JOIN child_group g ON g.group_id=c.group_id group by attendance_date, g.group_id HAVING g.group_id=$group_id AND month(a.attendance_date)=$month AND year(a.attendance_date)=$year";
                    $query=$conn->query($attendance);
                    $groupnm = $conn->query("SELECT * FROM child_group WHERE group_id=$group_id");
                    $row8 = mysqli_fetch_assoc($groupnm)
                        
                    
            ?>
            

                <div class="table-responsive  ">

                    <div>
                        <h5 class="pt-4  text-center"><b>Attendance Report Group  <?php echo $row8['group_name']?></b></h5>
                        <h6 class="pb-2 text-center font-weight-light"> <?php echo $mon_name ?>, <?php echo $year?> </h6>
                    </div>

                    <table class="table table-bordered  " > 

                        <thead class="thead-secondary">
                        
                            <tr bgcolor="#F5F5F5"  >
                                <th class="text-center">Date</th>
                                
                                <th>Present</th>
                                <th>Absent</th>
                            </tr>
                        </thead>
                
                    
                        
                        <?php  while($row6=$query->fetch_assoc()):?>
                            <tr>
                        
                                
                            <td><a  href="#" data-toggle="modal" data-target="#attendModal<?php echo $group_id.$row6['attend_date2'] ?>"><?php echo $row6['attend_date3']?></a> 
                            <?php include "report_attendance_modal.php"; ?> </td>
                            
                            <td><?php echo $row6['count_present']?> </td>
                            <td><?php echo $row6['count_absent']?> </td>
                            
                            </tr>
                            
                            <?php  
                                
                                endwhile; 
                            ?>
                    
                        <tbody>
                        
                            
                        
                        

                        </tbody>
                        
                    </table>
                    
                </div>
           

            <?php    }?>
            </div>

        </div>
</div>










<script type="text/javascript">



        $(document).ready(function(){

            $("#select-year").on("change", function () {
                $('#select-month  option').prop('selected', function() {
                    return this.defaultSelected;
                });
            });

            $("#select-month").on('change',function(){
                var value = $(this).val();
                var value2 = $("#select-year").val();

                //alert(value);

                $.ajax({
                    url:"ajax/fetch.php",
                    type:"POST",
                    data:{request_year:value2, request_month:value},
                    success:function(data){
                        $('.container-attendance').html(data);
                    }
                });
            });
        });
       
   

  
</script>
