<?php

include('includes/config.php');
include('includes/db.php');

if(isset($_POST['send_my_password'])){
    $email = mysqli_real_escape_string($db , $_POST['email']);

    $sql = "select * from users where email='$email'";
    $result = $db->query($sql);

    if($row = $result->fetch_assoc()){
        $password = $row['password'];

        if(mail($email , 'Your Password' , "Your password is : $password" , "From:oscarsalu@gmail.com")){
            header("Location:forgot_password.php?success=" . urlencode("Your password has been sent to your email address!!"));
            exit();
        }else { header("Location:forgot_password.php?err=" . urlencode("Could not send Your password at this time !!"));
            exit();
        }
    }else { header("Location:forgot_password.php?err=" . urlencode("Sorry there is no user with that email you have provided!!"));
            exit();
        }
}

?>
<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Technical university of kenya</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" background="images/patterns/6.png">
<!--Navigation Bar-->
<nav class="navbar navbar-custom navbar-fixed-top" id="navbar" role="navigation">
  <div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
          <i class="fa fa-bars"></i>
          <br>
          <br>
          <br>
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
                </button>
  <a href="index.php" class="navbar-brand page-scroll" id="text1"><div id="image1"></div></a>
  </div>
  <!--toggle display ends-->
  <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
  <!--placing menu to the right-->
    <ul class="nav navbar-nav navbar-right">
      <!--Drop Down Menu-->
      <li class="dropdown-toggle">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text">Home<span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
      <li><a href="index.php">Application Portal</a></li>
      <li><a href="tukenya.ac.ke">Technical University Of Kenya</a></li>
      <li><a href="#">Current students</a></li>
      <li><a href="#">Former students</a></li>
      </ul>
      </li>
      <!--DropDown Menu ends-->
      <li class="dropdown">
                      <a href="program" class="dropdown-toggle" data-toggle="dropdown" id="text">welcome<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                      <li><a href="available_course.php">Available programs</a></li>
                        <li><a href="program.php">course offered</a></li>
                        <li><a href="search_course.php">Search course</a></li>
                      </ul>
                    </li>
      <li><a href="login.php" id="text"><span class="glyphicon glyphicon-log-in"></span>  login</a></li>
      <li><a href="register.php" id="text"><span class="glyphicon glyphicon-user"></span>  Sign up</a></li>
      <li><a href="#about" id="text" class="page"><span class=" glyphicon-arrow-right"> FAQ</span></a></li>
      <!--menu ends-->
    </ul>
    <!--placing menu to the right ends-->
    </div>
  </div>
</nav>
<div class="container" id="text4">

<form action="forgot_password.php" method="post" style="margin-top:150px;">
<h2>Retrieve Password</h2>
<hr>
<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>

<?php if(isset($_GET['err'])) { ?>

<div class="alert alert-danger"><?php echo $_GET['err'];?></div>

<?php } ?>
<hr>
<div class="form-group">
<label for="exampleInputEmail1">Email address</label>
<input type="email" name="email" class="form-control" placeholder="Email" required>
</div>


<button type="submit" name="send_my_password" class="btn btn-default">Send My Password</button>
<a href="login.php" class="btn btn-danger" >Cancel</a>
</form>

</div>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p>Copyright &copy; Technical university of kenya 2016</p>
    </div>
</footer>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>

<!-- Google Maps API Key -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

<!-- Custom Theme JavaScript -->
<script src="js/main.js"></script>

</body>

</html>
