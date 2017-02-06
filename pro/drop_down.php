<?php


session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');
include('includes/browser_os.php');
include('includes/access.php');

//security to ensure only those who have logged in can view page
if(!loggedin()){
    header("Location:login.php?err=" . urlencode ("please login!!"));
    exit();
}

$user = $_SESSION['user_email'];
$sql = "select * from users where email='$user'";

$result = $db->query($sql);

$row = $result->fetch_assoc();

$u_id=$row['u_id'];
$first = $row['firstname'];
$sur = $row['surname'];
$ref = $row['user_refno'];
$bday = $row['b_day'];
$image = $row['image'];
$id_no = $row['id_no'];
$pass=$row['password'];

if(!access($ref)){
    header("Location:profile.php?err=" . urlencode ("pay the registration fee or wait the bank details to be update!!"));
    exit();
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

    <!-- Custom Fonts 
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    
    <![endif]-->
    <script language="javascript" type="text/javascript">
<!--
function menu_goto( menuform )
{
    

    var baseurl = "http://localhost/pro" ;
    selecteditem = menuform.newurl.selectedIndex ;
    newurl = menuform.newurl.options[ selecteditem ].value ;
    if (newurl.length != 0) {
      location.href = baseurl + newurl ;
    }
}
//-->
</script>

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
      <li><a href="index.php#about" id="text" class="page"><span class=" glyphicon-arrow-right"> FAQ</span></a></li>
      <!--menu ends-->
    </ul>
    <!--placing menu to the right ends-->
    </div>
  </div>
</nav>
<div class="jumbotron">
<div class="container" style="margin-top:150px;">
<div class="container text-center">
<fieldset>
<legend><p> Please select your Certification</p> </legend>
<form action="dummyvalue">
<div class="form-group">
<select class="form-control" name="newurl" onchange="menu_goto(this.form)">
<option value="" selected="selected">----- Select Certificate-----</option>
<option value="/inputdipl.php"> DIPLOMA </option>
<option value="/form.php"> KCSE </option>
<option value="/inputkneccert.php"> KNEC Certificate </option> 
</select>
</div>
</form>
</div>
</fieldset>
</div>
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

<!-- Custom Theme JavaScript -->
<script src="js/main.js"></script>

</body>

</html>
