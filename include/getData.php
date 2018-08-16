<?php
    session_start();
    if(isset($_POST['album_id'])){
        $id = $_POST['album_id' ];
    }
    
    $data = $_SESSION['data'];
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

        // Add files to the zip file inside demo_folder
        // $zip->addFile('test.pdf', 'demo_folder/test.pdf');
        // All files are added, so close the zip file.
    
    
    $files = array();
    
        if($found == 1){    
            for($k=0;$k<count($data['albums'][$correctIdNumber]['photos']);$k++){    
    ?>
                <?php echo $data['albums'][$correctIdNumber]['photos'][$k]['images'][0]['source']; ?>">
    <?php
                $selected = $data['albums'][$correctIdNumber]['photos'][$k]['images'][0]['source'];
                // $selected = explode("?",$selected);
                // $selected = $selected[0];
                array_push($files,$selected);

            }
        }
        else{
            echo "Sorry, Wrong ID! And Hence No Album Found!";
        }
    
    
    
    # create new zip object
    $zip = new ZipArchive();
    
    # create a temp file & open it
    $tmp_file = tempnam('.', '');
    $zip->open($tmp_file, ZipArchive::CREATE);
    
    $l=1;
    # loop through each file
    foreach ($files as $file) {
        # download file
        $download_file = file_get_contents($file);
        
        // $file_name = explode("?",basename($file));
        // $file_name = $file_name[0];
        

        #add it to the zip
        $zip->addFromString($l . ".jpg", $download_file);
        $l++;
    }
    
    # close zip
    $zip->close();
    
    # send the file to the browser as a download
    header('Content-disposition: attachment; filename="my file.zip"');
    header('Content-type: application/zip');
    readfile($tmp_file);
    unlink($tmp_file);
?>