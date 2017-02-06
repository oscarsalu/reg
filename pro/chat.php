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

if (isset($_POST['submit'])) {

			$name = $_POST['name'];
			$ref = $_POST['reg'];
			$message = $_POST['message'];

			$query ="INSERT INTO chat (name, user_refno, message) values ('$name','$ref','$message')";
			$run = $db->query($query);

			if ($run) {
		
				echo "<embed loop = 'false' src='chat.wav' hidden='true' autoplay='true' />";
				# code...
			}else echo "try again";
		}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat Box</title>
	<link rel="stylesheet" type="text/css" href="chat.css"/>
	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200){

				document.getElementById('chat').innerHTML = req.responseText;
				}
			}
		
		req.open('GET','chat1.php','true');
		req.send();
		}
		setInterval(function(){ajax()},1000);
	</script>
</head>
<body onload="ajax();">
	<div id="container">
	<header>ASK THE ADMIN</header>
		<div id="chat_box">
		<div id="chat">
			
		</div>
		</div>
		<form method="post" action="chat.php">
		<label> Enter your name</label>
		<input type="text" name="name" placeholder="Enter name" value="<?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} else echo $_COOKIE['user_name']; ?>" readonly />
		<label>Enter refrence number</label>
		<input type="text" name="reg" placeholder="Enter ref number" value="<?php echo $ref ?>" readonly/>
		<label>Message</label>
		<textarea name="message" placeholder="Enter your message" required></textarea>
		<input type="submit" name="submit" value="Send Message">
			
		</form>
		<?php  
		

		?>


	</div>
</body>
</html>