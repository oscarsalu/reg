<?php
include 'db2.php';
if(isset($_POST["Import"])){
		

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	    
	          //It wiil insert a row to our bank_status table from our csv file`
	           $sql = "INSERT into bank_Status (`user_refno`, `amount_paid`, `date`) 
	            	values('$emapData[0]','$emapData[1]','$emapData[2]')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysql_query( $sql, $conn );
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"bank.php\"
						</script>";
				
				}

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"bank.php\"
					</script>";
	        
			 
			 //close of connection
			mysql_close($conn); 
				
		 	
			
		 }
	}	 
?>		 