<?php 
    include('../../db_connect.php');


    $sql2 = $conn->query("SELECT * FROM child_group ");
            
    $group = mysqli_num_rows( $sql2);

    $year = isset($_POST['request_year'])? $_POST['request_year']:date('Y') ;
    $month =isset($_POST['request_month'])? $_POST['request_month']:date('m');
    
    $mon_name = date("F", mktime(0, 0, 0, $month, 10));

    $test=$conn->query("SELECT * FROM attendance  WHERE month(attendance_date)=$month AND year(attendance_date)=$year");
    $count_row= mysqli_num_rows($test);

    if($count_row>0){
    for ($group_id = 1; $group_id <= $group; $group_id ++){
        $attendance="SELECT attendance_date , DATE_FORMAT(attendance_date,'%d%c%Y') AS attend_date2, DATE_FORMAT(attendance_date,'%D %M %Y') AS attend_date3, g.group_id , g.group_name , SUM(IF(a.attendance_status ='PRESENT',1,0)) AS count_present, SUM(IF(a.attendance_status ='ABSENT',1,0)) AS count_absent FROM attendance a JOIN child c ON a.child_id=c.child_id JOIN child_group g ON g.group_id=c.group_id group by attendance_date, g.group_id HAVING g.group_id=$group_id AND month(a.attendance_date)='$month' AND year(a.attendance_date)=$year";
        $query=$conn->query($attendance);
        $groupnm = $conn->query("SELECT * FROM child_group WHERE group_id=$group_id");
        $row8 = mysqli_fetch_assoc($groupnm)
            
                 
        ?>
        <div class="table-responsive table-report ">

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
    
           
            <tbody>  
               <?php  while($row6=$query->fetch_assoc()):?>
                <tr>
              
                    
                   <td><a  href="#" data-toggle="modal" data-target="#attendModal<?php echo $group_id.$row6['attend_date2'] ?>"><?php echo $row6['attend_date3']?></a> 
                   <?php include "../report_attendance_modal.php"; ?> </td>
                   
                   <td><?php echo $row6['count_present']?> </td>
                   <td><?php echo $row6['count_absent']?> </td>
                
                </tr>
                
                <?php  
                    
                    endwhile; 
                ?>

            </tbody>
            
        </table>
        </div>
        <?php    }}

        else{
                
        
        ?>

    <div class=" text-center pb-5" style="padding-top:30px; opacity: 0.5;">
        <h1 class="pb-2">
        
        <lord-icon
            src="https://cdn.lordicon.com/otyynlki.json"
            trigger="loop"
            style="width:150px;height:250px">
        </lord-icon>
        </h1>
                <h4> <b>There is no report on <?php echo $mon_name.','.$year?></b></h4>       
    </div>

<?php } ?>