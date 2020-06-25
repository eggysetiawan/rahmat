<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<body>

  <div class="container">
    <div class="col-md-8">


      <div class="c1">
        <div class="c11">
          <img class="mainhead" src="image/logoipi.png">
          <p class="mainp">Just click the buttons below to toggle between SignIn & SignUp</p>
        </div>
        <div id="left">
          <h1 class="s1class"><span>SIGN</span><span class="su">IN</span>
          </h1>
        </div>

        <div id="right">
          <h1 class="s2class"><span>SIGN</span><span class="su">UP</span></h1>
        </div>
      </div>
      <br>


      <div class="c2">
        <form class="signup">
          <h1 class="signup1">SIGN UP</h1>
          <br><br>
          <input name="username" type="text" placeholder="Username*" class="username" /><br>
          <input name="email" type="text" placeholder="Email*" class="username" /><br>
          <input name="password" type="password" placeholder="Password*" class="username" /><br>
          <button class="btn">Sign Up</button>
        </form>

        <form class="signin">
          <h1 class="signup1">SIGN IN</h1>
          <br><br>
          <input name="username" type="text" placeholder="Username*" class="username" /><br>
          <input name="password" type="password" placeholder="Password*" class="username" /><br>
          <button class="btn">Get Started</button>
          <br><br><br><br>
          <a href="">
            <p class="signup2">Forget Password?</p>
          </a>
        </form>
      </div>


    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".container").fadeIn(1000);
      $(".s2class").css({
        "color": "#EE9BA3"
      });
      $(".s1class").css({
        "color": "#748194"
      });
      $("#left").removeClass("left_hover");
      $("#right").addClass("right_hover");
      $(".signin").css({
        "display": "none"
      });
      $(".signup").css({
        "display": ""
      });
    });
    $("#right").click(function() {
      $("#left").removeClass("left_hover");
      $(".s2class").css({
        "color": "#EE9BA3"
      });
      $(".s1class").css({
        "color": "#748194"
      });
      $("#right").addClass("right_hover");
      $(".signin").css({
        "display": "none"
      });
      $(".signup").css({
        "display": ""
      });
    });
    $("#left").click(function() {
      $(".s1class").css({
        "color": "#EE9BA3"
      });
      $(".s2class").css({
        "color": "#748194"
      });
      $("#right").removeClass("right_hover");
      $("#left").addClass("left_hover");
      $(".signup").css({
        "display": "none"
      });
      $(".signin").css({
        "display": ""
      });
    });
  </script>
</body>

</html>