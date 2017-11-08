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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["calendar"]});
      google.charts.setOnLoadCallback(drawChart);

   function drawChart() {
       var dataTable = new google.visualization.DataTable();
       dataTable.addColumn({ type: 'date', id: 'Date' });
       dataTable.addColumn({ type: 'number', id: 'Won/Loss' });
       dataTable.addRows([
          [ new Date(2017, 3, 13), 37 ],
          [ new Date(2017, 3, 14), 38 ],
          [ new Date(2017, 3, 15), 38 ],
          [ new Date(2017, 9, 30), 38 ]
        ]);

       var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

       var options = {
         title: "Attendance",
         height: 350,
       };

       chart.draw(dataTable, options);
   }
    </script>
  </head>
  <body>
    <div id="calendar_basic" style="width: 1000px; height: 350px;"></div>
  </body>
</html>