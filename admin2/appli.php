<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tuk Admin system</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="admin.css">

<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$("#btn-view").hide();
	
	$("#btn-view").click(function(){
		
		$("body").fadeOut('slow', function()
		{
			$("body").load('appli2.php');
			$("body").fadeIn('slow');
			window.location.href="appli2.php";
		});
	});
	
});
</script>

</head>

<body style="background color:black;">

<header>
  <a href="tabs2.php"> The Technical University Of Kenya</a>
</header>
<nav class="navbar navbar-inverse ">
<div class="navbar-inner">
            <div class="container"> 
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#"></a>
  <ul>
    <li>
      <a href="tabs2.php" style="color:white;"><span class="glyphicon glyphicon-home"></span> Home</a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Applicant's<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
        <li><a href="appli.php">grade</a></li>
        <li><a href="aplica2.php">Documents</a></li>
        <li><a href="courses.php">Qualification</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Course<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="prog.php">Add program</a></li>
        <li><a href="add.php">Add course</a></li>
        <li><a href="prog_course.php">Add course to program</a></li>
        </ul>
    </li>
    <li>
      <a href="admin_chat.php" style="color:white;">Messages</a>
    </li>
    <li>
      <a href="bank.php" style="color:white;">Bank</a>
    </li>
    </ul>
</div>
</div>
<div class="handle"></div>
</nav>
<div class="row">
<div class="col-md-12">
	<div class="content">
      
        <h2 class="form-signin-heading">Applicant</h2><hr />
        <form action="pdf.php" method="post">
                        <input type="submit" name="export_excel" class="btn btn-default" value="Export to Excel">
                    </form>
        <button class="btn btn-info" type="button" id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Applicant</button>
        <hr />
        
        <div class="content-loader">
        
        <table cellspacing="0" width="100%" id="example" class="table table-striped table-condensed table-responsive">
        <thead>
        <tr>
        <th>First Name</th>
        <th>Surname</th>
        <th>Ref No</th>
        <th>School</th>
        <th>math</th>
        <th>english</th>
        <th>kiswahili</th>
        <th>biology</th>
        <th>chemistry</th>
        <th>physics</th>
        <th>history</th>
        <th>geography</th>
        <th>cre</th>
        <th>home_science</th>
        <th>art</th>
        <th>agric</th>
        <th>aviation</th>
        <th>computer</th>
		<th>metal</th>
		<th>wood</th>
		<th>building</th>
		<th>power</th>
		<th>electricity</th>
		<th>french</th>
		<th>german</th>
		<th>arabic</th>
		<th>music</th>
		<th>sign</th>
		<th>business</th>
    <th>Mean Grade</th>

		  
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'dbconfig.php';
        
        $stmt = $db_con->prepare("SELECT * FROM `applicant` JOIN users ON applicant.user_refno=users.user_refno");
        $stmt->execute();
		while($row2=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<tr>
      <td><b><?php echo $row2['firstname']; ?></b></td>
      <td><b><?php echo $row2['surname']; ?></b></td>
			<td><?php echo $row2['user_refno']; ?></td>
			<td><?php echo $row2['school']; ?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[math]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[english]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[kiswahili]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[biology]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[chemistry]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[physics]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[history]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[geography]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[cre]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[home_science]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[art]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php $st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[agric]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[avaiation]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[computer]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[metal]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[wood]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[building]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[power]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[electricity]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[french]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[german]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[arabic]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[music]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php 
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[sign]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
			<td><?php
			$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[business]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 echo $ro['grade_name'];?></td>
           <td><?php
      $st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[mean_grade]'");
          $st->execute();
          $ro=$st->fetch(PDO::FETCH_ASSOC);
           echo $ro['grade_name'];?></td>
			</tr>
			<?php
		}
		?>
        </tbody>
        </table>
        
        </div>

    </div>
    </div>
    </div>
    
    <br />

    
    <div class="container">
      
        <div class="alert alert-info">
        <a href="http://www.codingcage.com/2015/12/simple-jquery-insert-update-delete-with.html" target="_blank">Technical university of Kenya</a>
        </div>

    </div>
    

    
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/datatables.min.js"></script>
<script type="text/javascript" src="crud.js"></script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();

	$('#example')
	.removeClass( 'display' )
	.addClass('table table-bordered');
});
$('.handle').on('click',function(){
    $('nav ul').toggleClass('showing');
  });
</script>
</body>
</html>