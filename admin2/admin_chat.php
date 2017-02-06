<?php


session_start();
include('config.php');
include('db.php');

//security to ensure only those who have logged in can view page

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
		
		req.open('GET','adchat.php','true');
		req.send();
		}
		setInterval(function(){ajax()},1000);
	</script>
</head>
<body onload="ajax();">
	<div id="container">
	<header>CHAT WITH APPLICANT</header>
		<div id="chat_box">
		<div id="chat">
			
		</div>
		</div>
		<form method="post" action="chat.php">
		<label> Enter your name</label>
		<input type="text" name="name" placeholder="Enter name" value="Admin" readonly />
		<label>Enter refrence number of the person your are replaying to</label>
		<input type="text" name="reg" placeholder="ref number" value="REF" required />
		<label>Message</label>
		<textarea name="message" placeholder="Enter your message" required></textarea>
		<input type="submit" name="submit" value="Send Message">
			
		</form>
		<?php  
		

		?>


	</div>
	<script type="text/javascript">
		$('.handle').on('click',function(){
		$('nav ul').toggleClass('showing');
	});
	</script>
</body>
</html>