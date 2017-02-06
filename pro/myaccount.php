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
//query to confirm if the email exist
function isAvailable($email){
    $ask = "select * from users where email='$email'";
    global $db;

    $result = $db->query($ask);

    if($result->num_rows == 1){
        return true;
    }
    else return false;
}
//query ends here

  if(isset($_POST['update'])){
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['surname'] = $_POST['surname'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['birthday'] = $_POST['birthday'];

    //alerts
    if(strlen($_POST['firstname'])<3){
        header("Location:myaccount.php?err=" . urlencode("The name must be atleast 3 characters long"));
        exit();

        }
        else if(strlen($_POST['surname'])<3){
        header("Location:myaccount.php?err=" . urlencode("The name must be atleast 3 characters long"));
        exit();

        }
        else if(!isAvailable($_POST['email'])){
        header("Location:myaccount.php?err=" . urlencode("The Email does not exist. Please use the one you registered with!!"));
        exit();
    }//alerts end here
        //inserting  users into database
    else {
        $firstname = mysqli_real_escape_string($db , $_POST['firstname']);
        $surname = mysqli_real_escape_string($db , $_POST['surname']);
        $email = mysqli_real_escape_string($db , $_POST['email']);
        $gender=$_POST['gender'];
        $b_day=$_POST['birthday'];
        $ref=bin2hex(openssl_random_pseudo_bytes(3));


        $insert = "UPDATE users SET firstname='$firstname',surname='$surname',gender='$gender',image='default.jpg',b_day='$b_day',user_refno='REF$ref' WHERE email='$email'" ;

        $success=$db->query($insert);
        if($success){
            mkdir("applicant/REF$ref");
            $sql3 = "insert into status (user_refno) values ('REF$ref')";
            $db->query($sql3);
            header("Location:login.php?success=" . urlencode(" Your reference number is REF$ref"));
        exit();
            }else header("Location:myaccount.php?err=" . urlencode("There is something wrong with the server try again later"));
        exit();
        }//inserting user into ends here

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
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
      <li><a href="logout.php" id="text"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      <!--menu ends-->
    </ul>
    <!--placing menu to the right ends-->
    </div>
  </div>
</nav>
<div class="container" style="margin-top:150px;">
<!-- display user_name session variable -->
<!-- calling alert from php on top-->
<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>
<!--alert ends-->

<div class="jumbotron" id="text4">
<h3>Additional information in order to aquire your Reference Number</h3>
<form action="myaccount.php" method="post">
<div class="form-group">
<label>First Name</label>
<input type="text" name="firstname" class="form-control" placeholder="Enter your firstname"value="<?php echo @$_SESSION['firstname'];?>" required>
</div>
<div class="form-group">
<label>Surname</label>
<input type="text" name="surname" class="form-control" placeholder="Enter your surname"value="<?php echo @$_SESSION['surname'];?>" required>
</div>
<div class="form-group">
<label>Email</label>
<input type="text" name="email" class="form-control" placeholder="Enter your email you used to register"value="<?php echo @$_SESSION['email'];?>" required>
</div>
<div class="form-group">
<label for="gender">Gender</label>
<select class="form-control" name="gender">
<option value="male">male</option>
<option value="female">female</option>
</select>
</div>
<div class="form-group">
<label>Birthday</label>
<input type="date" name="birthday" class="form-control" placeholder="Enter your birthday" value="<?php echo @$_SESSION['birthday'];?>" required>
</div>
<button type="update" name="update" class="btn btn-default">Update information</button>
</form>
</div>
<!--end of display-->
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
