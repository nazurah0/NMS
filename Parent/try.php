<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
 
  <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
</head>
<body>
    
<?php 


include('../db_connect.php');
$group=$conn->query("SELECT * FROM child_group ")


?>

<select class="form-control" id="child-id">
    <option value=0>Select Name</option>
    <?php  while($row1=$group->fetch_assoc()): ?>
    <option value='<?php echo $row1['group_id']; ?>' >
    <?php echo $row1['group_name'] ?>
    </option>
    <?php endwhile; ?>
</select>

<div class="container" id="container">
    <table>
        <thead>
            <tr>
                <th>name</th>
                <th>group</th>
            </tr>
        </thead>
        <tbody>
            
            <?php  
            $child=$conn->query("SELECT * FROM child ");
            while($row=$child->fetch_assoc()): 
            ?>
            <tr>
                <td><?php echo $row['child_name']; ?></td>
                <td><?php echo $row['group_id']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
     $(document).ready(function(){
                    $("#child-id").on('change',function(){
                        var value = $(this).val();
                        //alert(value);

                        $.ajax({
                            url:"fetch.php",
                            type:"POST",
                            data: 'request='+value,
                            success:function(data){
                                $(".container").html(data);
                            }
                        });
                    });
                });
        
</script>

</body>
</html









