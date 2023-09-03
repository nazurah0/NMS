<?php 

    include('../db_connect.php');

if(isset($_POST['request'])){

    $group_id=$_POST['request'];
    $child=$conn->query("SELECT * FROM child where group_id=$group_id ");
 ?>

<table>
    <thead>
        <tr>
            <th>name</th>
            <th>group</th>
        </tr>
    </thead>
    <tbody>
        
        <?php  
        
        while($row=$child->fetch_assoc()): 
        ?>
        <tr>
            <td><?php echo $row['child_name']; ?></td>
            <td><?php echo $row['group_id']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
    
<?php };?>
