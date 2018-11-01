<?php
    session_start();
    if(isset($_POST['selectedAlbums'])){
        $selectedAlbums = $_POST['selectedAlbums'];
        echo "<pre>";
        $data = $_SESSION['data'];    
        print_r($selectedAlbums);
        // print_r($selectedAlbums[1]);
        // print_r(count($selectedAlbums));
        // print_r($data['albums'][0]);
        // print_r(count($data['albums']));
        exit;
    }
    else{
        echo "Not set";
    }

    $data = $_SESSION['data'];
    
    $files = array();
    $totalAlbums = count($selectedAlbums);
    
    function addToZip($assignedId, $totalAlbums, $data, $files){
        
        // $totalAlbums = count($selectedAlbums);
        for($j=0;$j<count($data['albums']);$j++){
            
            if($assignedId == $data['albums'][$j]['id']){
                $found = 1;
                $correctIdNumber = $j;
                // echo $assignedId;
                // break;
            }
            else{
                $found = 0;
                // echo "Not Found!";
            }

            if($found == 1){
                
                for($k=0;$k<count($data['albums'][$correctIdNumber]['photos']);$k++){
                    
                    $selected = $data['albums'][$correctIdNumber]['photos'][$k]['images'][0]['source']; 
                    // $selected = explode("?",$selected);
                    // $selected = $selected[0];
                    // echo "Individual File: ". $selected;
                    // echo "<br>";
                    array_push($files,$selected);
                    // echo "<pre>";      
                    print_r($files);    
                    // echo "</pre>";         
                    
                }
                
            }
        }
        return $files;
    }
    $newFiles = array();

    for($i=0;$i<$totalAlbums;$i++){    
        $assignedId = $selectedAlbums[$i];
        array_push($newFiles,addToZip($assignedId, $totalAlbums, $data, $files));    
    }
    // echo "Nre FIles";
    // print_r($newFiles);

    $zip = new ZipArchive();
    
    # create a temp file & open it
    // $tmp_file = tempnam('.', '');
    
    $zip->open("album.zip", ZipArchive::CREATE);
    set_time_limit(0);
    
    $l=1;
    # loop through each file
    foreach($newFiles as $secondLayer){
        
        foreach ($secondLayer as $file) {
            # download file
            $download_file = file_get_contents($file);
            
            // $file_name = explode("?",basename($file));
            // $file_name = $file_name[0];
            
            
            #add it to the zip
            $zip->addFromString( "albums/".$l .".jpg", $download_file);
            $l++;
        }
    }
        
    # close zip
    $zip->close();
    
    # send the file to the browser as a download
    set_time_limit(0);
    header('Pragma: public'); 	// required
    header('Expires: 0');	
    header('Content-disposition: attachment; filename="ImgFolder.zip"');
    header('Content-type: application/zip');
    readfile($tmp_file);
    unlink($tmp_file);
?>