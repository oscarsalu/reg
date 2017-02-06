<?php
session_start();
require 'config.php';
require 'db.php';

if($_GET['view_id'])
{
	$id = $_GET['view_id'];
}
	?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/admin.js"></script>
</head>
<body>
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
    
<div class="container">
<br>
<br>
<br>
<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>

	<table width="100%" class="table table-striped table-condensed table-responsive" style="margin-top:50px;">
        <thead>
        <tr>
        <th>Refrence number</th>
        <th>First Name</th>
        <th>Surname</th>
        <th>Id</th>
        <th>Course Name</th>
        <th>Intake</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt ="SELECT * FROM `appli_course` JOIN users ON appli_course.user_refno=users.user_refno JOIN program ON appli_course.intake_id=program.program_id where course_id=$id && qualified=1";
        $str=$db->query($stmt);
        
		while($row = $str->FETCH_ASSOC())
		{
			?>
			<tr>
            <td><?php echo $row['user_refno']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['surname']; ?></td>
			<td><?php echo $row['course_id']; ?></td>
			<td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['intake_name']; ?></td>
			</tr>
			<?php
		}
		?>
        </tbody>
        </table>
</div>
</body>
</html>