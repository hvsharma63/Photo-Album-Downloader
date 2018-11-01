<?php
    include 'include/header.php';
    require_once "config.php";
    // echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>'; 
?>
<div class="container" id="indexArea">
    
    <div class="col-md-5" class="indexText">
        <div id="loginBox">
        <h5 class="card-title">Photo Album Downloader</h5>                 
        <p class="card-text">This app was made with ❤️ by HV Sharma. Login to Explore!</p>           
            <div class="btn btn-default btn-large btn-login">
                <a href="<?php echo htmlspecialchars($loginUrl) ?>" style="color:white; text-decoration:none;">
                    <span><img src="./include/icons/facebook.png" alt="" style="background-color:white;width:40px;height:40px;"></span>
                    Login with Facebook
                </a>
            </div>
        </div>
    </div>
</div>