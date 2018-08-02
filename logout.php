<?php
    require_once "config.php";
    if(isset($_SESSION['fb_access_token'])){
        unset($_SESSION['fb_access_token']);
        session_destroy();
        header("Location:index.php");
    }
    else{
        echo "You do not have right to access";
    }
?>