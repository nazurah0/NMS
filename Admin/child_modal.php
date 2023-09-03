<style>
    .img-section{
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;


}
  
  #display-image, #display-image-mother{
	
	height:220; width: 250px; 
	border: 1px solid #B4B9BC;
	background-position: center;
	background-size: cover;
	object-fit: cover;
	border-radius: 2%;
  }

  .form-label{
        font-weight: bold;
    }

</style>


<script>
        $(document).ready(function() {
    var mykid =document.getElementById('mykid');
    var result = document.getElementById('dob');
    var result2 = document.getElementById('age');
    var result3 = document.getElementById('gender');
    $('#mykid').keyup(function(){
        var Year = mykid.value.toString().substr(0, 2);
        var Month = mykid.value.toString().substr(2, 2)
        var Day = mykid.value.toString().substr(4, 2)
        var dob = '20' + Year + '-' + Month + '-' + Day;
        result.value=dob
    });
    $('#mykid').keyup(function(){
        var birthdate = new Date(result.value);
         var cur = new Date();
         var diff = cur-birthdate;
         var age = Math.floor(diff/31536000000);
         result2.value = age;
    });

    $('#mykid').keyup(function(){
        var gender = mykid.value.toString().substr(11, 2);
        if(gender%2==0)
        result3.value = "FEMALE";
        else
        result3.value = "MALE";
    });
 });
</script>


<?php $group = $conn->query("SELECT * from child_group "); ?>
<!-- Child Info Modal-->
<?php if(isset($row['child_id'])):?>

    <div class="modal fade" id="childModal<?php echo isset($row['child_id']) ? $row['child_id'] : '' ?>" tabindex="-1" role="dialog" aria-labelledby="childInfoModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
    
            <div class="modal-content" id="childDetail">

                <form action="handler/child_handler.php">
                    <div class="modal-header"> 
                            <h5 class='modal-title' id='childInfoModal'>Children Information</h5>

                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-4 row g-2"   >

                            <div class="col-md-12 text-center ">
                                <?php 
                                if (isset($row['child_id'])){
                                ?>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['child_image']); ?>" class="rounded mx-auto d-block mb-3" alt="..." width="200">
                                <?php }
                                
                                else{
                                ?>
                                <img src="../img/undraw_profile.svg" class="rounded mx-auto d-block mb-3" alt="..." width="200">
                                <?php }?>
                                <div class="text-center">

                                </div>
                            </div>



                    

                            <!--Child part-->
                            <div class="col-md-6">
                                <label for="child_name" class="form-label">Full Name</label>
                                <input name="child_name" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['child_name'] : '' ?>" id="child_name">
                            </div>

                            <div class="col-md-6">
                                <label for="child_myKidNum" class="form-label ">MyKid Number</label>
                                <input name="child_mykid" type="text" id="mykid" class="form-control" onkeypress="return isNumberKey(event)" maxlength = "12"  value="<?php echo isset($row['child_id']) ? $row['child_myKidNum'] : '' ?>" id="child_myKidNum">
                            </div>

                            <div class="col-md-6">
                                <label for="child_nickname" class="form-label mt-3">Nickname</label>
                                <input name="child_nickname" type="text" class="form-control" value="<?php echo isset($row['child_id']) ? $row['child_nickname'] : '' ?>" id="child_nickname">
                            </div>

                            <div class=" col-md-4" >
                                
                                <label for="child_gender" class="form-label mt-3">Gender</label>
                                <select id="gender" class="form-control" name="child_gender"  >
                                    <option >Select</option>
                                    <option value="MALE" <?php echo $row['child_gender'] == "MALE" ?  'selected="selected"': '' ?>>Male</option>
                                    <option value="FEMALE" <?php echo $row['child_gender'] == "FEMALE" ?  'selected="selected"': '' ?>>Female</option>
                                </select>  
                            
                            </div>

                            <div class="col-md-2">
                                <label for="child_age" class="form-label mt-3">Age</label>
                                <input name="child_age" id="age" type="text" class="form-control" onkeypress="return isNumberKey(event)"  value="<?php echo isset($row['child_id']) ? $row['child_age'] : '' ?>" id="child_age">
                            </div>

                            <div class="col-md-4">
                                <label for="child_DOB" class="form-label mt-3">Date of Birth</label>
                                <input name="child_dob" id="dob" type="date" class="form-control"  value="<?php echo isset($row['child_id']) ? $row['child_DOB'] : '' ?>" id="child_DOB">
                            </div>

                            <div class="col-md-4">
                                <label for="child_race" class="form-label mt-3">Race</label>
                                <select id="child_race" class="form-control" name="child_religion">
                                    <option selected disabled>Select</option>
                                    <option value="ISLAM" <?php echo $row['child_religion'] == "ISLAM" ?  'selected="selected"': '' ?>>Islam</option>
                                    <option value="CHRISTIAN" <?php echo $row['child_religion'] == "CHRISTIAN" ?  'selected="selected"': '' ?>>Christian</option>
                                    <option value="BUDDHA"<?php echo $row['child_religion'] == "BUDDHA" ?  'selected="selected"': '' ?>>Buddha</option>
                                    <option value="HINDU" <?php echo $row['child_religion'] == "HINDU" ?  'selected="selected"': '' ?>>Hindu</option>
                                    <option value="OTHER" <?php echo $row['child_religion'] == "OTHER" ?  'selected="selected"': '' ?>>Other</option>

                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="child_race" class="form-label mt-3">Race</label>
                                <select id="child_race" class="form-control" name="child_race">
                                    <option selected disabled>Select</option>
                                    <option value="MALAY" <?php echo $row['child_race'] == "MALAY" ?  'selected="selected"': '' ?>>Malay</option>
                                    <option value="CHINESE" <?php echo $row['child_race'] == "CHINESE" ?  'selected="selected"': '' ?>>Chinese</option>
                                    <option value="INDIAN"<?php echo $row['child_race'] == "INDIAN" ?  'selected="selected"': '' ?>>Indian</option>
                                    <option value="OTHER" <?php echo $row['child_race'] == "OTHER" ?  'selected="selected"': '' ?>>Other</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputPassword4" class="form-label mt-3">Group</label>
                                <select id="group_id" name="group_id" class="form-control" name="child_group">
                                <option >Select</option>
                                <?php while($row1=$group->fetch_assoc()): ?>
                                <option value="<?php echo $row1['group_id'] ?>" <?php echo $row['group_id']== $row1['group_id']? 'selected':'' ?>><?php echo $row1['group_name'] ?></option>
                                <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                
                                <a class="btn btn-info mt-3" target='_blank' href="handler/view.php?id=<?php echo $row['child_id'] ?>&type=pdf_mukid"> Attachment of MyKid</a>
                            
                            </div>

                            <div class="col-md-6">
                                
                                <a class="btn btn-info mt-3" target='_blank' href="handler/view.php?id=<?php echo $row['child_id'] ?>&type=pdf_certificate"> Attachment of Birth Certificate</a>
                            
                            </div>

                       


                            <!--parent part-->
                            <?php if($row['father_IC']!=NULL):?>  

                            <div class="col-md-12 mt-5">
                                <h4 class="text-dark "><b>Father/Guardian's Detail</b></h4>
                            </div>



                        
                            <div class="col-md-6">
                                <label for="parent_name" class="form-label mt-3">Father/Guardian Name</label>
                                <input name="father_name" type="text" class="form-control "  value="<?php echo isset($row['child_id']) ? $row['father_name'] : '' ?>" id="father_name">
                            </div>

                            
                            <div class="col-md-6">
                                <label for="parent_IC" class="form-label mt-3">Father/Guardian Identity Card</label>
                                <input name="father_ic" type="text" class="form-control " maxlength = "12" onkeypress="return isNumberKey(event)"  value="<?php echo isset($row['child_id']) ? $row['father_IC'] : '' ?>" id="father_IC">
                            </div>

                            <div class="col-md-6">
                                <label for="parent_phoneNum" class="form-label mt-3"> Father/Guardian Phone Number</label>
                                <input name="father_phone" type="text" class="form-control " maxlength = "10" onkeypress="return isNumberKey(event)"  value="<?php echo isset($row['child_id']) ? $row['father_phoneNum'] : '' ?>" id="father_phoneNum">
                            </div>

                            <div class="col-md-6">
                                <label for="parent_work" class="form-label mt-3">Father/Guardian Occupation</label>
                                <input name="father_work" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['father_work'] : '' ?>" id="father_work">
                            </div>
                            
                            <div class="col-md-12">
                                <label for="parent_workAddress" class="form-label mt-3">Father/Guardian Work Address</label>
                                <input name="father_wAddress" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['father_workAddress'] : '' ?>" id="father_workAddress">
                            </div>

                            <div class="col-md-12">
                                <a class="btn btn-info mt-3" target='_blank' href="handler/view.php?parent_id=<?php echo $row['parent_id']?>&type=father_copy"> Attachment of Father/Guardian's IC</a>
                            </div>

                            <?php 
                      
                            endif;

                            
                            ?>
                            <?php if($row['mother_IC']!=NULL){?>  
                            
                            <div class="col-md-12 mt-5">
                                <h4 class="text-dark "><b>Mother's Detail</b></h4>
                            </div>



                            <div class="col-md-6">
                                <label for="parent_name" class="form-label mt-3">Mother Name</label>
                                <input name="mother_name" type="text" class="form-control "  value="<?php echo isset($row['child_id']) ? $row['mother_name'] : '' ?>" id="mother_name">
                            </div>

                            
                            <div class="col-md-6">
                                <label for="parent_IC" class="form-label mt-3">Mother Identity Card</label>
                                <input name="mother_ic" type="text" class="form-control " maxlength = "12" onkeypress="return isNumberKey(event)"  value="<?php echo isset($row['child_id']) ? $row['mother_IC'] : '' ?>" id="mother_IC">
                            </div>

                           

                            <div class="col-md-6">
                                <label for="parent_phoneNum" class="form-label mt-3"> Mother Phone Number</label>
                                <input name="mother_phone" type="text" class="form-control " maxlength = "10" value="<?php echo isset($row['child_id']) ? $row['mother_phoneNum'] : '' ?>" id="mother_phoneNum">
                            </div>

                            <div class="col-md-6">
                                <label for="parent_work" class="form-label mt-3">Mother Occupation</label>
                                <input name="mother_work" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['mother_work'] : '' ?>" id="mother_work">
                            </div>

                            <div class="col-md-12">
                                <label for="parent_workAddress" class="form-label mt-3">Mother Work Address</label>
                                <input name="mother_wAddress" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['mother_workAddress'] : '' ?>" id="mother_workAddress">
                            </div>

                            <div class="col-md-12">
                                
                                <a class="btn btn-info mt-3" target='_blank' href="handler/view.php?parent_id=<?php echo $row['parent_id']?>&type=mother_copy"> Attachment of Mother's IC</a>
                            
                            </div>

                            <?php 
                   
                            }
                            ?>

                            <div class="col-md-12 mt-5">
                                <h5 class="text-dark "><b>Home Address's Detail</b></h5>
                            </div>
                    
                            <div class="col-md-12">
                                <label for="parent_address" class="form-label mt-3 ">Address</label>
                                <input name="parent_address" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['parent_address'] : '' ?>" id="parent_address">
                            </div>

                        
                            <div class="col-md-4">
                                <label for="parent_town" class="form-label mt-3">Town</label>
                                <input name="parent_town" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['parent_town'] : '' ?>" id="parent_town">
                            </div>

                            
                            <div class="col-md-4">
                                <label for="parent_postcode" class="form-label mt-3">Postcode</label>
                                <input name="parent_postcode" type="text" class="form-control " maxlength = "5"  onkeypress="return isNumberKey(event)"  value="<?php echo isset($row['child_id']) ? $row['parent_postcode'] : '' ?>" id="parent_postcode">
                            </div>

                            
                            <div class="col-md-4">
                                <label for="parent_state" class="form-label mt-3">State</label>
                                <select id="parent_state" class="form-control" name="parent_state">
                                    <option disabled selected>Select</option>
                                    <option value="Johor" <?php echo $row['parent_state']=='Johor' ? 'selected' : '' ?>>Johor</option>
                                    <option value="Kedah" <?php echo $row['parent_state']=='Kedah' ? 'selected' : '' ?> >Kedah</option>
                                    <option value="Kelantan"  <?php echo $row['parent_state']=='Kelantan' ? 'selected' : '' ?>>Kelantan</option>
                                    <option value="Malacca"  <?php echo $row['parent_state']=='Malacca' ? 'selected' : '' ?>>Malacca</option>
                                    <option value="Negeri Sembilan"  <?php echo $row['parent_state']=='Negeri Sembilan' ? 'selected' : '' ?>>Negeri Sembilan</option>
                                    <option value="Pahang"  <?php echo $row['parent_state']=='Pahang' ? 'selected' : '' ?>>Pahang</option>
                                    <option value="Penang"  <?php echo $row['parent_state']=='Penang' ? 'selected' : '' ?>>Penang</option>
                                    <option value="Penang"  <?php echo $row['parent_state']=='Penang' ? 'selected' : '' ?>>Perak</option>
                                    <option value="Perlis"  <?php echo $row['parent_state']=='Perlis' ? 'selected' : '' ?>>Perlis</option>
                                    <option value="Sabah"  <?php echo $row['parent_state']=='Sabah' ? 'selected' : '' ?>>Sabah</option>
                                    <option value="Sarawak"  <?php echo $row['parent_state']=='Sarawak' ? 'selected' : '' ?>>Sarawak</option>
                                    <option value="Selangor" <?php echo $row['parent_state']=='Selangor' ? 'selected' : '' ?>>Selangor</option>
                                    <option value="Terengganu" <?php echo $row['parent_state']=='Terengganu' ? 'selected' : '' ?>>Terengganu</option>
                                    <option value="Kuala Lumpur"  <?php echo $row['parent_state']=='Kuala Lumpur' ? 'selected' : '' ?>>Kuala Lumpur</option>
                                    <option value="Labuan"  <?php echo $row['parent_state']=='Labuan' ? 'selected' : '' ?>>Labuan</option>
                                    <option value="Putrajaya"  <?php echo $row['parent_state']=='Putrajaya' ? 'selected' : '' ?>>Putrajaya</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="parent_address" class="form-label mt-3 ">Email</label>
                                <input name="email" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['email'] : '' ?>" id="parent_address">
                            </div>

                            

                        



                            <!--Health part-->
                            <div class="col-md-12 mt-5">
                                <h5 class="text-dark "><b>Health's Detail</b></h5>
                            </div>

                            <div class="col-md-12">
                                <label for="health_problem" class="form-label mt-3 ">Health Problem</label>
                                <select id="child_health" class="form-control" name="child_health"  >
                                        <option selected disabled>Select</option>
                                        <option value="Yes" <?php echo $row['health_problem']=='Yes'?'Selected':'';?> >Yes</option>
                                        <option value="No" <?php echo $row['health_problem']!='Yes' ? 'Selected':'' ;?>  >No</option>
                                </select>                             
                            </div>

                            <?php  if( $row['health_problem']=='Yes' ):?>  

                                <div class="col-md-12">
                                    <label for="health_problem" class="form-label mt-3 ">Type of health problem</label>
                                    <textarea name="health_allergic_exp" class="form-control" id="" cols="100" rows="5"><?php echo $row['health_type'];?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <a class="btn btn-info mt-3" target='_blank' href="handler/view.php?id=<?php echo $row['child_id']?>&type=health_proof">Document from Hospital</a>

                                </div>
                            <?php endif; ?>


                                                        

                            <!--Emergency part-->
                            <div class="col-md-12 mt-5">
                                <h5 class="text-dark "><b>Emergency Contact's Detail</b></h5>
                            </div>

                            <div class="col-md-6">
                                <label for="contact_name" class="form-label mt-3">Contact Name</label>
                                <input name="contact_name" type="text" class="form-control " value="<?php echo isset($row['child_id']) ? $row['contact_name'] : '' ?>" id="contact_name">
                            </div>

                            <div class="col-md-6">
                                <label for="contact_phoneNum" class="form-label mt-3">Contact Number</label>
                                <input name="contact_phone" type="text" class="form-control " onkeypress="return isNumberKey(event)" maxlength = "10"  value="<?php echo isset($row['child_id']) ? $row['contact_phoneNum'] : '' ?>" id="contact_phoneNum">
                            </div>

                            <div class="col-md-12">
                                <label for="contact_relationship" class="form-label mt-3">Relationship with Children</label>
                                <input name="contact_relationship" type="text" class="form-control " value="<?php echo isset($row['child_id']) ?ucwords(strtolower ($row['contact_relationship'])) : '' ?>"  id="contact_phoneNum">
                            </div>



                        


                
                    </div>
                    <div class="modal-footer">

                        <?php 
                            $id=$row['child_id'];       

                            if ($row['child_registerStatus']=="WAITING"){

                            
                            echo "<button  class='btn btn-danger' type='button' data-dismiss='modal' href='#' data-toggle='modal' data-target='#deleteModal$id'>Reject</button>";
                            echo "<a href='handler/child_handler.php?status=ACCEPT&id=$id'class='btn btn-success' type='button' >Accept</a>";
                            } 

                            else{
                        
                               
                                echo "<a class='btn btn-danger' type='button' href='handler/child_handler.php?delete=$id' >Delete</a>" ;
                            }
                    ?>
                    </div>

                </form>
            
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- ------- -->
<?php if(!isset($row['child_id'])):?>

<div class="modal fade" id="childModal<?php echo isset($row['child_id']) ? $row['child_id'] : '' ?>" tabindex="-1" role="dialog" aria-labelledby="childInfoModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content" id="childDetail">

            <form action="handler/child_handler.php" method="POST" enctype="multipart/form-data">

            <div class="modal-header"> <b></b>
                        <h5 class='modal-title' id='childInfoModal'>New Registration</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
                <div class="modal-body m-4 row g-2"   >

                        <div class="col-md-12 mb-2 text-center img-section ">
                            <div>
                                <div id="display-image"></div>
                                <div class="custom-file mt-2 ">
                                <input type="file" class=" image-input custom-file-input" name="child_image" id="inputGroupFile04" accept="image/jpeg, image/png, image/jpg" style="width: 250px;" required>
                                <label class="custom-file-label text-left" for="inputGroupFile04">Choose file</label>
                            </div> 
                            </div>
                            <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p> 

                        </div>
                      



                

                        <!--Child part-->
                        <input type="hidden" name='new_register'>
                        <div class="col-md-6">
                            <label for="child_name" class="form-label">Name</label>
                            <input name="child_name" type="text" class="form-control "  id="child_name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="child_myKidNum" class="form-label ">MyKid Number</label>
                            <input name="child_mykid" id="mykid" type="text" class="form-control" maxlength = "12" onkeypress="return isNumberKey(event)"  id="child_myKidNum" required>
                        </div>

                        <div class="col-md-6">
                            <label for="child_nickname" class="form-label mt-3">Nickname</label>
                            <input name="child_nickname" type="text" class="form-control"  id="child_nickname" required>
                        </div>

                        <div class=" col-md-4" >
                            
                            <label for="child_gender" class="form-label mt-3">Gender</label>
                            <select id="gender" class="form-control" name="child_gender" required >
                                <option >Select</option>
                                <option value="MALE" >Male</option>
                                <option value="FEMALE" >Female</option>
                            </select>  
                        
                        </div>

                        <div class="col-md-2">
                            <label for="child_age" class="form-label mt-3">Age</label>
                            <input name="child_age"  id="age" type="text" class="form-control"   onkeypress="return isNumberKey(event)"  id="child_age" required>
                        </div>

                        <div class="col-md-4">
                            <label for="child_DOB" class="form-label mt-3">Date of Birth</label>
                            <input name="child_dob" id="dob" type="date" class="form-control"   id="child_DOB" required>
                        </div>

                        <div class="col-md-4">
                            <label for="child_race" class="form-label mt-3">Race</label>
                            <select id="child_race" class="form-control" name="child_religion" >
                                <option selected disabled>Select</option>
                                <option value="ISLAM" >Islam</option>
                                <option value="CHRISTIAN">Christian</option>
                                <option value="BUDDHA">Buddha</option>
                                <option value="HINDU" >Hindu</option>
                                <option value="OTHER" >Other</option>

                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="child_race" class="form-label mt-3">Race</label>
                            <select id="child_race" class="form-control" name="child_race" >
                                <option selected disabled>Select</option>
                                <option value="MALAY" >Malay</option>
                                <option value="CHINESE" >Chinese</option>
                                <option value="INDIAN">Indian</option>
                                <option value="OTHER" >Other</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="inputPassword4" class="form-label mt-3">Group</label>
                            <select id="group_id" name="group_id" class="form-control" name="child_group" required>
                            <option >Select</option>
                            <?php while($row1=$group->fetch_assoc()): ?>
                            <option value="<?php echo $row1['group_id'] ?>"><?php echo $row1['group_name'] ?></option>
                            <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="health_information" class="form-label mt-3">Attachment of MyKid</label>
                            <div class="custom-file">
                            <input name="child_copy_mykid" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"   accept="application/pdf"  required>
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                            <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p> 
                        
                        </div>

                        <div class="col-md-6">
                            <label for="health_information" class="form-label mt-3">Attachment of Birth Certificate</label>
                            <div class="input-group">
                            <div class="custom-file">
                            <input name="child_copy_birth" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  accept="application/pdf" required >
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div> 
                            </div>  
                            <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p>                      
                        </div>

                        

                    


                        <!--parent part-->
                       

                        <div class="col-md-12 mt-5">
                            <h4 class="text-dark "><b>Father/Guardian's Detail</b></h4>
                        </div>

                        <div class="col-md-12">
                            <label for="health_information" class="form-label mt-3">Attachment of Father/Guardian's IC </label>
                            <div class="custom-file">
                            <input name="father_copy_ic" type="file"class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  accept="application/pdf" >
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div> 
                            <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p> 
                        
                        </div>

                    
                        <div class="col-md-6">
                            <label for="parent_name" class="form-label mt-3">Father/Guardian Name</label>
                            <input name="father_name" type="text" class="form-control "   id="father_name">
                        </div>

                        
                        <div class="col-md-6">
                            <label for="parent_IC" class="form-label mt-3">Father/Guardian Identity Card</label>
                            <input name="father_ic" type="text" class="form-control "  id="father_IC" maxlength = "12" onkeypress="return isNumberKey(event)" >
                        </div>


                        <div class="col-md-6">
                            <label for="parent_phoneNum" class="form-label mt-3"> Father/Guardian Phone Number</label>
                            <input name="father_phone" type="text" class="form-control " onkeypress="return isNumberKey(event)" maxlength = "10" id="father_phoneNum">
                        </div>

                        <div class="col-md-6">
                            <label for="parent_work" class="form-label mt-3">Father/Guardian Occupation</label>
                            <input name="father_work" type="text" class="form-control "  id="father_work">
                        </div>
                        
                        <div class="col-md-12">
                            <label for="parent_workAddress" class="form-label mt-3">Father/Guardian Work Address</label>
                            <input name="father_wAddress" type="text" class="form-control "  id="father_workAddress">
                        </div>

                        
                        <div class="col-md-12 mt-5">
                            <h4 class="text-dark "><b>Mother's Detail</b></h4>
                        </div>

                        <div class="col-md-12">
                            <label for="health_information" class="form-label mt-3">Attachment of Mother's I </label>
                            <div class="custom-file">
                            <input name="mother_copy_ic" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  accept="application/pdf" >
                              <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                              
                            </div> 
                            <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p>                       
                        </div>

                        <div class="col-md-6">
                            <label for="parent_name" class="form-label mt-3">Mother Name</label>
                            <input name="mother_name" type="text" class="form-control "   id="mother_name">
                        </div>

                        
                        <div class="col-md-6">
                            <label for="parent_IC" class="form-label mt-3">Mother Identity Card</label>
                            <input name="mother_ic" type="text" class="form-control " onkeypress="return isNumberKey(event)"  maxlength = "12"  id="mother_IC">
                        </div>


                        <div class="col-md-6">
                            <label for="parent_phoneNum" class="form-label mt-3"> Mother Phone Number</label>
                            <input name="mother_phone" type="text" class="form-control " maxlength = "10" id="mother_phoneNum" onkeypress="return isNumberKey(event)" >
                        </div>

                        <div class="col-md-6">
                            <label for="parent_work" class="form-label mt-3">Mother Occupation</label>
                            <input name="mother_work" type="text" class="form-control "  id="mother_work">
                        </div>

                        <div class="col-md-12">
                            <label for="parent_workAddress" class="form-label mt-3">Mother Work Address</label>
                            <input name="mother_wAddress" type="text" class="form-control "  id="mother_workAddress">
                        </div>



                        <div class="col-md-12 mt-5">
                            <h5 class="text-dark "><b>Home Address's Detail</b></h5>
                        </div>
                
                        <div class="col-md-12">
                            <label for="parent_address" class="form-label mt-3 ">Address</label>
                            <input name="parent_address" type="text" class="form-control "  id="parent_address" required>
                        </div>

                    
                        <div class="col-md-4">
                            <label for="parent_town" class="form-label mt-3">Town</label>
                            <input name="parent_town" type="text" class="form-control "  id="parent_town" required>
                        </div>

                        
                        <div class="col-md-4">
                            <label for="parent_postcode" class="form-label mt-3">Postcode</label>
                            <input name="parent_postcode" type="text" class="form-control " maxlength = "5" onkeypress="return isNumberKey(event)"  id="parent_postcode" required>
                        </div>

                        
                        <div class="col-md-4">
                            <label for="parent_state" class="form-label mt-3">State</label>
                            <select id="parent_state" class="form-control" name="parent_state" required>
                                <option disabled selected>Select</option>
                                <option value="Johor" >Johor</option>
                                <option value="Kedah"  >Kedah</option>
                                <option value="Kelantan"  >Kelantan</option>
                                <option value="Malacca"  >Malacca</option>
                                <option value="Negeri Sembilan"  >Negeri Sembilan</option>
                                <option value="Pahang"  >Pahang</option>
                                <option value="Penang"  >Penang</option>
                                <option value="Penang"  >Perak</option>
                                <option value="Perlis"  >Perlis</option>
                                <option value="Sabah"  >Sabah</option>
                                <option value="Sarawak"  >Sarawak</option>
                                <option value="Selangor" >Selangor</option>
                                <option value="Terengganu" >Terengganu</option>
                                <option value="Kuala Lumpur"  >Kuala Lumpur</option>
                                <option value="Labuan"  >Labuan</option>
                                <option value="Putrajaya"  >Putrajaya</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                                <label for="parent_address" class="form-label mt-3 ">Email</label>
                                <input name="email" type="email" class="form-control "  id="email" required>
                            </div>

                        <!--Health part-->
                        <div class="col-md-12 mt-5">
                            <h5 class="text-dark "><b>Health's Detail</b></h5>
                        </div>

                        <div class="col-md-12">
                            <label for="health_problem" class="form-label mt-3 ">Health Problem</label>
                            <select id="child_health" class="form-control" name="child_health" required >
                                    <option >Select</option>
                                    <option value="Yes" >Yes</option>
                                    <option value="No" >No</option>
                            </select>                             
                        </div>

                     
                        <div class="col-md-12">
                            <label for="health_problem" class="form-label mt-3 ">If yes, what type of health problem</label>
                            <textarea name="health_allergic_exp" class="form-control" id="" cols="100" rows="5" ></textarea>
                        </div>

                        <div class="col-md-12">
                            <label for="health_problem" class="form-label mt-3 ">Document from Hospital</label>
                            <div class="custom-file">
                            <input name="health_allergic_doc" type="file" class="custom-file-input" id="inputGroupFile04" name="pdf_mykid"  accept="application/pdf" >
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                            <p style="font-size:14px"><i>*Image must be in jpeg/png/jpg format</i></p> 
                        </div>
                      


                        <!--Emergency part-->
                        <div class="col-md-12 mt-5">
                            <h5 class="text-dark "><b>Emergency Contact's Detail</b></h5>
                        </div>

                        <div class="col-md-6">
                            <label for="contact_name" class="form-label mt-3">Contact Name</label>
                            <input name="contact_name" type="text" class="form-control "  id="contact_name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="contact_phoneNum" class="form-label mt-3">Contact Number</label>
                            <input name="contact_phone" type="text" class="form-control " maxlength = "10" id="contact_phoneNum" onkeypress="return isNumberKey(event)" required>
                        </div>

                        <div class="col-md-12">
                            <label for="contact_relationship" class="form-label mt-3">Relationship with Children</label>
                            <input name="contact_relationship" type="text" class="form-control "  id="contact_phoneNum" required>
                        </div>



                    


            
                </div>           

            <div class="modal-footer">

                <button class='btn btn-success' type='submit' >Submit</button>
                
            </div>

            </form>
        
        </div>
    </div>
</div>

<?php endif; ?>
<!-- ------- -->

<div class="modal align-middle fade" id="deleteModal<?php echo isset($row['child_id']) ? $row['child_id'] : '' ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="handler/child_handler.php" method='POST'>
                    <div class="modal-body  my-3">

                        <div class="my-2">
                            <h4> Please State the Reason of Rejection </h4>  
                            <textarea type="text" class="form-control" id="inputPassword4" rows="3" name="child_rejectReason"></textarea>
                            <input type="hidden" class="form-control" id="inputPassword4" name="registerStatus" value="REJECT">
                            <input type="hidden" class="form-control" id="inputPassword4" name="id" value="<?php echo $row['child_id']  ?>">
                        </div>

                    </div>

                    <div class='modal-footer'>
                    

                        <button  class='btn btn-danger' type='submit' >  Reject</button>
                        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>

                    </div>

                </form>
                
                
            </div>
        </div>
</div>
<script>


    const image_input = document.querySelector(".image-input");
    image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
    });
    reader.readAsDataURL(this.files[0]);
    });

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}



</script>