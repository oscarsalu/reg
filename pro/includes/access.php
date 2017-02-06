<?php

function access($ref){
    $sql4 = "select * from status where user_refno='$ref'";
    global $db;

    $result1 = $db->query($sql4);

    $row2 = $result1->fetch_assoc();

    if ($row2['bank_status'] == 1){
        return true;
    }
    else return false;
}

function check($ref){
	$ask2="select * from bank_status where user_refno='$ref'";
	global $db;
	$res= $db->query($ask2);

	$row5=$res->fetch_assoc();
	if ($row5['amount_paid'] >= 2000){
        $up = " UPDATE status SET bank_status='1' where user_refno='$ref'";
        $db->query($up);
	}
    else return false;
}

?>