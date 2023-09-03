<?php 
    
    include('../../db_connect.php'); 


    $number_2 =1;
    $number_3 =1;
    $year=date('Y');
    $group=$_POST['request_group'];
    $child= $conn->query("SELECT * from 
    child c
    JOIN child_group g ON c.group_id=g.group_id
    WHERE c.renew_register= $year AND c.group_id=$group AND c.child_registerStatus='ACCEPT'
    order by c.child_registerDate asc ");


    $parent = $conn->query("SELECT * from 
    child_group  
    WHERE group_id= $group" );
    foreach($parent->fetch_array() as $k => $val){
        $$k=$val;
    }
?>
        
                <div class="text-center mt-3">
                    <h3><b>List of Registered Children for <?php echo  $group_name?> </b></h3>
                    <p><?php echo  $year?></p>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                        <thead>
                            <tr class="thead-light">
                                <th class="col-1 text-center">#</th>
                                <th class="">Name</th>
                                <th class="text-center">MyKid Number</th>
                            </tr>
                        </thead>

                    


                        <tbody>
                            <?php while($row_child=$child->fetch_assoc()): ?>
                            <tr >
                                <td class="text-center"><?php echo $number_3 ?></td>
                                <td><?php echo $row_child['child_name'] ?></td>
                                <td class="text-center">
                                <?php  
                                    $number = $row_child['child_myKidNum'];
                                    $formatted_number = preg_replace("/^(\d{6})(\d{2})(\d{4})$/", "$1-$2-$3", $number); 
                                    echo $formatted_number 
                                ?>
                                </td>
                            </tr>
                            <?php $number_3++;
                                endwhile; ?>

                        </tbody>
                    </table>
                </div>