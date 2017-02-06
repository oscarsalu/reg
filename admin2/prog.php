<?php
session_start();
require 'config.php';
require 'db.php';

if(isset($_POST['update'])){
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['year'] = $_POST['year'];
    $_SESSION['start']=$_POST['start'];
    $_SESSION['end'] = $_POST['end'];

    //alerts
    if(strlen($_POST['name'])<3){
        header("Location:prog.php?err=" . urlencode("The name must be atleast 3 characters long"));
        exit();

        }
        else if(strlen($_POST['year'])<3){
        header("Location:prog.php?err=" . urlencode("The name must be atleast 3 characters long"));
        exit();

        }else if($_POST['start']>=$_POST['end']){
        header("Location:prog.php?err=" . urlencode("please correct the start and the end date"));
        exit();
    }
        //alerts end here
        //inserting  users into database
    else {
        $name = mysqli_real_escape_string($db , $_POST['name']);
        $year = mysqli_real_escape_string($db , $_POST['year']);
        $start=$_POST['start'];
        $end=$_POST['end'];

        $insert = "INSERT INTO program ( intake_name,academic_year,start_date,end_date) values ('$name','$year','$start','$end')" ;

        $success=$db->query($insert);
        if($success){
            header("Location:prog.php?success=" . urlencode("$name was successfully saved "));
        exit();
            }else header("Location:prog.php?err=" . urlencode("There is something wrong,Please check the start date ,end date and academic year then try again"));
        exit();
        }//inserting user into ends here

  }

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="admin.css">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
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
    <li>
    <a href="prog.php">Add program</a>
    </li>
        <li>
        <a href="add.php">Add course</a>
        </li>
        <li>
        <a href="prog_course.php">Add course to program</a>
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
<div class="container" ">
<br>
<br>
<br>
<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>

<div class="jumbotron">
<form action="prog.php" method="post">
<div class="form-group">
<label>Intake Name</label>
<input type="text" name="name" class="form-control" placeholder="eg september-2016 intake" value="<?php echo @$_SESSION['name'];?>" required>
</div>
<div class="form-group">
<label>Academic year</label>
<input type="text" name="year" class="form-control" placeholder="eg 2016/2017" value="<?php echo @$_SESSION['year'];?>" required>
</div>
<div class="form-group">
<label>start date</label>
<input type="date" name="start" class="form-control" placeholder="Enter start date" value="<?php echo @$_SESSION['start'];?>" required>
</div>
<div class="form-group">
<label>end date</label>
<input type="date" name="end" class="form-control" placeholder="Enter end date" value="<?php echo @$_SESSION['end'];?>" required>
</div>
<button type="submit" name="update" class="btn btn-default">ADD</button>
</form>
</div>
<table width="100%" class="table table-striped table-condensed table-responsive" style="margin-top:50px;">
        <thead>
        <tr>
        <th>Id</th>
        <th>Intake Name</th>
        <th>Academic Year</th>
        <th>Start date</th>
        <th>End date</th>
        <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt ="SELECT * FROM program ";
        $str=$db->query($stmt);
        
        while($row = $str->FETCH_ASSOC())
        {
            ?>
            <tr>
            <td><?php echo $row['program_id']; ?></td>
            <td><?php echo $row['intake_name']; ?></td>
            <td><?php echo $row['academic_year']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td align="center"><a id="<?php echo $row['program_id']; ?>" class="delete-link" href="#" title="Delete">
            <img src="delete.png" width="20px" />
            </a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        </table>
</div>
<script type="text/javascript">
    $(".delete-link").click(function()
    {
        var id = $(this).attr("id");
        var del_id = id;
        var parent = $(this).parent("td").parent("tr");
        if(confirm('Sure to Delete ID no = ' +del_id))
        {
            $.post('delete3.php', {'del_id':del_id}, function(data)
            {
                parent.fadeOut('slow');
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