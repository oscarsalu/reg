<!DOCTYPE html>
<?php 
	include 'db2.php';
	

?>	
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tuk Admin system</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="admin.css">

<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>



</head>
	<body>    

	<!-- Navbar
    ================================================== -->
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

	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend>Import CSV/Excel file</legend>
						<div class="control-group">
							<div class="control-label">
								<label>CSV/Excel File:</label>
							</div>
							<div class="controls">
								<input type="file" name="file" id="file" class="input-large">
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
							<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
		

		<table class="table table-bordered">
			<thead>
				  	<tr>
				  		<th>User refno</th>
				  		<th>Amount paid</th>
				  		<th>Date</th>
				  	</tr>	
				  </thead>
			<?php
				$SQLSELECT = "SELECT * FROM bank_status ";
				$result_set =  mysql_query($SQLSELECT, $conn);
				while($row = mysql_fetch_array($result_set))
				{
				?>
			
					<tr>
						<td><?php echo $row['user_refno']; ?></td>
						<td><?php echo $row['amount_paid']; ?></td>
						<td><?php echo $row['date']; ?></td>
					

					</tr>
				<?php
				}
			?>
		</table>
	</div>

	</div>
	<script type="text/javascript">
		$('.handle').on('click',function(){
		$('nav ul').toggleClass('showing');
	});
	</script>

	</body>
</html>