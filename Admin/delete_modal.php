<?php if(isset($row['group_id'])):?>
<div class="modal align-middle fade" id="deleteModal<?php echo $row['group_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-body text-center my-3">
                    <div class="my-2">
                        <h1 class="my-4"><svg xmlns="http://www.w3.org/2000/svg"  height="60" fill="#F32013" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
</svg></i></h1>
                        <h4> <b>The data will be delete permanently! </b></h4>       
                        <p> Are You Sure Want to Delete the Data?</p>
                    </div>

                    <div>
                    <a href="handler/mgt_group_handler.php?id=<?php echo $row['group_id'] ?>"><button class="btn btn-danger" type="submit"  value="submit" >Delete</button></a>
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                    </div>

                </div>
                
                
            </div>
        </div>
</div>
<?php endif; ?>

<?php if(isset($row['staff_id'])):?>
<div class="modal align-middle fade" id="deleteModal<?php echo $row['staff_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-body text-center my-3">
                    <div class="my-2">
                        <h1 class="my-4"><svg xmlns="http://www.w3.org/2000/svg"  height="60" fill="#F32013" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
</svg></i></h1>
                        <h4> <b>The data will be delete permanently! </b></h4>       
                        <p> Are You Sure Want to Delete the Data?</p>
                    </div>

                    <div>
                    <a href="handler/mgt_staff_handler.php?id=<?php echo $row['staff_id'] ?>"><button class="btn btn-danger" type="submit"  value="submit" >Delete</button></a>
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                    </div>

                </div>
                
                
            </div>
        </div>
</div>
<?php endif; ?>