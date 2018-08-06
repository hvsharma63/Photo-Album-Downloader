<?php 
    require_once "config.php";
        
        $data = $_SESSION['data'];
        $id = $_GET['id'];
        $albums = count($data['albums']); 

        // The following loop will check whether the fetched id from dashboard is available in the json file or not!
        for($i=0;$i<$albums;$i++){
            if($id == $data['albums'][$i]['id']){
                $found = 1;
                $correctIdNumber = $i;
                break;
            }
            $found = 0;
        }

        // Just for the Reference!
        // echo count($data['albums'][0]); // 6
        // echo count($data['albums'][0]['photos']); // 5
        // echo count($data['albums'][0]['photos'][0]); // 2
        // echo count($data['albums'][0]['photos'][0]['images'][0]); //3
        // echo count($data['albums'][0]['photos'][0]['images']); //9
        //var_dump($data['albums'][0]['photos'][0]['webp_images'][0]['source']); 
        
?>
<?php include_once "./include/header.php" ?>
    <div class="container">
        <?php
            if($found == 1){    
                for($k=0;$k<count($data['albums'][$correctIdNumber]['photos']);$k++){    
        ?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Image</h3>
                        </div>
                        <div class="panel-body">
                            <img src="<?php echo $data['albums'][$correctIdNumber]['photos'][$k]['images'][0]['source']; ?>" height="300px" width="300px" alt="" srcset="">
                        </div>
                    </div>
                </div>
        <?php
                }
            }
            else{
                echo "Sorry, Wrong ID! And Hence No Album Found!";
            }
        ?>
    </div>
<?php include_once "./include/footer.php" ?>