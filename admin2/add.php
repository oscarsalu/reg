<?php
session_start();
require 'config.php';
require 'db.php';

if(isset($_POST['add'])){
    $_SESSION['cat'] = $_POST['cat'];
    $_SESSION['subcat'] = $_POST['subcat'];
    $_SESSION['subname'] = $_POST['subname'];
    $_SESSION['dept'] = $_POST['dept'];


    $cat=$_POST['cat'];
    $subcat =mysqli_real_escape_string($db , $_POST['subcat']);
    $subname = mysqli_real_escape_string($db , $_POST['subname']);
    $dept=$_POST['dept'];

    $sql2 = "insert into course (course_id,course_name,course_level,dept_id) values('$subcat','$subname','$cat','$dept')";
        $resa=$db->query($sql2);
        if ($resa) {
        	header("Location:add2.php");
        }else
        header("Location:add2.php?err=". urlencode ("There was an error while add course"));
    exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="admin.css">
<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/admin.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

	<title>ADD COURSE</title>
	<script language=Javascript>
		
		function reload(form){
			var val=form.cat.option[form.cat.input.selectedIndex].value;
			self.location='add.php?cat=' +val ;
		}
		function disableselct()
		{
			<?php
			if (isset($cat) and strlen($cat)>0) {
				echo "document.f1.disabled = false;";}
				else{echo "document.f1.disabled= true;";}
			?>
		}
			$('.navbar-collapse ul li a').click(function() {
		  if ($(this).attr('class') != 'dropdown-toggle active' && $(this).attr('class') != 'dropdown-toggle') {
		    $('.navbar-toggle:visible').click();
		  }
		});

	</script>
	 <style type="text/css">
        td{
            cursor: pointer;
        }
    </style>
</head>
<body onload="disableselct();">
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
///////// Getting the data from Mysql table for first list box//////////
$sql="SELECT DISTINCT level_id,level_name FROM course_level order by level_id ";

echo "<form method=post name=f1 action='add.php' 
' style='margin-top:80px;'>";
/// Add your form processing page address to action in above line. Example  action=dd-check.php////
//////////        Starting of first drop downlist /////////
echo"<label>Level</label>";
echo "<select class='form-control'  name='cat' onchange=\"reload(this.form)\">
<option value=''>Select one</option>";
 
foreach ($db->query($sql) as $row){
	if ($row['level_id']==@$cat){
		echo "<option selected value = '$row[level_id]'>$row[level_name]</option>"."<br>";
	}
	else { echo "<option value='$row[level_id]'>$row[level_name]</option>";}
	}
echo "</select>";
?>
<?php
$quer="SELECT DISTINCT dept_id,dept_name,school_id FROM dept";
 ?>
	<br>
	<div class="form-group">
	<label>Course id</label>
	<input type="text" name="subcat" class="form-control" placeholder="insert course id" required>
	</div>
	<div class="form-group">
	<label>Course name</label>
	<input type="text" name="subname" class="form-control" placeholder="name of the course" required>
	</div>
	<div class="form-group">
	<label>Department</label>
	<select class="form-control" name="dept">
<option value="">Select one</option>
<?php foreach ($db->query($quer) as $row7){
	echo "<option value='$row7[dept_id]'>$row7[dept_name]</option>"."<br>";
	}
	?>
	</select>
	</div>

	<button class="btn btn-info" name="add" type="submit"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Courses</button>
	
	<?php echo "</form>";?>
	
</select>
	

</form>
<br>
<br>
<div id="result">
<table width="100%" class="table table-striped table-condensed table-responsive" style="margin-top:50px;">
        <thead>
        <tr>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt ="SELECT * from course";
        $str=$db->query($stmt);
        
		while($row = $str->FETCH_ASSOC())
		{
			?>
			<tr>
			<td><a id="<?php echo $row['course_id']; ?>" class="link" href="#" title="view"><?php echo $row['course_id']; ?></a></td>
			<td><?php echo $row['course_name']; ?></td>
			<td align="center"><a id="<?php echo $row['course_id']; ?>" class="delete-link" href="#" title="Delete">
			<img src="delete.png" width="20px" />
            </a></td>
			</tr>
			<?php
		}
		?>
        </tbody>
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
			$.post('delete.php', {'del_id':del_id}, function(data)
			{
				parent.fadeOut('slow');
			});	
		}
		return false;
	});
	$(".link").click(function()
	{
		var id = $(this).attr("id");
		var view_id = id;
		if(confirm('Sure to view ID no = ' +view_id))
		{
			$("body").fadeOut('slow', function()
		{
			$("body").load('view.php?view_id='+view_id);
			$("body").fadeIn('slow');
		});	
		}
		return false;
	});
</script>
</body>
</html>