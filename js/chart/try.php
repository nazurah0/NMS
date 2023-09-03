<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js" integrity="sha512-Lii3WMtgA0C0qmmkdCpsG0Gjr6M0ajRyQRQSbTF6BsrVh/nhZdHpVZ76iMIPvQwz1eoXC3DmAg9K51qT5/dEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  <title>Document</title>
</head>
<body>

<?php 
include('../../db_connect.php');
 $attendance = $conn->query("SELECT DATE_FORMAT(attendance_date,'%a') AS attendance_date, COUNT(*) AS attendance_count from attendance GROUP BY attendance_date;");
 
 //loop

 foreach ($attendance as $row) {
 $date[] = $row['attendance_date'];
 $count[] = intval($row['attendance_count']);}
 $max_scale = max($count) +3;
 echo json_encode($max_scale);
?>


<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
 
  const labels =<?php echo json_encode($date)?>;
  const data = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
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
          max: 10
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

</body>
</html>