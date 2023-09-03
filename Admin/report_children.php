
<div class="form-inline mt-3">

    <label class="pr-2 pl-3">Group</label>

        <select class="form-control ml-2 select-group" id="select-group" name="report-year">
            <option disabled selected='selected'>Select</option>
            <?php
            $year=date('Y');
            $date = $conn->query("SELECT  group_id, group_name FROM child_group  ");
            while($row1=$date->fetch_assoc()):
            ?>

            <option value='<?php echo $row1['group_id']; ?>'  >
                <?php echo $row1['group_name'] ?>
            </option>
            <?php endwhile; ?>
        </select>

</div>

<div class="row m-5 ">
    <?php 

        $total_child= $conn->query("SELECT * from 
        child 
        WHERE renew_register= $year AND child_registerStatus='ACCEPT'
         ");

        $count_total  = mysqli_num_rows( $total_child );

        $total_child_new= $conn->query("SELECT * from 
        child 
        WHERE renew_register= $year AND child_registerStatus='ACCEPT' AND year(child_registerDate)=$year
         ");

        $count_total_new  = mysqli_num_rows( $total_child_new );

    ?>
    
    <div class="col-md-2">

    </div>

    <div class="col-md-4 ">
        <div class="card" style="border-left-color:#FF5765; border-left-width:6px ">
            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#FF5765;" >
                            Total Registered Children <?php echo $year?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_total ?></div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4 ">
        <div class="card " style="border-left-color:#FFDB15; border-left-width:6px ">
            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#FFDB15;" >
                            New Registered Children <?php echo $year?> </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_total_new?></div>
                    </div>

                </div>
                
            </div>
        </div>
    </div>

    <div class="col-md-2">

    </div>

</div>


<div class="card mt-1">
    <div class="card-body">
        <div class="container-children">
            <?php 

                $number_2 =1;
                $number_3 =1;
                $group=1;
                $child= $conn->query("SELECT * from 
                child c
                JOIN child_group g ON c.group_id=g.group_id
                WHERE c.renew_register= $year AND c.group_id=$group AND c.child_registerStatus='ACCEPT'
                order by c.child_registerDate asc ");

               
                $group = $conn->query("SELECT * from 
                child_group  
                WHERE group_id= $group" );
                foreach($group->fetch_array() as $k => $val){
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
   
        </div>
    </div>
</div>

<script>
      $(document).ready(function(){  
    $("#select-group").on('change',function(){
                var group = $(this).val();
                

                //alert(value);

                $.ajax({
                    url:"ajax/fetch_children.php",
                    type:"POST",
                    data: "request_group="+group,
                    success:function(data){
                        $('.container-children').html(data);
                    }
                });
            });
        });
</script>