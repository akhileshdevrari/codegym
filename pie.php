<?php session_start(); 
  require"db.php";

  unset($_SESSION["num_id"]);

  $username = $_SESSION["username"];
  $sql = "SELECT * FROM user WHERE username = 'alien_x'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
?>

<html>
  <head>
  <?php echo $row["correct_answers"]; ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['AC',    <?php echo $row["correct_answers"]; ?> ],
          ['Wrong',      <?php echo $row["wrong_answers"]; ?>],
          ['Compilation',  <?php echo $row["compilation_error"]; ?>],
          ['runtime_error', <?php echo $row["runtime_error"]; ?>],
          ['TLE',    <?php echo $row["time_limit_exceeded"]; ?>]
        ]);

        var options = {
          title: 'Performance',
          pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
