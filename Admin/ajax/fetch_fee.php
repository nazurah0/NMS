<?php 
    include('../../db_connect.php');
    $group = $conn->query("SELECT * from child_group ");
    $year = date('Y');
    $month = $_POST['request_date'];

    if($month==0){

   $fee= $conn->query("SELECT * , DATE_FORMAT(fee_date,'%M') AS fee_date1 ,f.fee_id,  month(fee_date) AS fee_date2 from 
   child c 
   JOIN child_group g ON c.group_id = g.group_id
   JOIN fee f ON c.child_id = f.child_id
   LEFT OUTER JOIN  parent m ON (m.parent_id=c.parent_id)
   WHERE year(fee_date)= $year
   order by f.fee_id asc");
    }

    else{
        $fee= $conn->query("SELECT * , DATE_FORMAT(fee_date,'%M') AS fee_date1 ,f.fee_id,  month(fee_date) AS fee_date2,  m.parent_id from 
        child c 
        JOIN child_group g ON c.group_id = g.group_id
        JOIN fee f ON c.child_id = f.child_id
        LEFT OUTER JOIN  parent m ON (m.parent_id=c.parent_id)
        WHERE year(fee_date)= $year AND MONTH(fee_date) = $month
        order by f.fee_id asc");
         
    }




?>





<table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
    <thead>
        <tr class="thead-light">

            <th class="col-1">#</th>
            <th class="col-1">Staff</th>
            <th class="col-1">Date</th>
            <th class="col-1">Group</th>
            <th class="col-1">Amount</th>
            <th class="col-3">Child</th>
            <th class="col-1">Status</th>
            <th class="col-2 ">Action</th>
        </tr>
    </thead>




    <tbody>
        <?php while($row=$fee->fetch_assoc()): ?>
        <tr >
        
            <td>
                <?php echo $row['fee_id'] ?>
                
            
            </td>
            <td><?php echo $row['staff_id'] ?></td>
            <td><?php echo $row['fee_date1'] ?></td>
            <td><?php echo $row['group_name'] ?></td>
            <td>RM <?php echo number_format($row['fee_amount'],2) ?></td>
            <td><?php echo $row['child_name'] ?></td>
            <td>
                <?php if($row['fee_status'] == 'UNPAID' || $row['fee_status'] == 'WAITING'): ?>
                <span class="font-weight-bold"><p class="text-danger text-center">UNPAID</p></span>
                <?php elseif($row['fee_status'] == 'PAID'): ?>
                <span class="font-weight-bold"><p class="text-success text-center">PAID</p></span>
                <?php endif; ?>
            </td>
        
            

            <td class=" text_center">
                <button class="btn btn-primary " href="#" data-toggle="modal" data-target="#feeModal<?php echo $row['fee_id'] ?>"><a>View</a></button>
                
                <a  href="pdf_generator.php?id=<?php echo $row['fee_id'] ?>" target="_blank"><button class="btn btn-outline-primary" type="submit">Invoice</button></a>
                <!-- Set fee Modal-->
               
                <?php include "../fee_modal.php"; ?>
                
                
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
                { "visible": false, "targets": [2,3] }
            ],

            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: [2]
            }
        });
    });

</script>