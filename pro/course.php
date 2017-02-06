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
//fetching data from table users
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

//end 

if(!access($ref)){
    header("Location:profile.php?err=" . urlencode ("pay the registration fee or wait the bank details to be update!!"));
    exit();
}

//fetching data from table applicant
$sql2= "select * from applicant where user_refno='$ref'";

$result2 = $db->query($sql2);

$row2 = $result2->fetch_assoc();

  $school = $row2['school'];
  $math=$row2['math'];
  $english=$row2['english'];
  $kiswahili=$row2['kiswahili'];
  $biology=$row2['biology'];
  $chemistry=$row2['chemistry'];
  $physics=$row2['physics'];
  $history=$row2['history'];
  $geography=$row2['geography'];
  $c_h_ire=$row2['cre'];
  $home_science=$row2['home_science'];
  $art=$row2['art'];
  $agric=$row2['agric'];
  $aviation=$row2['avaiation'];
  $computer=$row2['computer'];
  $metal=$row2['metal'];
  $wood=$row2['wood'];
  $building=$row2['building'];
  $power=$row2['power'];
  $electricity=$row2['electricity'];
  $french=$row2['french'];
  $german=$row2['german'];
  $arabic=$row2['arabic'];
  $music=$row2['music'];
  $sign=$row2['sign'];
  $business=$row2['business'];
  $mean=$row2['mean_grade'];


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
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" background="images/patterns/5.png">
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
      <li><a href="logout.php" id="text"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      <li><a href="faq.php" id="text"><span class="glyphicon glyphicon-question"></span> FAQ</a></li>
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
<form action="course.php" method="post" >

<?php 
//display grade with letters and not as numbers
$sql3 = "select * from cert_unit_grade where value='$math'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$math_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$english'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$english_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$kiswahili'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$kiswahili_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$biology'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$biology_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$chemistry'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$chemistry_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$physics'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$physics_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$history'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$history_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$geography'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$geography_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$c_h_ire'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$c_h_ire_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$home_science'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$home_science_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$art'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$art_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$agric'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$agric_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$aviation'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$aviation_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$computer'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$computer_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$metal'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$metal_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$wood'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$wood_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$building'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$building_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$power'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$power_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$electricity'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$electricity_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$french'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$french_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$german'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$german_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$arabic'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$arabic_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$music'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$music_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$sign'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$sign_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$business'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$business_name=$row3['grade_name'];

$sql3 = "select * from cert_unit_grade where value='$mean'";
$result3 = $db->query($sql3);
$row3 = $result3->fetch_assoc();
$mean_name=$row3['grade_name'];



?>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>OFFICIAL NAME</label>
<input type="text" name="namae" class="form-control" value="<?php echo "$first $sur";?>" readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>REFERENCE NUMBER</label>
<input type="text" name="ref" class="form-control" value="<?php echo "$ref";?>" readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>SCHOOL</label>
<input type="text" name="school" class="form-control" value="<?php echo "$school";?>" readonly>
</div>
</div>
<br><br>
<div class="col-md-4">
<div class="form-group">
<label>MATHEMATICS</label>
<input type="text" name="maths" class="form-control" value="<?php echo "$math_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>ENGLISH   </label>
<input type="text" name="english" class="form-control" value="<?php echo "$english_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>KISWAHILI </label>
<input type="text" name="kiswahili" class="form-control" value="<?php echo "$kiswahili_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>BIOLOGY   </label>
<input type="text" name="biology" class="form-control" value="<?php echo "$biology_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>CHEMISTRY </label>
<input type="text" name="chemistry" class="form-control" value="<?php echo "$chemistry_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>PHYSICS   </label>
<input type="text" name="physics" class="form-control" value="<?php echo "$physics_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>HISTORY   </label>
<input type="text" name="history" class="form-control" value="<?php echo "$history_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>GEOGRAPHY </label>
<input type="text" name="geography" class="form-control" value="<?php echo "$geography_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>C_H_IRE   </label>
<input type="text" name="c_h_ire" class="form-control" value="<?php echo "$c_h_ire_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>HOME SCIENCE</label>
<input type="text" name="home science" class="form-control" value="<?php echo "$home_science_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>ART & CRAFT</label>
<input type="text" name="art" class="form-control" value="<?php echo "$art_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>AGRICULTURE</label>
<input type="text" name="agric" class="form-control" value="<?php echo "$agric_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>AVIATION  </label>
<input type="text" name="aviation" class="form-control" value="<?php echo "$aviation_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>COMPUTER  </label>
<input type="text" name="computer" class="form-control" value="<?php echo "$computer_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>METAL WORKS</label>
<input type="text" name="metal" class="form-control" value="<?php echo "$metal_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>WOOD WORKS</label>
<input type="text" name="wood" class="form-control" value="<?php echo "$wood_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>BUILDING  </label>
<input type="text" name="building" class="form-control" value="<?php echo "$building_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>POWER     </label>
<input type="text" name="power" class="form-control" value="<?php echo "$power_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>ELECTRICITY</label>
<input type="text" name="electricity" class="form-control" value="<?php echo "$electricity_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>FRENCH    </label>
<input type="text" name="french" class="form-control" value="<?php echo "$french_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>GERMAN    </label>
<input type="text" name="german" class="form-control" value="<?php echo "$german_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>ARABIC    </label>
<input type="text" name="arabic" class="form-control" value="<?php echo "$arabic_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>MUSIC     </label>
<input type="text" name="music" class="form-control" value="<?php echo "$music_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>SIGN LANGU</label>
<input type="text" name="sign" class="form-control" value="<?php echo "$sign_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>BUSINESS  </label>
<input type="text" name="business" class="form-control" value="<?php echo "$business_name";?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Mean Grade </label>
<input type="text" name="business" class="form-control" value="<?php echo "$mean_name";?>" readonly>
</div>
</div>

</div>
</form>
<p><small>Counter check to ensure that u have correctly inserted your grade,if not click <a href='update_form.php'>back</a> to re-insert the grade all over again once more</small></p>
<p><small>if your details are correctly displayed click <a href='app.php'>next</a> to select a course you wish to persue</small></p>
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


<!-- Custom Theme JavaScript -->
<script src="js/main.js"></script>

</body>

</html>
