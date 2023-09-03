<?php 
include('../../db_connect.php');
                    $number =1;
                    $number_1=1;
                    $group = $conn->query("SELECT * from child_group ");
                    $year = isset($_POST['request_year'])? $_POST['request_year']:date('Y') ;
                    $month = isset($_POST['request_month'])? $_POST['request_month']:date('m');
                    $mon_name = date("F", mktime(0, 0, 0, $month, 10));

                    $fee= $conn->query("SELECT *from 
                    fee f
                    JOIN child c ON c.child_id=f.child_id
                    WHERE year(f.fee_date)= $year AND month(f.fee_date)=$month
                    order by f.fee_status asc ");
                    $count_row= mysqli_num_rows($fee);

                    $payment= $conn->query("SELECT *from 
                    payment p
                    JOIN fee f ON p.fee_id=f.fee_id
                    JOIN child c ON c.child_id=f.child_id
                    WHERE year(p.payment_date)= $year AND month(p.payment_date)=$month AND p.payment_status='ACCEPT'
                    order by p.payment_date asc ");
                    $count_payment_row= mysqli_num_rows($payment);

                    $unpaid_fee= $conn->query("SELECT c.child_id,  c.child_name, f.fee_status , COUNT(c.child_id) AS count_unpaid , SUM(f.remain_paid)  AS sum_unpaid from 
                    fee f
                    JOIN child c ON c.child_id=f.child_id
                    GROUP BY c.child_id, f.fee_status
                    HAVING f.fee_status = 'UNPAID' AND count_unpaid>1");
                    $count_unpaid_row= mysqli_num_rows($unpaid_fee);

                  

                if($count_row>0){
                ?> 
                <div class="fee">
                    <div class="text-center mt-5">
                        <h3><b>List of Fee</b></h3>
                        <p><?php echo $mon_name.', '. $year?></p>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                            <thead>
                                <tr class="thead-light">
                                    <th class="col-1 text-center">#</th>
                                    <th class="">Name</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>

                        


                            <tbody>
                                <?php while($rows=$fee->fetch_assoc()): ?>
                                <tr >
                                    <td class="text-center"><?php echo $number ?></td>
                                    <td><?php echo $rows['child_name'] ?></td>
                                    <td>
                                        <?php if($rows['fee_status'] == 'UNPAID' || $rows['fee_status'] == 'WAITING'): ?>
                                        <span class="font-weight-bold"><p class="text-danger text-center">UNPAID</p></span>
                                        <?php elseif($rows['fee_status'] == 'PAID'): ?>
                                        <span class="font-weight-bold"><p class="text-success text-center">PAID</p></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $number++;
                                    endwhile; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if($count_payment_row>0) { ?>
                    <div class="payment">
                        <div class="text-center mt-5">
                            <h3><b>List of Payment</b></h3>
                            <p><?php echo $mon_name.', '. $year?></p>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="thead-light">
                                        <th class="col-1 text-center">#</th>
                                        <th class="">Name</th>
                                        <th class="text-center">Amount (RM)</th>
                                    </tr>
                                </thead>

                            


                                <tbody>
                                    <?php 
                                        $total_amount=0;
                                        while($rows_fee=$payment->fetch_assoc()): ?>
                                    <tr >
                                        <td class="text-center"><?php echo $number_1 ?></td>
                                        <td><?php echo $rows_fee['child_name'] ?></td>
                                        <td class="text-center">
                                            <?php echo number_format($rows_fee['fee_amount'],2) ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        $number_1++;
                                        $total_amount=$total_amount+$rows_fee['fee_amount'];
                                        endwhile; 
                                    ?>

                                        <tr>
                                            
                                            <td colspan="2" class="text-right"><b>Total</b></td>
                                            <td class="text-center"><?php echo  number_format($total_amount,2) ?></td>
                                        </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>


                <?php }


                    //for outstanding bill
                    if($count_unpaid_row >= 1) { ?>
                        <div class="payment">
                            <div class="text-center mt-5">
                                <h3 class="pb-2"><b>List of Outstanding Payment</b></h3>
                                

                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="thead-light">
                                            <th class="col-1 text-center">#</th>
                                            <th class="">Name</th>
                                            <th class="">Number of Outstanding  </th>
                                            <th class="text-center">Total of Outstanding </th>
                                            <th class="text-center">Action</th>

                                        </tr>
                                    </thead>

                                


                                    <tbody>
                                        <?php 
                                            $number_3=1;
                                            while($rows_unpaid=$unpaid_fee->fetch_assoc()): ?>
                                        <tr >
                                            <td class="text-center"><?php echo $number_3 ?></td>
                                            <td><?php echo $rows_unpaid['child_name'] ?></td>
                                            <td class="text-center"><?php echo $rows_unpaid['count_unpaid'] ?></td>
                                            <td class="text-center">
                                                <?php echo number_format($rows_unpaid['sum_unpaid'],2) ?>
                                            </td>
                                            <td><a href="../phpmailer/index.php?child_id=<?php echo $rows_unpaid['child_id']?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Send reminder email">Remind</a></td>
                                        </tr>
                                        <?php 
                                            $number_3++;
                                            
                                            endwhile; 
                                        ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php }
                
                else{?>
                    <div class=" text-center pb-5" style="padding-top:30px; opacity: 0.5;">
                        <h1 class="pb-2">
                        
                        <lord-icon
                            src="https://cdn.lordicon.com/otyynlki.json"
                            trigger="loop"
                            style="width:150px;height:100px">
                        </lord-icon>
                        </h1>
                                <h4> <b>There is no report on <?php echo $mon_name.','.$year?></b></h4>       
                    </div>
                    <?php }?>