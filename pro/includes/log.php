<?php

function loggedin(){
    if (isset($_SESSION['user_name']) || isset($_COOKIE['user_name'])){
        return true;
    }else return false;
}

?>