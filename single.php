<?php 
    require_once "config.php";
        
        $data = $_SESSION['data'];
        //echo $_GET['id'];
        $id = $_GET['id'];
        //echo "<br>";
        $count=0;$notfound=0;
        // foreach($data['albums'][0]['photos'][$i]['images'][0] as $current_album)
        // {
        //     if($current_album['id'] == $id){ //upto which digit do I've to set the limit?
        //         echo $current_album['id'];        
        //     }
        // }
        $albums = count($data['albums']);
        echo "Total Albums: " . $albums;
        echo "<br>";
        for($i=0;$i<$albums;$i++){
            if($id == $data['albums'][$i]['id']){
                $found = 1;
                $correctIdNumber = $i;
                break;
            }
            $found = 0;
        }
        if($found == 1){
            
            
                // for($j=0;$j<count($data['albums'][$i]);$j++){
                    
                    for($k=0;$k<count($data['albums'][$correctIdNumber]['photos']);$k++){
                        
                        // for($l=0;$l<count($data['albums'][$i]['photos'][$k]);$l++){
                            
                            // for($m=0;$m<count($data['albums'][$i]['photos'][$k]['images']);$m++){
                            
                                // for($n=0;$n<count($data['albums'][$i]['photos'][$k]['images'][$m]);$n++){
                            ?>
                            <img src="<?php echo $data['albums'][$correctIdNumber]['photos'][$k]['images'][0]['source']; ?>" height="300px" width="250px" alt="" srcset="">
                            <?php echo "<br>";
                                // }
                            // }
                        }
                    // }
                // }
                
        }
        else{
            echo "Nothing Found!";
        }
        // echo count($data['albums'][0]); // 6
        // echo count($data['albums'][0]['photos']); // 5
        // echo count($data['albums'][0]['photos'][0]); // 2
        // echo count($data['albums'][0]['photos'][0]['images'][0]); //3
        // echo count($data['albums'][0]['photos'][0]['images']); //9
        // for($i=0;$i<$albums;$i++){
            
        //     // for($j=0;$j<count($data['albums'][$i]);$j++){
                
        //         for($k=0;$k<count($data['albums'][$i]['photos']);$k++){
                    
        //             // for($l=0;$l<count($data['albums'][$i]['photos'][$k]);$l++){
                        
        //                 // for($m=0;$m<count($data['albums'][$i]['photos'][$k]['images']);$m++){
                        
        //                     // for($n=0;$n<count($data['albums'][$i]['photos'][$k]['images'][$m]);$n++){
        //                 ?>
        <!-- //                 <img src="<?php echo $data['albums'][$i]['photos'][$k]['images'][4]['source']; ?>" alt="" srcset=""> -->
        <!-- //                 <?php echo "<br>"; ?> -->
        //                     // }
        //                 // }
        //             }
        //         // }
        //     // }
        // }
        //var_dump($data['albums'][0]['photos'][0]['webp_images'][0]['source']); 
        <?php
        echo "<pre>";
        var_dump($data['albums']);
        exit;
?>
<?php include_once "./include/header.php" ?>
    <div class="container">
        <?php
            $i=0;
            foreach($data['albums'] as $current_album)
            {
        ?>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <?php print_r($current_album['albums']['name'][$id]); ?> </h3>
                        </div>
                        <div class="panel-body">
                        
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>

        
    </div>
<?php include_once "./include/footer.php" ?>