<?php session_start(); 
  require"db.php";

  unset($_SESSION["num_id"]);

  $username = $_SESSION["username"];
  $sql = "SELECT * FROM user WHERE username = '".$username."'";
  $result = $conn->query($sql);
  if($result->num_rows == 0 || $username=="")
    header("Location: ./index.php");
  $row = $result->fetch_assoc();
  $num_submissions =  ($row["correct_answers"]+$row["wrong_answers"]+$row["time_limit_exceeded"]+$row["runtime_error"]+$row["compilation_error"]);
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/home.css" rel="stylesheet">

  


  <!-- my pie chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Result', 'Submissions'],
          ['Time Limit Exceeded',    <?php echo $row["time_limit_exceeded"]; ?>],
          ['Runtime Error', <?php echo $row["runtime_error"]; ?>],
          ['Compilation Error',  <?php echo $row["compilation_error"]; ?>],
          ['Correct Answers',    <?php echo $row["correct_answers"]; ?> ],
          ['Wrong Answers',      <?php echo $row["wrong_answers"]; ?>]
        ]);

        if (data.getValue(0,1) + data.getValue(1,1) + data.getValue(2,1) + data.getValue(3,1) + data.getValue(4,1) == 0) {
           opt_pieslicetext='none';
           opt_tooltip_trigger='none'
           data.setCell(3,1,.0001);
        } 

        var options = {
          title: 'Performance',
          pieSliceText: 'value',
          sliceVisibilityThreshold:0
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>


    <!-- my calender chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
          google.charts.load("current", {packages:["calendar"]});
          google.charts.setOnLoadCallback(drawChart);

       function drawChart() {
           var dataTable = new google.visualization.DataTable();
           dataTable.addColumn({ type: 'date', id: 'Date' });
           dataTable.addColumn({ type: 'number', id: 'Won/Loss' });
           dataTable.addRows([
                <?php  
                    $sql = "SELECT UNIX_TIMESTAMP(submission_date) as 'epoch_time', COUNT(*) AS 'num' FROM submissions WHERE username = '".$username."' GROUP BY submission_date";
                    $tresult = $conn->query($sql);
                    while($trow = $tresult->fetch_assoc())
                    { ?>
                      [ new Date(<?php echo 1000*$trow["epoch_time"] ?>), <?php echo $trow["num"] ?>],
                  <?php  }
                ?>
            ]);

           var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

           var options = {
             title: "Attendence",
             height: 250,  
           };

           chart.draw(dataTable, options);
       }
    </script>


  <style> 
    .profile{
      height: 13em;
      text-align:center;
      background: #D3D3D3;
      padding: 7px;
      width: 750px;
      margin-left:auto;
      margin-right:auto;
    }
    .profile-details {
      display: inline-block;
      vertical-align: middle;
      padding: 8px;
      border-radius: 5px;
      background-color: #ffffff;
      color: #333;
      box-shadow: 10px 10px 5px #888888;
    }
    .profile-photo{
      display: inline-block;
    }
    .profile-photo img {
      max-height: 12em;
      width: auto;
    }
    #calendar_basic{
      width:920px;
      margin-left: auto;
      margin-right: auto;
    }
    .high_light{
      color: #006600
    }
  </style>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color: #0E1935">
    <span class="navbar-brand"><?php echo $username; ?> </span>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
  <br>
  <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
  <div class="contest-form">
    <div class="row">
      <div class="container">
        <div>
          <div class="form-area">  
            <form role="form" action="pre_contest.php" method="post">
              <h2 style="text-align: center;">Let's have one more contest</h2>
              <div class="field">
              Duration of Contest (in minutes):
                <input name="duration" required>
              </div>
              <div class="field">
              No. of Questions:
              <select id="nquestions" name="nquestions" onchange="populateFields()">
                <option disabled selected hidden>--select a number--</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
              </div>
              <div id="spaceForQuestions">
              </div>
              <input type="submit" value="Submit" id="submit" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br><br>
  <hr>
  <div class="profile">
    <div class="profile-photo">
        <img src= <?php echo $row["image_path"]; ?> alt="Profile photo">
    </div>
    <div class="profile-details">
      <span class="high_light"> Username: </span><?php echo $row["username"]; ?> <br>
      <span class="high_light"> Name: </span><?php echo $row["name"]; ?> <br>
      <span class="high_light"> Email: </span><?php echo $row["email"]; ?> <br>
      <span class="high_light"> Submissions: </span><?php echo $num_submissions; ?> <br>
      <span class="high_light"> Problems Solved: </span><?php echo $row["problems_solved"]; ?> <br>
    </div>
  </div>
  <hr>

      <br><br>
      <!-- my calender chart -->
      <div id="calendar_basic"></div>
      <!-- my pie chart :) -->
      <div id="piechart" style="margin-left: auto;margin-right: auto; width: 900px; height: 400px;"></div>

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Submissions</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Submission_ID</th>
                  <th>Contest_ID</th>
                  <th>Problem_ID</th>
                  <th>Problem</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Submission_ID</th>
                  <th>Contest_ID</th>
                  <th>Problem_ID</th>
                  <th>Problem</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </tfoot>
              <tbody>
                <?php  
                    $sql = "SELECT * FROM submissions WHERE username = '".$username."' ORDER BY submission_date DESC";
                    $tresult = $conn->query($sql);
                    while($trow = $tresult->fetch_assoc())
                    { ?>
                      <tr>
                        <td> <?php echo $trow["submission_id"]; ?> </td>
                        <td> <?php echo $trow["contest_id"]; ?> </td>
                        <td> <?php echo $trow["problem_id"]; ?> </td>
                        <td> <?php echo $trow["problem_title"]; ?> </td>
                        <td> <?php echo $trow["status"]; ?> </td>
                        <td> <?php echo $trow["submission_date"]; ?> </td>
                      </tr>
                    <?php  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <script>
  function populateFields(){
        document.getElementById("spaceForQuestions").innerHTML = "";
    var x = document.getElementById("nquestions").value;
        for (i = 1; i <= x; i++){
            document.getElementById("spaceForQuestions").innerHTML += "<div style='margin-left:30%;'>Q" + i + "<select style='border-radius: 5px; margin-top:4px; margin-bottom:4px; margin-left:18px;' name='difficulty" + i + "'><option disabled selected hidden>--difficulty--</option><option value='easy'>easy</option><option value='medium'>medium</option><option value='hard'>hard</option></select><input type='text' placeholder='tag' style='border-radius: 5px; margin:4px;' name='tag" + i + "' required></div><br>";
        }
  }
  </script>
  </div>
</body>

</html>
