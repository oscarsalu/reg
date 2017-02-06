<?php
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');

//redirect logged in user to his account
if(loggedin()){
    header("Location:profile.php");
    exit();
}

//query to confirm if similar email exist
function isUnique($email){
    $ask = "select * from users where email='$email'";
    global $db;

    $result = $db->query($ask);

    if($result->num_rows > 0){
        return false;
    }
    else return true;
}
//query ends here


if(isset($_POST['register'])){
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['id_no'] = $_POST['id_no'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['confirm_password'] = $_POST['confirm_password'];


    //alerts
    if(strlen($_POST['name'])<3){
        header("Location:register.php?err=" . urlencode("The name must be atleast 3 characters long"));
        exit();
    }
    else if ($_POST['password'] != $_POST['confirm_password']){
        header("Location:register.php?err=" . urlencode("The password and confirm password don't match"));
        exit();
    }
    else if (strlen($_POST['password'])<5){
        header("Location:register.php?err=" . urlencode("The password should be atleast 5 characters"));
        exit();
    }
    else if(strlen($_POST['confirm_password'])<5){
        header("Location:register.php?err=" . urlencode("The confirm password should be atleast 5 characters"));
        exit();
    }
    else if(!isUnique($_POST['email'])){
        header("Location:register.php?err=" . urlencode("The Email has already been used. Please use another one"));
        exit();
    }
    //alerts end here

    //inserting  users into database
    else {
        $name = mysqli_real_escape_string($db , $_POST['name']);
        $id_no = mysqli_real_escape_string($db , $_POST['id_no']);
        $email = mysqli_real_escape_string($db , $_POST['email']);
        $password = mysqli_real_escape_string($db , $_POST['password']);
        $token = bin2hex(openssl_random_pseudo_bytes(32));

        $sql = "insert into users (name,id_no,email,password,token) values('$name','$id_no','$email','$password','$token')";
        $suc=$db->query($sql);
        if ($suc) {
          //inserting user into ends here
        //sending email
        $message = "Hi $name! Account created here is the activation link http://localhost/registration/activate.php?token=$token";

        mail($email , 'Activate account' , $message , 'From: oscarsalu@gmail.com' );
        header("Location:myaccount.php?success=" . urlencode("Activation Email Sent! Please complete the form below first before activation to get your Refrence number"));
        exit();
        } else
        header("Location:register.php?err=" . urlencode("Try again later!!"));

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

    <title>Technical university</title>

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
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" background="images/patterns/13.png">
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
      <li class="active"><a href="register.php" id="text"><span class="glyphicon glyphicon-user"></span>  Sign up</a></li>
      <li><a href="#about" id="text" class="page"><span class=" glyphicon-arrow-right"> FAQ</span></a></li>
      <!--menu ends-->
    </ul>
    <!--placing menu to the right ends-->
    </div>
  </div>
</nav>
<div class="container">
<!-- form starts here-->
<form action="register.php" method="post" style="margin-top:150px;">
<h2> Sign up here</h2>
<hr>
<!-- calling alert from php on top-->
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>
<!--alert ends-->
<hr>
<div class="form-group">
<label>Name</label>
<input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo @$_SESSION['name'];?>" required>
</div>
<div class="form-group">
<label>ID Number</label>
<input type="number" name="id_no" class="form-control" placeholder="id number" value="<?php echo @$_SESSION['id_no'];?>">
</div>
<div class="form-group">
<label for="exampleInputEmail1">Email address</label>
<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo @$_SESSION['email'];?>" required>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo @$_SESSION['password'];?>" required>
</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo @$_SESSION['confirm_password'];?>" required>
</div>

<button type="submit" name="register" class="btn btn-default">Register</button>
</form>
<!-- form ends here-->
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
<script type="text/javascript" src=""></script>

<!-- Custom Theme JavaScript -->
<script src="js/main.js"></script>

</body>

</html>
