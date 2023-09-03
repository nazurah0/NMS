<?php 

$group = $conn->query("SELECT group_name, COUNT(*) AS group_count from child c JOIN child_group g ON c.group_id = g.group_id WHERE c.child_registerStatus='ACCEPT' GROUP BY c.group_id;" );
$data = array();
foreach ($group as $row) {
$gname[] = $row['group_name'];
$gcount[] =intval($row['group_count']);}
?>

<script>


// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode($gname)?>,
    datasets: [{
      data: <?php echo json_encode($gcount)?>,
      backgroundColor: [
      'rgb(255, 99, 132,0.2)',
      'rgb(54, 162, 235,0.2)',
      'rgb(255, 205, 86,0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],

    borderWidth: 1,

    hoverOffset: 4,
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
</script>