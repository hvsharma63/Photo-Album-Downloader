<?php
    include 'include/header.php';
    require_once "config.php";
    // echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>'; 
?>
<!-- <div class="container" id="indexArea">
    <div class="col-md-6">
        <div class="iconBox">fjfj</div>
    </div>
    <div class="col-md-1">
        <div class="divider">
        </div>
    </div>
    <div class="col-md-5" class="indexText">
        <p>
        <div id="loginBox">
            <div class="btn btn-default btn-large btn-login">
                <a href="<?php echo htmlspecialchars($loginUrl) ?>" style="color:white; text-decoration:none;">
                    <span><img src="./include/icons/facebook.png" alt="" style="background-color:white;width:40px;height:40px;"></span>
                    Login with Facebook
                </a>
            </div>
        </div>
    </div>
</div> -->

<div class="container">
    <div class="col-md-4 offset-md-4" style="margin-top:23%;">
        <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Photo Album Downloader</h5>
                <p class="card-text">This app was made with ❤️ by HV Sharma. Login in to Explore!</p>
                <a href="<?php echo htmlspecialchars($loginUrl) ?>" class="btn btn-primary btn-sm" style="background-color: #3A559F;">
                <span><img src="./include/icons/facebook.png" alt="" style="background-color:white;width:25px;height:25px; margin-bottom:2px;"></span>Login with Facebook</a>
            </div>
        </div>
    </div>
</div>