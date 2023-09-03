
 

<canvas id="financial-graph" width="150" height="50"></canvas>

<div class="card m-4 mt-4">

    <div class="card-body ">

        <div class="filter form-inline m-3">
            <label class="pr-2">Date </label>

            <select class="form-control ml-2 year-financial" id="year-financial" name="report-year">
                
                <?php
                $year=date('Y');
                $date = $conn->query("SELECT  DATE_FORMAT(fee_date,'%Y') AS fee_date2 FROM fee GROUP BY fee_date2 ");
                while($row1=$date->fetch_assoc()):
                ?>

                <option value='<?php echo $row1['fee_date2']; ?>' <?php echo $row1['fee_date2']==$year?'selected':'' ?> >
                    <?php echo $row1['fee_date2'] ?>
                </option>
                <?php endwhile; ?>
            </select>

            <select class="form-control month-financial ml-2 " id="month-financial" name="report-month">
                <option disabled selected="selected">Select</option>

                <?php
                $month=date('m');
                
                $date = $conn->query("SELECT DISTINCT DATE_FORMAT(fee_date,'%M') AS fee_date1,  MONTH(fee_date) AS fee_date2  FROM fee   GROUP BY fee_date2, fee_date1");
                while($row1=$date->fetch_assoc()):
                ?>

                <option value='<?php echo $row1['fee_date2']; ?>' >
                    <?php echo $row1['fee_date1'] ?>
                </option>
                <?php endwhile; ?>
            </select>

            

            

        </div>

        <div class="report">

            <div class='container-fee'>
                <?php 

                    $number_1 =1;
                    $number =1;
                    $group = $conn->query("SELECT * from child_group ");
                    $year = date('Y');
                    $month = date('m');
                    $mon_name = date("F", mktime(0, 0, 0, $month, 10));

                    $fee= $conn->query("SELECT *from 
                    fee f
                    JOIN child c ON c.child_id=f.child_id
                    WHERE year(f.fee_date)= $year AND month(f.fee_date)=$month
                    order by f.fee_status asc ");

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

                <?php if($count_payment_row >= 1) { ?>
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
                <?php }?>


                

                <?php 
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
                                        <td><a href="../phpmailer/remind_fee.php?child_id=<?php echo $rows_unpaid['child_id']?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Send reminder email">Remind</a></td>
                                    </tr>
                                    <?php 
                                        $number_3++;
                                        
                                        endwhile; 
                                    ?>

                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>


            </div>



        </div>
    </div>
</div>

<?php
    $year = date('Y');
    $total=array();
    for ($month = 1; $month <= 12; $month ++){
    $fee_unpaid="SELECT SUM(fee_amount) AS total_unpaid FROM fee WHERE fee_status ='UNPAID' AND month(fee_date)='$month' AND year(fee_date)='$year'" ;
    $fee_waiting="SELECT SUM(fee_amount) AS total_waiting  FROM fee WHERE fee_status ='WAITING' AND month(fee_date)='$month' AND year(fee_date)='$year'";
    $fee_paid="SELECT SUM(fee_amount) AS total_paid  FROM fee WHERE fee_status ='PAID' AND month(fee_date)='$month' AND year(fee_date)='$year'";
    $payment ="SELECT SUM(payment_amount) AS total_payment  FROM payment WHERE payment_status ='ACCEPT' AND month(payment_date)='$month' AND year(payment_date)='$year'";


    $query=$conn->query($fee_unpaid);
    $row=$query->fetch_array();

    $query1=$conn->query($fee_waiting);
    $row1=$query1->fetch_array();

    $query2=$conn->query($fee_paid);
    $row2=$query2->fetch_array();

    $query3=$conn->query($payment);
    $row3=$query3->fetch_array();

    $total_unpaid[]=$row['total_unpaid'] + $row1['total_waiting'] ;

    $total_paid[]=$row2['total_paid'];

    $total_payment[]=$row3['total_payment'];
    
    
    }

    $ujan = $total_unpaid[0];
    $ufeb = $total_unpaid[1];
    $umar = $total_unpaid[2];
    $uapr = $total_unpaid[3];
    $umay = $total_unpaid[4];
    $ujun = $total_unpaid[5];
    $ujul = $total_unpaid[6];
    $uaug = $total_unpaid[7];
    $usep = $total_unpaid[8];
    $uoct = $total_unpaid[9];
    $unov = $total_unpaid[10];
    $udec = $total_unpaid[11];

    $pjan = $total_paid[0];
    $pfeb = $total_paid[1];
    $pmar = $total_paid[2];
    $papr = $total_paid[3];
    $pmay = $total_paid[4];
    $pjun = $total_paid[5];
    $pjul = $total_paid[6];
    $paug = $total_paid[7];
    $psep = $total_paid[8];
    $poct = $total_paid[9];
    $pnov = $total_paid[10];
    $pdec = $total_paid[11];

    $paymentjan = $total_payment[0];
    $paymentfeb = $total_payment[1];
    $paymentmar = $total_payment[2];
    $paymentapr = $total_payment[3];
    $paymentmay = $total_payment[4];
    $paymentjun = $total_payment[5];
    $paymentjul = $total_payment[6];
    $paymentaug = $total_payment[7];
    $paymentsep = $total_payment[8];
    $paymentoct = $total_payment[9];
    $paymentnov = $total_payment[10];
    $paymentdec = $total_payment[11];

?>


<script type="text/JavaScript">
new Chart(document.getElementById("financial-graph"), {
    type: 'bar',
    data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [
        {
        label: "Unpaid",
        backgroundColor: "#FF2768",
        data: [ "<?php echo $ujan; ?>",
                "<?php echo $ufeb; ?>",
                "<?php echo $umar; ?>",
                "<?php echo $uapr; ?>",
                "<?php echo $umay; ?>",
                "<?php echo $ujun; ?>",
                "<?php echo $ujul; ?>",
                "<?php echo $uaug; ?>",
                "<?php echo $usep; ?>",
                "<?php echo $uoct; ?>",
                "<?php echo $unov; ?>",
                "<?php echo $udec; ?>" 
            ]
        },
        {
        label: "Paid",
        backgroundColor: "#05E0E9",
        data: [ "<?php echo $pjan; ?>",
                "<?php echo $pfeb; ?>",
                "<?php echo $pmar; ?>",
                "<?php echo $papr; ?>",
                "<?php echo $pmay; ?>",
                "<?php echo $pjun; ?>",
                "<?php echo $pjul; ?>",
                "<?php echo $paug; ?>",
                "<?php echo $psep; ?>",
                "<?php echo $poct; ?>",
                "<?php echo $pnov; ?>",
                "<?php echo $pdec; ?>" 
            ]
        }

    ]
    },
    options: {
    title: {
        display: true,
        text: 'Population growth (millions)'
    }
    }
});

new Chart(document.getElementById("financial-graph-payment"), {
    type: 'bar',
    data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [
        {
        label: "Payment" ,
        backgroundColor: "#FF2768",
        data: [ "<?php echo $paymentjan; ?>",
                "<?php echo $paymentfeb; ?>",
                "<?php echo $paymentmar; ?>",
                "<?php echo $paymentapr; ?>",
                "<?php echo $paymentmay; ?>",
                "<?php echo $paymentjun; ?>",
                "<?php echo $paymentjul; ?>",
                "<?php echo $paymentaug; ?>",
                "<?php echo $paymentsep; ?>",
                "<?php echo $paymentoct; ?>",
                "<?php echo $paymentnov; ?>",
                "<?php echo $paymentdec; ?>" 
            ]
        },
       

    ]
    },
    options: {
    title: {
        display: true,
        text: 'Population growth (millions)'
    }
    }
});

$(document).ready(function(){

$("#year-financial").on("change", function () {
    $('#month-financial  option').prop('selected', function() {
        return this.defaultSelected;
    });
});

$("#month-financial").on('change',function(){
    var value = $(this).val();
    var value2 = $("#year-financial").val();

    //alert(value);

    $.ajax({
        url:"ajax/fetch_financial.php",
        type:"POST",
        data:{request_year:value2, request_month:value},
        success:function(data){
            $('.container-fee').html(data);
        }
    });
});
});

</script>