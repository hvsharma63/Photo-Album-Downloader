<?php 
    require_once "config.php";
        
        $data = $_SESSION['data'];
        $id = $_GET['id'];
        $albums = count($data['albums']); 
        $error = "";

        // The following loop will check whether the fetched id from dashboard is available in the json file or not!
        for($i=0;$i<$albums;$i++){
            if($id == $data['albums'][$i]['id']){
                $found = 1;
                $correctIdNumber = $i;
                break;
            }
            $found = 0;
        }   

        if(isset($_POST['downloadimg'])){
            $k=0;
            if(!empty($_POST['files'])){
                foreach($_POST['files'] as $selected){
                    $imgData = file_get_contents($selected);
                    $fp = fopen("files/img" .$k. ".jpg","wb");
                    $k++;
                    if (!$fp) exit;
                    fwrite($fp, $imgData);
                    fclose($fp);
                    // file_put_contents($img, file_get_contents($selected));
                    // $download_file = file_get_contents($selected);
                    // echo $download_file. "</br>";
                }
            }
        }
        
        // $zip = new ZipArchive;
        // if ($zip->open('test_folder_change.zip', ZipArchive::CREATE) === TRUE)
        // {
        //     // Add files to the zip file
        //     $zip->addFile('text.txt', 'demo_folder/test.txt');
        //     $zip->addFile('test.pdf', 'demo_folder1/test.pdf');
         
        //     // All files are added, so close the zip file.
        //     $zip->close();
        // }

        
        // if(isset($_POST['downloadimg'])){
            
        //     $post = $_POST;
        //     $file_folder = "files/";
        //     if(extension_loaded('zip')){
                
        //         if(isset($post['files']) and count($post['files']) > 0){
                    
        //             $zip = new ZipArchive(); // Load zip library
        //             $zip_name = time().".zip"; // Zip File Name
        //             if($zip->open($zip_name,ZIPARCHIVE::CREATE)!==TRUE){
        //                 $error .= "Sorry ZIP Creation failed at this time!";
        //             }
        //             foreach($post['files'] as $file){
        //                 $zip->addFile($file_folder.$file); // Adding Files into ZIP
        //             }
                    
        // $zip->close();
        //             if(file_exists($zip_name)){

        //                 // Push the download to zip
        // header('Content-type: application/zip');
        // header('Content-Dispostion: attachment; filename="'.$zip_name.'"');
        // readfile($tmp_file);    
        //                 // Remove ZIP File if it exists in temp path
        //                 unlink($zip_name);
        //                 echo "hhdd";
        //             }
        //             echo "hhd";
        //         }
        //         else{
        //             $error .= "Please Select file to zip";
        //         }
        //     }
        //     else{
        //         $error .= "You do not have zip extension loaded";
        //     }
        
        // }
        
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
        <?php echo $error; ?>
        <form name="zips" class="form-group" method="post">
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
                                    <input type="checkbox" name="files[]" id="" value="<?php echo $data['albums'][$correctIdNumber]['photos'][$k]['images'][0]['source'];  ?>">
                                <p> <?php echo "Image " . $k  ?></p>
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
            <div class="col-md-12">
                <input type="submit" class="btn btn-success" name="downloadimg" value="Download Selected">
            </div>
        </form>
        
    </div>
<?php include_once "./include/footer.php" ?>