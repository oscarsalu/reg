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

if(isset($_POST['add_grade'])){

  $_SESSION['skul'] = $_POST['skul'];
  $_SESSION['math'] = $_POST['math'];
  $_SESSION['english'] = $_POST['english'];
  $_SESSION['kiswahili'] = $_POST['kiswahili'];
  $_SESSION['biology'] = $_POST['biology'];
  $_SESSION['chemistry'] = $_POST['chemistry'];
  $_SESSION['physics']=$_POST['physics'];
  $_SESSION['history']=$_POST['history'];
  $_SESSION['geography']=$_POST['geography'];
  $_SESSION['cre']=$_POST['cre'];
  $_SESSION['home_science']=$_POST['home_science'];
  $_SESSION['art']=$_POST['art'];
  $_SESSION['agric']=$_POST['agric'];
  $_SESSION['aviation']=$_POST['aviation'];
  $_SESSION['computer']=$_POST['computer'];
  $_SESSION['metal']=$_POST['metal'];
  $_SESSION['wood']=$_POST['wood'];
  $_SESSION['building']=$_POST['building'];
  $_SESSION['power']=$_POST['power'];
  $_SESSION['electricity']=$_POST['electricity'];
  $_SESSION['french']=$_POST['french'];
  $_SESSION['german']=$_POST['german'];
  $_SESSION['arabic']=$_POST['arabic'];
  $_SESSION['music']=$_POST['music'];
  $_SESSION['sign']=$_POST['sign'];
  $_SESSION['business']=$_POST['business'];

  $school = mysqli_real_escape_string($db , $_POST['skul']);
  $math=$_POST['math'];
  $english=$_POST['english'];
  $kiswahili=$_POST['kiswahili'];
  $biology=$_POST['biology'];
  $chemistry=$_POST['chemistry'];
  $physics=$_POST['physics'];
  $history=$_POST['history'];
  $geography=$_POST['geography'];
  $cre=$_POST['cre'];
  $home_science=$_POST['home_science'];
  $art=$_POST['art'];
  $agric=$_POST['agric'];
  $aviation=$_POST['aviation'];
  $computer=$_POST['computer'];
  $metal=$_POST['metal'];
  $wood=$_POST['wood'];
  $building=$_POST['building'];
  $power=$_POST['power'];
  $electricity=$_POST['electricity'];
  $french=$_POST['french'];
  $german=$_POST['german'];
  $arabic=$_POST['arabic'];
  $music=$_POST['music'];
  $sign=$_POST['sign'];
  $business=$_POST['business'];
  $mean_grade=$_POST['mean_grade'];
  

   $up = "INSERT INTO applicant (user_refno, school, math, english, kiswahili, biology, chemistry, physics, history, geography, cre, home_science, art, agric, avaiation, computer, metal, wood, building, power, electricity, french, german, arabic, music, sign, business, mean_grade) VALUES ('$ref','$school','$math','$english','$kiswahili','$biology','$chemistry','$physics','$history','$geography','$cre','$home_science','$art','$agric','$aviation','$computer','$metal','$wood','$building','$power','$electricity','$french','$german','$arabic','$music','$sign','$business','$mean_grade')";

  $ree= $db->query($up);
      if($ree){
                  echo "<script>alert('Your profile is updated!')</script>";
                  header("Location:course.php?success=" . urlencode(" Your grades have been successfully submitted"));
              exit();
                  }else header("Location:form.php?err=" . urlencode("There is something wrong with the server try again later"));
              exit();



  }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-t" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" 8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewporcontent="">

    <title><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} else echo $_COOKIE['user_name']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.php" class="navbar-brand page-scroll" id="text1"><div id="image2"></div></a>
                </li>
                <div style="margin-top:20px;">
                <li class="dropdown-toggle">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text">Home<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li><a href="index.php">Application Portal</a></li>
                <li><a href="tukenya.ac.ke">Technical University Of Kenya</a></li>
                <li><a href="#">Current students</a></li>
                <li><a href="#">Former students</a></li>
                </ul>
                </li>
                <li class="dropdown">
                      <a href="program" class="dropdown-toggle" data-toggle="dropdown" id="text">welcome<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                      <li><a href="available_course.php">Available programs</a></li>
                        <li><a href="program.php">course offered</a></li>
                        <li><a href="search_course.php">Search course</a></li>
                      </ul>
                    </li>
                <li><a href="profile.php" id="text" class="page"><span class=" glyphicon glyphicon-home">Hi <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} else echo $_COOKIE['user_name']; ?>!</span></a></li>
                <li><a href="logout.php" id="text"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <li>
                <form method="get" action="results.php" id="form">
                <input type="search" name="search" class="text-lowercase" id="text1" placeholder="search your course"/>  <span class="glyphicon glyphicon-search"></span>
                </form>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                 <li>
                    <?php echo "<small>$browser-$os</small>";?>
                </li>
                </div>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
         <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                        <div>
<!-- calling alert from php on top-->
<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>
<hr>
<!--alert ends-->
<!--edit profile starts here-->
<p>please click <a href='course.php'>NEXT</a> if you already filled the form</p>
<div class="jumbotron">
<h1>Please fill in the form below.</h1>
<h3><b style="color:red;">For subjects not done leave blank or don't select any grade</b></h3>
<hr>
<div class="row">
    <div class="col-md-12 col-lg-12">
<form action="form.php" method="post" class="form-horizontal">
<div class="form-group">
<label class="col-sm-4">School Name</label>
<div class="col-sm-6">
<input type="text" name="skul" class="form-control" placeholder="Enter Your high school name" required="required" value="<?php echo @$_SESSION['skul'];?>" >
</div>
</div>
<div class="form-group">
<label class="col-sm-4">REF number</label>
<div class="col-sm-6">
<input type="text" name="surname" class="form-control" value="<?php echo $ref;?>" readonly="readonly">
</div>
</div><br>
<h4><u>Group one subjects</u></h4>
<div class="form-group">
<label for="math" class="col-sm-4">MATHEMATICS</label>
<div class="col-sm-6">
<select class="form-control" name="math">
<option value="0" selected="selected" class="col-md-4 col-lg-4"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="english" class="col-sm-4">ENGLISH</label>
<div class="col-sm-6">
<select class="form-control" name="english" class="col-sm-8 col-xs-8">
<option value="0"  selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="kiswahili" class="col-sm-4">KISWAHILI</label>
<div class="col-sm-6">
<select class="form-control" name="kiswahili" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div><br>
<h4><u>Group 2 subjects<u></h4>
<div class="form-group">
<label for="biology" class="col-sm-4">BIOLOGY</label>
<div class="col-sm-6">
<select class="form-control" name="biology" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="chemistry" class="col-sm-4">CHEMISTRY</label>
<div class="col-sm-6">
<select class="form-control" name="chemistry" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="physics" class="col-sm-4">PHYSICS</label>
<div class="col-sm-6">
<select class="form-control" name="physics" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div><br>
<h4><u>Group 3 subjects<u></h4>
<div class="form-group">
<label for="history" class="col-sm-4">HISTORY AND GOVERNMENT</label>
<div class="col-sm-6">
<select class="form-control" name="history" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="geography" class="col-sm-4">GEOGRAPHY</label>
<div class="col-sm-6">
<select class="form-control" name="geography" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="c_h_ire" class="col-sm-4">CRE/IRE/HRE</label>
<div class="col-sm-6">
<select class="form-control" name="cre" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div><br>
<h4><u>Group 4 subjects<u></h4>
<div class="form-group">
<label for="home_science" class="col-sm-4">HOME SCIENCE</label>
<div class="col-sm-6">
<select class="form-control" name="home_science" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="art" class="col-sm-4">ART AND DESIGN</label>
<div class="col-sm-6">
<select class="form-control" name="art" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="agric"class="col-sm-4">AGRICULTURE</label>
<div class="col-sm-6">
<select class="form-control" name="agric" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="aviation" class="col-sm-4">AVIATION TECHNOLOGY</label>
<div class="col-sm-6">
<select class="form-control" name="aviation" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="computer" class="col-sm-4">COMPUTER</label>
<div class="col-sm-6">
<select class="form-control" name="computer" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="metal" class="col-sm-4">METAL WORK</label>
<div class="col-sm-6">
<select class="form-control" name="metal" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="wood" class="col-sm-4">WOOD WORK</label>
<div class="col-sm-6">
<select class="form-control" name="wood" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="building" class="col-sm-4">BUILDING CONSTRUCTION</label>
<div class="col-sm-6">
<select class="form-control" name="building" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="power" class="col-sm-4">POWER MECHANICS</label>
<div class="col-sm-6">
<select class="form-control" name="power" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div>
<div class="form-group">
<label for="electricity" class="col-sm-4">ELECTRICITY</label>
<div class="col-sm-6">
<select class="form-control" name="electricity" class="col-sm-8 col-xs-8">
<option value="0" selected="selected"></option>
<option value="12">A</option>
<option value="11">A-</option>
<option value="10">B+</option>
<option value="9">B</option>
<option value="8">B-</option>
<option value="7">C+</option>
<option value="6">C</option>
<option value="5">C-</option>
<option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
</select>
</div>
</div><br>
<h4><u>Group 5 subjects<u></h4>
  <div class="form-group">
  <label for="french" class="col-sm-4">FRENCH</label>
  <div class="col-sm-6">
  <select class="form-control" name="french" class="col-sm-8 col-xs-8">
  <option value="0" selected="selected"></option>
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
  </select>
  </div>
</div>
  <div class="form-group">
  <label for="german" class="col-sm-4">GERMAN</label>
  <div class="col-sm-6">
  <select class="form-control" name="german" class="col-sm-8 col-xs-8">
  <option value="0" selected="selected"></option>
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
  </select>
</div>
  </div>
  <div class="form-group">
  <label for="arabic" class="col-sm-4">ARABIC</label>
  <div class="col-sm-6">
  <select class="form-control" name="arabic" class="col-sm-8 col-xs-8">
  <option value="0" selected="selected"></option>
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
  </select>
  </div>
</div>
  <div class="form-group">
  <label for="music" class="col-sm-4">MUSIC</label>
  <div class="col-sm-6">
  <select class="form-control" name="music" class="col-sm-8 col-xs-8">
  <option value="0" selected="selected"></option>
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
  </select>
  </div>
</div>
  <div class="form-group">
  <label for="sign" class="col-sm-4">KENAY SIGN LANGUAGE</label>
  <div class="col-sm-6">
  <select class="form-control" name="sign" class="col-sm-8 col-xs-8">
  <option value="0" selected="selected"></option>
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
  </select>
  </div>
</div>
  <div class="form-group">
  <label for="business" class="col-sm-4">BUSINESS STUDIES</label>
  <div class="col-sm-6">
  <select class="form-control" name="business" class="col-sm-8 col-xs-8">
  <option value="0" selected="selected"></option>
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
  </select>
  </div>
</div>
<h3><u><b>MEAN GRADE</b><u></h3>
<div class="form-group">
  <label for="mean_grade" class="col-sm-4">MEAN GRADE</label>
  <div class="col-sm-6">
  <select class="form-control" name="mean_grade" class="col-sm-8 col-xs-8">
  <option value="0" selected="selected"></option>
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
<option value="3">D</option>
<option value="2">D-</option>
<option value="1">E</option>
  </select>
  </div>
</div>
<p><small>Please double check to make sure you have entered the grades as shown in your KCSE results slip before you click ADD GRADES</small></p>
<button type="submit" name="add_grade" class="btn btn-primary btn-lg">ADD GRADES</button>
</form>
</div>
</div>
</div>
</div>


<!--edit profile ends here-->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
