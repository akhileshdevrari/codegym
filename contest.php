<?php session_start(); 
  require"db.php";
  $username = $_SESSION["username"];
  $sql = "SELECT * FROM user WHERE username = '".$username."'";
  $result = $conn->query($sql);
  if($result->num_rows == 0 || $username=="")
    header("Location: ./index.php");

        if(!isset($_SESSION["num_id"]))
        {
              $sql = "SELECT * FROM problem
                      ORDER BY RAND()
                      LIMIT ".(int)$_SESSION["nquestions"];

              $_SESSION["num_id"] = 0;
              $_SESSION["problem_id"] = array();
              $_SESSION["title"] = array();
              $_SESSION["problem_statement"] = array();
              $_SESSION["input_text"] = array();
              $_SESSION["output_text"] = array();
              $_SESSION["sample_input"] = array();
              $_SESSION["sample_output"] = array();

              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc())
              {
                  array_push($_SESSION["problem_id"], $row["problem_id"]);
                  array_push($_SESSION["title"], $row["title"]);
                  array_push($_SESSION["problem_statement"], $row["problem_statement"]);
                  array_push($_SESSION["input_text"], $row["input_text"]);
                  array_push($_SESSION["output_text"], $row["output_text"]);
                  array_push($_SESSION["sample_input"], $row["sample_input"]);
                  array_push($_SESSION["sample_output"], $row["sample_output"]);
              }
        }
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
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/problem-statement.css" rel="stylesheet">


</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color: #0E1935">
    <div class="navbar-brand">Contest Page</div>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

         <?php 
              for ($i=0; $i < $_SESSION["nquestions"]; $i++)
              {
                ?>
                  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href= <?php echo "contest_meta.php?num_id=".$i ?> >
                      <span class="nav-link-text"> <?php echo $_SESSION["title"][$i];?>    </span>
                    </a> 
                  </li>
                <?php    
              }
        ?>  



      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
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
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Contest Page</li>
      </ol>
      <div class="row">
        <div class="col-12">
          <!-- <h2>Contest on <div class="topic"></div></h2> -->
          <div class="problemindexholder" problemindex="F">
            <div class="ttypography">
              <div class="problem-statement">
                <div class="header">
                  <div class="title"> <?php echo $_SESSION["title"][$_SESSION["num_id"]]; ?> </div>
                    <div class="property-title">Problem ID</div> <?php echo " ".$_SESSION["problem_id"][$_SESSION["num_id"]]; ?>
                  <div class="time-limit">
                    <div class="property-title">time limit per test</div>2 seconds
                  </div>
                  <div class="memory-limit">
                    <div class="property-title">memory limit per test</div>512 megabytes
                  </div>
                  <div class="input-file">
                    <div class="property-title">input</div>standard input
                  </div>
                  <div class="output-file">
                    <div class="property-title">output</div>standard output
                  </div>
                </div>
                <div>
                  <p>
                      <?php
                         echo $_SESSION["problem_statement"][$_SESSION["num_id"]]."<br><br>";
                         ?> <h5>Input</h5> <?php
                         echo $_SESSION["input_text"][$_SESSION["num_id"]]."<br><br>";
                         ?> <h5>Output</h5> <?php
                         echo $_SESSION["output_text"][$_SESSION["num_id"]]."<br><br>";
                         ?> <h5>Sample Input</h5> <?php
                         echo $_SESSION["sample_input"][$_SESSION["num_id"]]."<br><br>";
                         ?> <h5>Sample Output</h5> <?php
                         echo $_SESSION["sample_output"][$_SESSION["num_id"]]."<br><br>";
                      ?>
                  </p>
                  <form action="submit.php">
                      <input type="submit" value="Submit" id="submit" class="btn btn-primary", style="size:30px;padding: 12px; margin-bottom: 10px;">
                  </form>
                  <br>
                 </div></div></div></div><p>  </p></div> </div> 
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © CodeGym 2017</small>
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
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </div>
</body>

</html>