<?php 
    require_once "config.php";
    if(isset($_SESSION['fb_access_token'])){
        echo "<pre>";
        print_r($_SESSION['data']);   
        echo '<a href="logout.php">Log out!</a>'; 
    }
    else{
        header("Location:index.php");
    }
?>