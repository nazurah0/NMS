<?php 
     
    include('../../db_connect.php');                           
                           
     session_start();                               
    $parent_id=$_SESSION['id'];
    $child_id=$_POST['child_id'];
    $fee=$conn->query("SELECT f.*,c.child_id FROM 
    fee f 
    JOIN child c ON f.child_id = c.child_id
    WHERE c.child_id=$child_id;")



    ?>

    <div class="nav nav-pills nav-fill" id="v-pills-tab" role="tablist">
        <a class="nav-link active" id="v-pills-messages-fee" data-toggle="pill" href="#v-pills-fee" role="tab" aria-controls="v-pills-fee" aria-selected="true">Fee</a>
        <a class="nav-link" id="v-pills-payment-tab" data-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">Payment</a>
    </div>
    <div class="tab-content  pt-5" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-fee" role="tabpanel" aria-labelledby="v-pills-fee-tab">
            <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="thead-light">
                        <th class="col-1"># </th>
                        <th class="col-3">Description</th>
                        <th class="col-2 text-center">Fee (RM)</th>
                        <th class="col-2 text-center">Paid (RM)</th>
                        <th class="col-2 text-center">Balance (RM)</th>
                        <th class="col-1">Status</th>
                        <th class="col-1 text-center">Action</th>
                        
                    </tr>
                </thead>

                


                <tbody>
                <?php  while($row2=$fee->fetch_assoc()): ?>
                    <tr>

                        <td><?php echo $row2['invoice_no'] ?></td>

                        
                        

                        <td>
                            <p><?php echo $row2['fee_desc'] ?></p>
                        </td>

                        <td class="text-center">
                            <p><?php echo number_format( $row2['fee_amount'],2) ?></p>
                        </td>
                        <td class="text-center">
                            <p><?php 
                            
                            $paid=$row2['fee_amount']-$row2['remain_paid'];
                            echo number_format($paid,2) ?></p>
                        </td>

                        <td class="text-center">
                            
                            <p>
                            <?php 
                            
                            echo number_format($row2['remain_paid'] ,2)?></p>
                        </td>


                        <td>
                            <?php if($row2['fee_status'] == 'UNPAID'): ?>
                            <span class="font-weight-bold"><p class="text-danger text-center">UNPAID</p></span>
                            <?php elseif($row2['fee_status'] == 'PAID'): ?>
                            <span class="font-weight-bold"><p class="text-success text-center">PAID</p></span>
                            <?php elseif($row2['fee_status'] == 'WAITING'): ?>
                            <span class="font-weight-bold"><p class="text-info text-center">REVIEW</p></span>
                            <?php endif; ?>
                        </td>

                        <td >
                            <div class="text-center">
                                <?php if($row2['fee_status'] == 'PAID'){?>
                        <a target='_blank'
                       href='pdf_generator.php?id=<?php echo $row2['fee_id']?>' >
                        <button class='btn btn-outline-secondary' 

                        <?php echo $row2['fee_status'] == 'WAITING'? 'disabled':''?> 
                        > 
                       Invoice
                        </button></a>
                        <?php
                        }
                         else if($row2['fee_status'] == 'UNPAID'){ ?>
                                <div class="dropdown show">
                                <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pay
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item"  data-toggle='modal' data-target='#payModal<?php echo $row2['fee_id']?>' href="#">Cash</a>
                                    <a class="dropdown-item"  data-toggle='modal' data-target='#onlineBankingModal<?php echo $row2['fee_id']?>' href="#">Online Banking</a>
                                </div>
                                </div>
                            <?php };?>
                        </div>

                        <?php include 'payment_modal.php'?>
                       
                        </td>
                        
                        

                    </tr>
                   
                <?php endwhile; ?>
                
                

                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
            <?php 
                $parent_id=$_SESSION['id'];
                $child_id=$_POST['child_id'];
                $payment=$conn->query("SELECT t.*, p.*,f.*,c.* FROM 
                fee f 
                JOIN child c ON f.child_id = c.child_id
                JOIN parent t ON t.parent_id = c.parent_id 
                JOIN payment p ON p.fee_id = f.fee_id
  
                WHERE c.child_id=$child_id"
                )
            ?>
            <table class="table table-bordered display" id="dataTable5" width="100%" cellspacing="0">
                    <thead>
                        <tr class="thead-light">
                            <th class="col-1"># </th>
                            <th class="col-1">Date</th>
                            <th class="col-4 text-center">Description</th>
                            <th class="col-3 text-center">Paid By </th>
                            <th class="col-1 text-center">Payment (RM)</th>
                            <th class="col-1 text-center">Status</th>
                            <th class="col-1 text-center">Action</th>
                            
                        </tr>
                    </thead>

                    


                    <tbody>
                    <?php  while($row3=$payment->fetch_assoc()): ?>
                        <tr>

                            <td><?php echo $row3['invoice_no'] ?></td>

                            <td class="col-2">
                                <p><?php echo $row3['payment_date'] ?></p>
                            </td>
                            

                            <td class="col-4">
                                <p><?php echo $row3['fee_desc'] ?></p>
                            </td>

                            
                            <td class="col-3">
                                <p><?php echo $row3['father_name']!=NULL ||  $row3['father_name']!='' ?  $row3['father_name'] : $row3['mother_name'] ?></p>
                            </td>

                            <td class="text-center">
                                
                                <p><?php 
                                
                                echo number_format( $row3['payment_amount'],2)?></p>
                            </td>


                            <td>
                                <?php if($row3['payment_status'] == 'REJECT'): ?>
                                <span class="font-weight-bold"><p class="text-danger text-center">REJECT</p></span>
                                <?php elseif($row3['payment_status'] == 'ACCEPT'): ?>
                                <span class="font-weight-bold"><p class="text-success text-center">ACCEPT</p></span>
                                <?php elseif($row3['payment_status'] == 'WAITING'): ?>
                                <span class="font-weight-bold"><p class="text-info text-center">WAITING</p></span>
                                <?php endif; ?>
                            </td>
                            
                            <td class="text-center">

                            <a  target="_blank" href="pdf_receipt.php?id=<?php echo $row3['payment_id']?>"  > <button class='btn btn-outline-secondary' <?php echo $row3['payment_status'] != 'ACCEPT'? 'disabled':''?> > RECEIPT </button> </a>
                            </td>
                            

                        </tr>
                    <?php endwhile; ?>
                    
                    

                    </tbody>
            </table>
        </div>
        
    </div>



    <script>
        $(document).ready(function() {
    $('#dataTable').DataTable();
    $('#dataTable5').DataTable();
  

    
} );
    </script>
