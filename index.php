<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Welcome | CodeGym</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet" />
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="buttons">
    <a class="typewrite" data-period="2000" data-type='[ "Create your own contest!", "Practice what you want.", "Competitive environment at your fingertips", "Happy Coding :)" ]'>
      <span class="wrap"></span>
    </a>
    <span id="register-button" data-toggle="modal" data-target="#register-container">register</span>
    <span id="login-button" data-toggle="modal" data-target="#login-container">login</span>
  </div>
  <div class="introduction"> 
    <img src="images/logo.png">
    <div class="intro_text">
     <h2>Welcome to CodeGym
     </h2>
     <h3>The place to learn and grow at your own pace.</h3>
     <p>Just started programming?<br> Coding contests seem too hard?<br> Welcome to your new gym :)</p>
     <p>Here at CodeGym, you can customize contests according to your needs and learn at your pace. Register now to get started!</p>
   </div>
 </div>
 <div class="modals"  style="position: absolute;">
  <div id="loginerr">
    <?php
    if(isset($_SESSION["loginerr"]))
      if($_SESSION["loginerr"] != "")
        echo $_SESSION["loginerr"]."<br><br>";
      ?>
    </div>
    <div class="modal fade login-container" id="login-container">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <span class="close-btn">
              <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png">
            </span>
            <h3 class="modal-title">login</h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <!-- <div class="form"> -->
                <form action="login.php" method="post" enctype="multipart/form-data">
                  <input type="text" name="username" placeholder="username" required>
                  <input type="password" name="password" placeholder="password" required>
                  <input type="submit" value="Submit">
                  <input type="reset" value="Reset">
                  <div id="remember-container">
                   <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked">
                   <span>remember me</span>
                  </div>
                  <?php
                    if(isset($_SESSION["loginerr"]))
                      echo($_SESSION["loginerr"]);
                  ?>
               </form>
             <!-- </div> -->
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="modal fade register-container" id="register-container">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close-btn">
            <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png">
          </span>
          <h3 class="modal-title">register</h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- <div class="form"> -->
              <form action="register.php" method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="name" autocomplete="off" required>
                <input type="text" name="username" placeholder="username" autocomplete="off" required>
                <input type="email" name="email" placeholder="email" autocomplete="off" required>
                <input type="password" name="password" placeholder="password" autocomplete="off" required>
                <input type="password" placeholder="confirm password" autocomplete="off" required>
                <input type="file" name="photo">
                <?php
                    if(isset($_SESSION["register_err"]))
                      echo($_SESSION["register_err"]);
                ?>
                <div id="tnc-container">
                  <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/><span> I agree to terms and conditions</span><br>
                </div>
                <input type="submit" value="Submit"></a>
                <input type="reset" value="Reset"></a>
              </form>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
     
    </div>
  </div> 
  <div id="particles-js"></div>
</div>

<script>
  $(document).keyup(function(ev){
    if(ev.keyCode == 27)
      $("#register-container, #login-container, #forgotten-container").fadeOut(500);
  });
  $(".close-btn").click(function(){
    $("#login-container, #forgotten-container, #register-container").fadeOut(500);
  });
  /* Forgotten Password */
  $('#forgotten-button').click(function(){
    $("#login-container").fadeOut(500);
  });
</script>
<script type="text/javascript">
  var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
  };
  TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];
    if (this.isDeleting) {
      this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
      this.txt = fullTxt.substring(0, this.txt.length + 1);
    }
    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';
    var that = this;
    var delta = 200 - Math.random() * 100;
    if (this.isDeleting) { delta /= 2; }
    if (!this.isDeleting && this.txt === fullTxt) {
      delta = this.period;
      this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
      this.isDeleting = false;
      this.loopNum++;
      delta = 500;
    }
    setTimeout(function() {
      that.tick();
    }, delta);
  };
  window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++) {
      var toRotate = elements[i].getAttribute('data-type');
      var period = elements[i].getAttribute('data-period');
      if (toRotate) {
        new TxtType(elements[i], JSON.parse(toRotate), period);
      }
    }
       };
     </script>
     <script type="text/javascript" src="js/index.js"></script>
   </body>
   </html>