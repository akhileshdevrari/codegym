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
  <!--<img src="images/logo.png" style="height: auto;width: 10%"> -->
  <div style="padding: 5px;">
    <div class="introduction">
      <h1> Hello! </h1>
      <h2>Welcome to CodeGym
      </h2>
      <h3>this is codegym</h3>
      <p>You asked me if we were in the meth business or the money business. Neither, I’m in the empire business. I was under the impression that you had this under control. Well, that's what this is - problem solving. Skyler this is a simple division of labor - I bring in the money, you launder the money. This is what you wanted.</p>
    </div>
  </div>
  <div class="buttons">
    <span id="login-button">login
    </span>
    <span id="register-button">register
    </span>
    <div id="container">
      <h1>log in</h1>
      <span class="close-btn">
        <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
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
            <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/>
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
    $('#login-button').click(function(){
      $('#login-button').fadeOut("slow",function(){
        $("#container").fadeIn();
      });
    });

    $('#register-button').click(function(){
      $('#register-button').fadeOut("slow",function(){
        $("#container2").fadeIn();
      });
    });

    $(".close-btn").click(function(){
      $("#container, #forgotten-container").fadeOut(800, function(){
        $("#login-button").fadeIn(800);
      });
    });
    $(".close-btn2").click(function(){
      $("#container2").fadeOut(800, function(){
        $("#register-button").fadeIn(800);
      });
    });
    /* Forgotten Password */
    $('#forgotten').click(function(){
      $("#container").fadeOut(function(){
        $("#forgotten-container").fadeIn();
      });
    });
  </script>
  <script type="text/javascript" src="js/index.js"></script>
</body>
</html>