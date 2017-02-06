<?php 
session_start();
include('config.php');
include('db.php');

function formarDate($date){
	return date('g:i a', strtotime($date));
}


			$query = "SELECT * FROM chat ORDER BY id ASC";
			$run = $db-> query($query);

			while ($row = $run->fetch_array()) : 
		 ?>
			<div id="chat_data">
				<small><span style="color:green"><?= $row['user_refno'];?>:</span></small>
				<span style="color:green"><?= $row['name'];?>:</span>
				<span style="color:brown"><?= $row['message'];?></span>
				<span style="float:right;"><?= formarDate($row['date']);?></span>
			</div>
		<?php endwhile;  ?>