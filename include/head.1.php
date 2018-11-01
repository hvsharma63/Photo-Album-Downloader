<?php 
    require_once "config.php";
    include_once 'header.php';
    if(isset($_SESSION['fb_access_token'])){
        $data = $_SESSION['data'];         
    }
    else{
        header("Location:index.php");
    }   
?>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="./index.php"><?php echo "Hello, ".$data['name'];?></a>
    <form class="form-inline">
        <a class="badge badge-primary my-2 my-sm-0" type="submit" href="./logout.php">Logout</a>
    </form>

</nav>