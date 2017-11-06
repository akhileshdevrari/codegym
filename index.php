<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet" />
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="buttons">
  <a href="" style="background-color: black; font-family: sans-serif; display: inline-block; font-size: 25px; text-align: left; margin-left: 30px; color: #eee; vertical-align: middle;" class="typewrite" data-period="2000" data-type='[ "Generate your own contest!", "Practice what you want.", "Be your own judge.", "All the Best!" ]'>
    <span class="wrap"></span>
  </a>
  <span id="login-button" data-toggle="modal" data-target="#container">login
  </span>
  <span id="register-button" data-toggle="modal" data-target="#container2">register
  </span>
</div>
<div class="introduction">
 <h1><b> CodeGym </b></h1>
 <h2>Welcome to CodeGym
 </h2>
 <h3>this is codegym</h3>
 <p>You asked me if we were in the meth business or the money business. Neither, I’m in the empire business. I was under the impression that you had this under control. Well, that's what this is - problem solving. Skyler this is a simple division of labor - I bring in the money, you launder the money. This is what you wanted.</p>
</div>
<div class="modals"  style="position: absolute;">
  <div id="container">
    <h1>log in</h1>
    <span class="close-btn">
      <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png">
    </span>
    <?php
    if(isset($_SESSION["loginerr"]))
      if($_SESSION["loginerr"] != "")
        echo $_SESSION["loginerr"]."<br><br>";
      ?>
      <form action="login.php" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="submit">
        <div id="remember-container">
          <input type="checkbox" id="checkbox-2-1" class="checkbox" style="float: left;" checked="checked"/>
          <span id="remember">remember me</span>
          <span id="forgotten">forgotten password</span>
        </div>
      </form>
    </div>

    <div id="container2">
      <h1>register</h1>
      <span class="close-btn2">
        <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
      </span>
      <form action="register.php" method="post">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="username" placeholder="username">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" placeholder="confirm password">
        <input type="file" name="photo">
        <div id="tnc-container">
          <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/><span style="color:#eee;"> I agree to terms and conditions</span><br />
        </div>
        <input type="submit"></a>
      </form>
    </div>

    <!-- Forgotten Password Container -->
    <div id="forgotten-container">
      <h1>forgotten</h1>
      <span class="close-btn">
        <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
      </span>
      <form>
        <input type="email" name="email" placeholder="email">
        <a href="#" class="orange-btn">get new password</a>
      </form>
    </div>
  </div>
  <div id="particles-js"></div>
</div>

<script>
  $(document).keyup(function(ev){
    if(ev.keyCode == 27)
      $("#container, #container2, #forgotten-container").fadeOut(800);
  });
  $('#login-button, #register-button').hover(function(){
    $(this).toggleClass("kachra");
  });
  $('#login-button').click(function(){
    $("#container").fadeIn(800);
  });

  $('#register-button').click(function(){
    $("#container2").fadeIn(800);
  });

  $(".close-btn").click(function(){
    $("#container, #forgotten-container").fadeOut(800);
  });
  $(".close-btn2").click(function(){
    $("#container2").fadeOut(800);
  });
  /* Forgotten Password */
  $('#forgotten').click(function(){
    $("#container").fadeOut(function(){
      $("#forgotten-container").fadeIn(500);
      $("#forgotten-container").modal();
    });
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
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>
<script type="text/javascript" src="js/index.js"></script>
</body>
</html>