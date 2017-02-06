<?php

function update(){
    if(isset($_POST['update'])){
        $firstname=mysqli_real_escape_string($db ,$_POST['firstname']);
        $surname=mysqli_real_escape_string($db ,$_POST['surname']);
        $gender=$_POST['gender'];
        $b_day=$_POST['birthday'];
        $date=date("d-m-y");
        $ref=random_int(8);
        
        $insert = "insert into users(firstname,surname,gender,image,b-day,user_refno) values('$firstname','$surname','$gender','default.jpg','$b_day','$ref')";
        
        $result=$db->query($insert);
        
        if($result){
            echo "<script>alert('update complete your reference number is REF'$ref' ')</script>";
            }
        
        }
    
    
    }

?>