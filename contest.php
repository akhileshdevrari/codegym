<?php session_start(); 
require"db.php";
$username = $_SESSION["username"];
$sql = "SELECT * FROM user WHERE username = '".$username."'";
$result = $conn->query($sql);
if($result->num_rows == 0 || $username=="")
  header("Location: ./index.php");
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
  <style>
  #finish{
    border:1px #0E1935 white;
    border-radius: 5px;
    color:white;
    cursor: pointer;
  }

  #finish:hover{
    color:#0E1935;
    background: white;
  }
  #logout{
    border:1px #0E1935 white;
    border-radius: 5px;
    color:white;
    cursor: pointer;
  }

  #logout:hover{
    color:#0E1935;
    background: white;
  }
  </style>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color: #0E1935">
    <div class="navbar-brand">Contest ID <?php echo $_SESSION["contest_id"] ?></div>
    <div id="divCounter" class="navbar-brand"></div>
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
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" id="finish" data-toggle="modal" data-target="#finishModal">
          Finish Contest
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="logout" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Logout
        </a>
      </li>
    </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#" data-toggle="modal" data-target="#finishModal">Dashboard</a>
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
                    <div class="property-title">tags </div> <?php echo $_SESSION["tag"][$_SESSION["num_id"]] ?>
                  </div>
                  <div class="output-file">
                    <div class="property-title">output</div><?php echo $_SESSION["difficulty"][$_SESSION["num_id"]] ?>
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
                  <!-- <a class="nav-link" data-toggle="modal" data-target="#exampleModal"> -->
                  <?php
                  if($_SESSION["downloaded"][$_SESSION["num_id"]] == 0)
                  { ?>
                    <span onclick="myFunction()" class="btn btn-primary" style="size:30px;padding: 5px; margin-bottom: 10px; cursor: pointer;">I solved</span>
                  <?php } ?>



                  <?php
                    if($_SESSION["downloaded"][$_SESSION["num_id"]] == 1)
                        echo "<br>Result:  ".$_SESSION["result"][$_SESSION["num_id"]]."<br>";
                  ?>

                  <!-- 
                  <form action="submit.php" method="post" enctype="multipart/form-data">
                      <input type="submit" value="Submit Output" id="submit" class="btn btn-primary", style="size:30px;padding: 5px; margin-bottom: 10px;">
                      <input type="file" name="submission" id="submission" required>
                  </form>
                  <br> -->



                  <!-- <?php
                  //if($_SESSION["downloaded"][$_SESSION["num_id"]] == 1)
                    {
                          //$filename = "input/".$_SESSION["problem_id"][$_SESSION["num_id"]].".txt'";
                     ?>

                    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            maje mei hai sab
                          </div>
                          <div class="modal-body">
                            <a href="download_input.php" class="btn btn-primary" style="size:30px;padding: 5px; margin-bottom: 10px;">Download Input</a>
                          </div>
                          <?php 
                           // header("Location: download_input.php");
                          ?>
                          <form action="submit.php" method="post" enctype="multipart/form-data">
                            <input type="submit" value="Submit Output" id="submit" class="btn btn-primary", style="size:30px;padding: 5px; margin-bottom: 10px;">
                            <input type="file" name="submission" id="submission" required>
                          </form>
                          <div class="modal-footer">
                           tu hee jane tu kya sochta hai bawre
                         </div>
                       </div>
                     </div>
                   </div>
                 <?php  }



                 //if($_SESSION["result"][$_SESSION["num_id"]] != "")
                  //echo "Result:  ".$_SESSION["result"][$_SESSION["num_id"]]."<br>";
                ?> -->



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
        <div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="finishModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="modal-body">Dear <?php echo $_SESSION["username"] ?>, your current score is <?php echo($_SESSION["final_score"]) ?> <br>Click 'Exit' to end the contest.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="after_contest.php">Exit</a>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="ioModal" aria-labelledby="ioModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              </div>
              <div class="modal-body">
                <div id="problem_timer"></div>
                    <a download  <?php echo "href = 'input/".$_SESSION["problem_id"][$_SESSION["num_id"]].".txt'" ?> class="btn btn-primary" style="size:30px;padding: 5px; margin-bottom: 8px;">Download Input</a><br>
                  <form id="submitForm" action="submit.php" method="post" enctype="multipart/form-data">
                    <input type="button" onclick="call_submit()" style="size:30px;padding: 5px;" value="Submit Output" class="btn btn-primary">
                    <input type="file" name="submission" id="submission" required>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="timeUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="modal-body">Dear <?php echo $_SESSION["username"] ?>, your current score is <?php echo($_SESSION["final_score"]) ?> <br>Click 'Exit' to end the contest here.</div>
              <div class="modal-footer">
                <a class="btn btn-primary" href="after_contest.php">Exit</a>
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


    <script>
      //var hoursleft = 0;
      var minutesleft =  <?php echo($_SESSION["duration"]) ?>  ; //give minutes you wish
      var secondsleft = 0; // give seconds you wish
      var finishedtext = "Time's Up!";
      var end1;

      
      if(localStorage.getItem("end1")) {
        end1 = new Date(localStorage.getItem("end1"));
      } else {
        end1 = new Date();
        end1.setMinutes(end1.getMinutes()+minutesleft);
        end1.setSeconds(end1.getSeconds()+secondsleft);
      }

      <?php
      if(!isset($_SESSION["contest_started"])) 
        { ?>
          end1 = new Date();
          end1.setMinutes(end1.getMinutes()+minutesleft);
          end1.setSeconds(end1.getSeconds()+secondsleft);
          <?php 
          $_SESSION["contest_started"] = 1;
        }
        ?>

        var counter = function () {
          var now = new Date();
          var diff = end1 - now;

          diff = new Date(diff);

          var milliseconds = parseInt((diff%1000)/100)
          var sec = parseInt((diff/1000)%60)
          var mins = parseInt((diff/(1000*60)))
          // var hours = parseInt((diff/(1000*60*60))%24);

          if (mins < 10) {
            mins = "0" + mins;
          }
          if (sec < 10) { 
            sec = "0" + sec;
          }     
          if(now >= end1) {     
            clearTimeout(interval);
         // localStorage.setItem("end", null);
         localStorage.removeItem("end1");
         localStorage.clear();
         document.getElementById('divCounter').innerHTML = finishedtext;
         $('#timeUpModal').modal();
       } else {
        var value = mins + ":" + sec;
        localStorage.setItem("end1", end1);
        document.getElementById('divCounter').innerHTML = "Contest Ends in "+value;
      }
    }
    var interval = setInterval(counter, 1000);
</script>


<script>
function myFunction() {
    if (confirm("Ready to submit the input? A timer will start for 3 min!") == true) {
        timer();
        $('#ioModal').modal({backdrop: 'static', keyboard: false});
    }
  }

</script>

<script>
    var interval1;
      //var hoursleft = 0;
      function timer(){
      var minutesleft1 =  3; //give minutes you wish
      var secondsleft1 = 0; // give seconds you wish
      var finishedtext1 = "Time's Up Modal!";
      var end2;
      var notice = "Allowed Upload time left: ";

      
      if(localStorage.getItem("end2")) {
        end2 = new Date(localStorage.getItem("end2"));
      } else {
        end2 = new Date();
        end2.setMinutes(end2.getMinutes()+minutesleft1);
        end2.setSeconds(end2.getSeconds()+secondsleft1);
      }

        var counter1 = function () {
          var now1 = new Date();
          var diff1 = end2 - now1;

          diff1 = new Date(diff1);

          var milliseconds1 = parseInt((diff1%1000)/100)
          var sec1 = parseInt((diff1/1000)%60)
          var mins1 = parseInt((diff1/(1000*60)))
          // var hours = parseInt((diff/(1000*60*60))%24);

          if (mins1 < 10) {
            mins1 = "0" + mins1;
          }
          if (sec1 < 10) { 
            sec1 = "0" + sec1;
          }     
          if(now1 >= end2) {    
             //document.getElementById('problem_timer').innerHTML = now1+"  "+end2;
             clearTimeout(interval1);
            //  // localStorage.setItem("end", null);
              localStorage.removeItem("end2");
            //  //localStorage.clear();
                 window.location.href= "submit.php";
       } else {
        var value1 = mins1 + ":" + sec1;
        localStorage.setItem("end2", end2);
        document.getElementById('problem_timer').innerHTML = notice+value1;
      }
    }
    interval1 = setInterval(counter1, 1000);
  }
</script>

<script type="text/javascript">
  function call_submit(){
     clearTimeout(interval1);
    localStorage.removeItem("end2");
    // window.location.href= "submit.php";
    document.getElementById("submitForm").submit();
  }
</script>

</body>

</html>