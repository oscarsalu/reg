<?php


session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');
include('includes/access.php');
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

if (check($ref)) {
    header("Location:profile.php?success=" . urlencode ("Your bank details have been updated"));
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
					<?php echo "<a href='edit_profile.php?u_id=$u_id'><img src='images/$image' width='150' height='150'/></a>" ?>
				</div>

				<div class="data">
					<h1><?php echo "Name: $first $sur " ?></h1>
                    <h3><?php echo "Id number: $id_no"?></h3>
					<h3><?php echo "Reference No:$ref"?></h3>
					<h3><?php echo "Birthday: $bday"?></h3>
                    <p><?php echo"<a href='chat.php'> Messages</a>"?></p>
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
 <!-- Bootstrap Upload Control - START -->
<div class="container-fluid">
<h4>please upload your scanned copies of your id and birth certificate</h4>
<h4>rename them with ur Reference number before uploading</h4>
<div class="row">
        <form action="profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>ID</label>
              <input type="file" name="file_array[]" >
            </div>
            <div class="form-group">
              <label>birth cert</label>
              <input type="file" name="file_array[]" >
            </div>
            <div class="form-group">
              <label>KCSE/KNEC/any other certification</label>
              <input type="file" name="file_array[]" >
            </div>
            <input type="submit" value="Upload Files" class="btn btn-sm btn-primary">
        </form>
        </div>
        </div>
        <?php
        if(isset($_FILES['file_array'])){
          $name_array=$_FILES['file_array']['name'];
          $tmp_name_array=$_FILES['file_array']['tmp_name'];
          $type_array=$_FILES['file_array']['type'];
          $size_array=$_FILES['file_array']['size'];
          $error_array=$_FILES['file_array']['error'];

          for($i = 0; $i < count ($tmp_name_array); $i++){
            if (move_uploaded_file($tmp_name_array[$i],"applicant/$ref/". $name_array[$i])){
              echo $name_array[$i]." upload is complete <br>";
            }else echo "try again for".$name_array[$i]."<br>";
             $sql7="insert into files (user_refno,id,birth_cert,kcse) values('$ref','$name_array[0]','$name_array[1]','$name_array[2]')";
               $db->query($sql7);
         }
        } 
        ?>
<!-- <script type="text/javascript">
    jQuery(function ($) {
        $("#files").shieldUpload();
    });
</script> -->
<!-- Bootstrap Upload Control - END -->

 </div>
 <div class="col-md-12" style="margin-top:50px">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators" style="color:hsla(0,0%,0%,1.00)">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox" style=" color:hsla(227,100%,6%,1.00)" >
                                <div class="item active" style="text-align:center">
                                    <p><strong>Only a few process left. Thanx for your patience</strong></p>
                                </div>
                                <div class="item" style="text-align:center">
                                    <p><strong>Before uploading your academic certificates pay a sum of 2000/= through any of the account numbers provided</strong></p>
                                </div>
                                <div class="item" style="text-align:center">
                                    <p><strong>After this you will have access to the application form,where you will input your academic details according to the course you have selected. its suggested that ur input should be correct.according to your academic certificates</strong></p>
                                </div>
                                <div class="item" style="text-align:center">
                                    <p><strong>After which you will be prompt to upload ur academic records,a passport size photo if u havent uploaded yet,preferably 600*600</strong></p>
                                </div>
                                <div class="item" style="text-align:center">
                                    <p><strong>When its all set and done u will get to know if u have qualified for the course you want if not another course will be recormended for you</strong></p>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" style="color:hsla(0,0%,0%,1.00)"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" style="color:hsla(0,0%,0%,1.00)"></span>
                            </a>
                        </div>
                    </div>

                </div>
                <div style="margin-top:50px;">
                <?php
               $sql2 = "SELECT * from bank";

               $result2= $db->query($sql2);

               if ($result2->num_rows >0){

                   echo
               "<table class='table table-bordered'>
                <thead>
                <tr>
                <th>#</th>
                <th>Bank</th>
                <th>Account no</th>
                </tr>
                </thead>";

                //output data of each row

                while ($row2 = $result2->fetch_assoc())
                {
                    echo "<tbody><tr><th scope='row'>" .$row2["id"]."</th><td>" .$row2["bank"]. "</td><td>" .$row2["account_no"]."</td></tr>" ;
                }
                echo "</tbody></table>";
                   }else echo " NO bank accounts in the database"
                ?>

                </div>
                </div>

</div>
</div>
<a href='drop_down.php'><big>next</big></a>
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
