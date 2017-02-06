<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tuk Admin system</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="admin.css">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/admin.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$("#btn-view").hide();
	
	$("#btn-view").click(function(){
		
		$("body").fadeOut('slow', function()
		{
			$("body").load('appli.php');
			$("body").fadeIn('slow');
			window.location.href="appli.php";
		});
	});
	
});
</script>

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
                </div>
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
<div class="handle"></div>
</nav>
<div class="row">
<div class="col-md-12">
	<div class="content">
      
        <h2 class="form-signin-heading">Applicant</h2><hr />
        <form action="excel.php" method="post">
                        <input type="submit" name="export_excel" class="btn btn-default" value="Export to Excel">
                    </form>
        <button class="btn btn-info" type="button" id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Users</button>
        <hr />
        
        <div class="content-loader">
        
        <table cellspacing="0" width="100%" id="example" class="table table-striped table-condensed table-responsive">
        <thead>
        <tr>
        <th>Refrence Number</th>
        <th>Course</th>
		</tr>
        </thead>
        <tbody>
        <?php
        require_once 'dbconfig.php';
        
        $stmt = $db_con->prepare("SELECT * FROM course");
        $stmt->execute();
		while($row2=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<tr>
			<td><a id="<?php echo $row2['course_id']; ?>" class="link1" href="#" title="view"><?php echo $row2['course_id']; ?></a></td>
			<td><?php echo $row2['course_name']; ?></td>
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
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();

	$('#example')
	.removeClass( 'display' )
	.addClass('table table-bordered');
});
</script>
<script type="text/javascript">
$(".link1").click(function()
    {
        var id = $(this).attr("id");
        var view_id = id;
        if(confirm('See those who have qualified course_id=' +view_id))
        {
            $("body").fadeOut('slow', function()
        {
            $("body").load('view2.php?view_id='+view_id);
            $("body").fadeIn('slow');
        }); 
        }
        return false;
    });
        $('.handle').on('click',function(){
        $('nav ul').toggleClass('showing');
    });
</script>
</body>
</html>