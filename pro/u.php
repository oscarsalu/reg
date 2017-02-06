<?php
session_start();
include('includes/optional.php');
include('includes/config.php');
include('includes/db.php');

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

$course=$_SESSION['course'];

$qwe="SELECT course_name FROM course WHERE course_id='$course';";
$rwa=$db->query($qwe);

$wer= $rwa->fetch_assoc();
$coursename=$wer['course_name'];
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Technical university</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <style type="text/css">
        td{
            cursor: pointer;
        }
    </style>

</head>

<body>
<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    <br>
                    <br>
          <br>
          <br>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <span class="light"><a href="index.php" class="navbar-brand page-scroll" id="text1"><div id="image1"></div></a></span>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="dropdown-toggle">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" id="text">Home<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#home">Application Portal</a></li>
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
                    <li><a href="logout.php" id="text"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<header class="search">
      <div class="search-body">
            <div class="container" id="main" style="margin-top:150px;">
            <br>
                                    <!-- calling alert from php on top-->
            <?php if(isset($_GET['success'])) { ?>

            <div class="alert alert-success"><?php echo $_GET['success'];?></div>

            <?php } ?>
            <?php if (isset($_GET['err'])) {?>

            <div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

            <?php } ?>
<!--alert ends-->
          <table class="table table-condensed">
            <tr>
            <th colspan="4">your uploads...<label><a href="profile.php">upload new files...</a></label></th>
            </tr>
            <tr>
            <td>ID card</td>
            <td>Birth certificate</td>
            <td>KCSE</td>
            <td>View ID</td>
            <td>View BIRTH CERT</td>
            <td>View KCSE Certificate</td>
            </div>
            </tr>
            <?php
         $sql2="SELECT * FROM files where user_refno = '$ref'";
         $result_set=$db->query($sql2);
         while($row2 = $result_set->fetch_assoc())
         {
          ?>
                <tr>
                <td><?php echo $row2['id'] ?></td>
                <td><?php echo $row2['birth_cert'] ?></td>
                <td><?php echo $row2['kcse'] ?></td>
                <div class="col-xs-6 col-md-4">
                <td><a href="applicant/<?php echo $ref ?>/<?php echo $row2['id'] ?>" target="_blank">view ID</a></td>
                <td><a href="applicant/<?php echo $ref ?>/<?php echo $row2['birth_cert'] ?>" target="_blank">view birth certificate</a></td>
                <td><a href="applicant/<?php echo $ref ?>/<?php echo $row2['kcse'] ?>" target="_blank">view KCSE</a></td>
                </tr>
        <?php
 }
 ?>
    </table>

    <br>
    <br>
    <br>
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
    <label>Course</label>
    <input type="text" name="school" class="form-control" value="<?php echo "$coursename";?>" readonly>
    </div>
    </div>
    </div>
        
        </div>
    </div>
    </header>    
</body>
</html>