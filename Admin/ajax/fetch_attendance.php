<?php 
    include('../../db_connect.php');
    
    $group = $conn->query("SELECT * from child_group ");

                     

        $date=$_POST['request_date'];
        if($date==0){
        $attendance1 = $conn->query("SELECT DISTINCT  *, DATE_FORMAT(attendance_date,'%d %b %Y') AS attendance_date1 , a.attendance_id from 
        attendance a 
        LEFT OUTER JOIN pickup p ON (a.attendance_id = p.attendance_id )
        JOIN child c ON c.child_id = a.child_id
        JOIN child_group g ON c.group_id = g.group_id
        JOIN staff s ON a.staff_id = s.staff_id
        order by a.attendance_date asc"  );}

        else{
            $attendance1 = $conn->query("SELECT DISTINCT  *, DATE_FORMAT(attendance_date,'%d %b %Y') AS attendance_date1 , a.attendance_id from 
            attendance a 
            LEFT OUTER JOIN pickup p ON (a.attendance_id = p.attendance_id )
            JOIN child c ON c.child_id = a.child_id
            JOIN child_group g ON c.group_id = g.group_id
            JOIN staff s ON a.staff_id = s.staff_id
            WHERE attendance_date ='$date'
            order by a.attendance_date asc"  );
        }


?>









<table class="table table-bordered display" id="dataTable1" width="100%" cellspacing="0">
    <thead>
        <tr class="thead-light">

            <th >Date</th>
            <th class="col-1">class </th>
            
            <th class="col-1"># </th>
            <th class="col-3">Set By</th>
            <th class="col-3">Child</th>
            <th class="col-2">Time</th>
            <th class="col-1">Status</th>
            <th class="col-2">Action</th>
        </tr>
    </thead>

    


    <tbody>
        <?php 
            while($row=$attendance1->fetch_assoc()):
                
            ?>
        <tr>
            
            <td><?php echo $row['attendance_date1'] ?></td>
            <td><?php echo $row['group_name'] ?></td>
            <td><?php echo $row['attendance_id'] ?></td>
            <td>
                <b><?php echo $row['staff_id'] ?></b>
                <?php echo $row['staff_name'] ?>
                </td>
            <td><?php echo $row['child_name'] ?></td>

            <td>
                <p><span class="font-weight-bold">Arrival: </span> <?php echo $row['attendance_arrivalTime'] ?></p>
                <p><span class="font-weight-bold">Pick Up: </span> <?php echo $row['attendance_pickupTime'] ?></p>
            </td>
            <td>
                <?php 
                if ($row['attendance_status'] == "PRESENT") {
                    echo "<span class='font-weight-bold'><p class='text-success text-center'>PRESENT</p></span>";}
                    
                        else{
                    echo "<span class='font-weight-bold'><p class='text-danger text-center'>ABSENT</p></span>";}
                
                    ?>
            </td>
            <td>
                <button class="btn btn-primary" href="#" data-toggle="modal" data-target="#attendanceModal<?php echo isset($row['attendance_id'])? $row['attendance_id']:'' ?>"><a>View</a></button>
                <button class="btn btn-outline-primary" href="#" data-toggle="modal" data-target=<?php  echo !isset($row['attendance_arrivalTime']) ? "#alertModal".$row['attendance_id'] : "#setPickUpModal".$row['attendance_id'] ?> ><a>Pick Up</a></button>
                <!-- attendance Modal-->
                <?php include "../attendance_modal.php"; ?>
            </td>
        </tr>
        <?php endwhile; ?>
        
        

    </tbody>
</table>

<script>

$(document).ready(function() {
        $('#dataTable1').DataTable( {
            "search": {
                "search": "<?php  echo  isset($_GET['name'])?$_GET['name']:''?>"
            },
            "columnDefs": [
            { "visible": false, "targets": [0,1] }
        ],

        order: [[0, 'asc'],[1, 'asc']],
        rowGroup: {
            dataSrc: [0,1]
        }
    }
     );
    });
    
</script>