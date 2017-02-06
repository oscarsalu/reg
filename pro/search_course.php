<?php
error_reporting(0);
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');

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


if (isset($_POST['enter'])) {

   $cosname=$_POST['search_text'];
   }

/*action after the enter button is pressed*/


/*if (isset($_POST['enter'])) {

   $_SESSION['search_text'] = $_POST['search_text'];

   $search_text= mysqli_real_escape_string($db , $_POST['search_text']);
*/
/*query to insert values from table course into table appli_course*/
   /*$sql9="INSERT INTO appli_course( user_refno, course_id, course_name, sub_1, sub_2, sub_3, sub_4,grade_1,grade_2,grade_3,grade_4) SELECT '$ref' ,course_id,course_name,sub_1,sub_2,sub_3,sub_4,grade_1,grade_2,grade_3,grade_4 FROM course WHERE course_name='$search_text';";


   $suc=$db->query($sql9);

   if ($suc){

        setcookie("search_text" , $search_text , time()+60*60*24*3);
        header("Location:unti.php?success=" . urlencode("You have selected $search_text as prefered course"));

   }
    else header("Location:search_course.php?err=" . urlencode("There is something wrong with the server try again later"));



}*/

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
        td#cos{
            cursor: pointer;
        }
    </style>
    <script type="text/javascript">
$(document).ready(function(){

    $("#form_1").hide();
    $("#tab").hide();

});
</script>


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
    <!-- Intro Header -->
    <header class="search">
      <div class="search-body">
            <div class="container" id="main">
            <br>
                        <!-- calling alert from php on top-->
            <?php if(isset($_GET['success'])) { ?>

            <div class="alert alert-success"><?php echo $_GET['success'];?></div>

            <?php } ?>
            <?php if (isset($_GET['err'])) {?>

            <div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

            <?php } ?>
<!--alert ends-->
            <br>
				<h1 align="center">technical university of kenya</h1>
                <form action="search_course.php" method="post">
					<div class="form-group">
						<div class="input-group">
						<span class="input-group-addon">course</span>
					<input type="text" name="search_text" id="search_text" placeholder="Search Course by name " class="form-control" value="<?php echo @$cosname;?>">
					</div>
					<br>
			</div>
		<br>
	<div id="result"></div>
<div id="form_1">
<button type="submit" name="enter" class="btn btn-default"> ENTER</button> 
</div>
</form>
<div id="tab">
    <?php


$sql2 = "SELECT * FROM course_qualification JOIN course ON course_qualification.course_id=course.course_id JOIN cert_unit ON course_qualification.unit_code=cert_unit.unit_code JOIN cert_unit_grade ON course_qualification.score=cert_unit_grade.value JOIN certification ON course_qualification.cert_id=certification.cert_id where course_name='$cosname'";
    $result = $db->query($sql2);

    if ($result->num_rows >0) {

        echo "
            <table class='table table-condensed table-responsive' bordered='1'>
            <thead>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
                <th>Certification</th>
            </tr>
            </thead>

        ";
        while ($row3 = mysqli_fetch_array($result)) {
        echo "
            <tr>
                <td>".$row3['unit_name']."</td>
                <td>".$row3['grade_name']."</td>
                <td>".$row3['cert_name']."</td>
            </tr>

        ";
    }

    echo "</table>";
}
    ?>
</div>
</div>

        </div>
    </header>
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

<script>
	$(document).ready(function(){
		$('#search_text').keyup(function(){
			var txt = $(this).val();
			if(txt != '')
			{
				$.ajax({
					url:"Search.php",
					method:"post",
					data:{Search:txt},
					dataType:"text",
					success:function(data)
					{
						$('#result').fadeIn();
                        $('#form_1').fadeOut();
                        $('#result').html(data);
					}
				});

			}
				/*$('#result').html('');*/ 
			
		});
         $(document).on('click','#cos',function(){
            $('#search_text').val($(this).text());
            $('#result').fadeOut();
            $('#form_1').fadeIn('slow', function(){
                /*window.location.href="click.php";*/
            } );

          });
	});


</script>