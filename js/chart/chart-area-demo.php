

<?php 


  $attendance = $conn->query("SELECT DATE_FORMAT(attendance_date,'%d %b') AS attendance_date, attendance_status, COUNT(*) AS attendance_count from attendance WHERE attendance_status='PRESENT' GROUP BY attendance_date   ORDER BY attendance_date DESC  LIMIT 5;" );
  
  //loop
  $data = array();
  foreach ($attendance as $row) {
  $date[] = $row['attendance_date'];
  $count[] =intval($row['attendance_count']);}
  $max_scale = max($count) +2;
  
?>


<script type="text/JavaScript">
 

 
const labels =<?php echo json_encode($date)?>;
  const data = {
  labels: labels,
  datasets: [{
    label:'' ,
    data: <?php echo json_encode($count)?>,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          min: 0,
          max: <?php echo json_encode($max_scale) ?>
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myAreaChart'),
    config
  );
</script>