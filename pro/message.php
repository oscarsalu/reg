<?php


session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');
include('includes/browser_os.php');

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

    </script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                <li><a href="" id="text" class="page"><span class=" glyphicon glyphicon-home">Hi <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} else echo $_COOKIE['user_name']; ?>!</span></a></li>
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
<!--user timeline start-->
<div class="clearfix">
<?php

?>
<section id="left">
			<div id="userStats" class="clearfix">
				<div class="pic">
					<a href="#"><?php echo "<img src='images/$image' width='150' height='150'/>" ?></a>
				</div>

				<div class="data">
					<h1><?php echo "Name: $first $sur " ?></h1>
                    <h3><?php echo "Id number: $id_no"?></h3>
					<h3><?php echo "Reference No:$ref"?></h3>
					<h3><?php echo "Birthday: $bday"?></h3>
                    <p><?php echo"<a href='message.php?u_id=$u_id'> Messages</a>"?></p>
                    <p><?php echo"<a href='edit_profile.php?u_id=$u_id'> Edit my profile</a>"?></p>
					<div class="socialMediaLinks">
                        <a href="http://facebook.com/"><i class="fa fa-facebook-square fa-2x"></i></a>
                        <a href="http://linkedin.com/"><i class="fa fa-linkedin-square fa-2x"></i></a>
                        <a href="http://twitter.com/"><i class="fa fa-twitter-square fa-2x"></i></a>
                        <a href="http://gmail.com/"><i class="fa fa-google-plus-square fa-2x"></i></a>
                        </ul>
					</div>
				</div>
			</div>
           </section>
</div>
<!--user timeline ends-->
 <div id="content_timeline">
 <form action="message.php?u_id=<?php echo $u_id;  ?>" method="post" >
 <input type="text" name="msg" placeholder="message title">
 <textarea name="msg" cols="50" rows="5" placeholder="message"></textarea>
 <br>
 <button type="submit" name="msg"></button> 
     
 </form>
 </div>

</div>
</div>
<a href='form.php'>next</a>
<!--end col-lg-12 -->
</div>
</div>
</div>
        <!-- /#page-content-wrapper -->

</div>
    <!-- /#wrapper -->

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
