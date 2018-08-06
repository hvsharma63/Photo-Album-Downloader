<?php 
    require_once "config.php";
    if(isset($_SESSION['fb_access_token'])){
        $data = $_SESSION['data'];   
        
        echo '<a href="logout.php">Log out!</a>';
         
    }
    else{
        header("Location:index.php");
    }
?>
<?php include_once "./include/header.php" ?>
    <div class="container">
        <?php
        if(isset($_SESSION['fb_access_token'])){
            // print_r($_SESSION['data']);   
            // echo '<a href="logout.php">Log out!</a>'; 
        }
        ?>
        <?php 
            $i=0;
            foreach($data['albums'] as $current_album)
            {
        ?>
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <?php print_r($data['albums'][$i]['name']); ?> </h3>
                        </div>
                        <div class="panel-body">
                            <img src="<?php echo $current_album['picture']['url'] ?>" alt="photo" srcset="">
                            <p>Count: <?php print_r($current_album['count']); ?></p>
                            <?php
                                if(isset($current_album['description'])){
                                    echo $current_album['description'];
                                }                              
                            ?><br>
                            <a href="./single.php?id=<?php echo $current_album['id'] ?>" target="_blank">View photos of this</a>               
                        </div>
                    </div>
                </div>
        <?php
            $i++;
            }
        ?>
    </div>
    <!-- <?php 
                                $_SESSION['albumPhotos'] = $data['albums']['photos'];
                            ?> -->
<?php include_once "./include/footer.php" ?>