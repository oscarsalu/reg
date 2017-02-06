<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="admin.css">
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

<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>


<?php

$con=mysqli_connect('localhost','root','') or die ('error connecting to database');
mysqli_select_db($con,'registration') or die('Error connecting to database');

?>


<div id="department" class="tabcontent" sortable="true" align="center">
	<h3>Department</h3>
<table width="100%" class="table table-striped table-condensed table-responsive">
<tr>
 <th>No:</th>
<th>School Name</th>
<th>Department ID</th>
<th>Department Name</th>
<th>Delete </th>
</tr>
<?php

$sql = "SELECT * FROM dept JOIN school ON dept.school_id=dept.school_id";

$query = mysqli_query($con,$sql);
$i=1;
 while ($row = mysqli_fetch_array($query)) {?>
<tr>
<td><?php echo $i++ ;?></td>
<td><?php echo $row['school_name'];?></td>
<td><?php echo $row['dept_id'];?></td>
<td><?php echo $row['dept_name'];?></td>
<td align="center"><a id="<?php echo $row['dept_id']; ?>" class="delete-link" href="#" title="Delete">
			<img src="delete.png" width="20px" />
            </a></td>
</tr>
<?php
 }
?>


</table>
</div>
</div>
<script type="text/javascript">
	$(".delete-link").click(function()
	{
		var id = $(this).attr("id");
		var del_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('Sure to Delete ID no = ' +del_id))
		{
			$.post('del_dept.php', {'del_id':del_id}, function(data)
			{
				parent.fadeOut('slow');
			});	
		}
		return false;
	});
</script>
</body>
</html>