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
                            <h3 class="panel-title"> <?php print_r($current_album['name']); ?> </h3>
                        </div>
                        <div class="panel-body">
                            <img src="<?php echo $current_album['picture']['url'] ?>" alt="photo" srcset="">
                            <p>Count: <?php print_r($current_album['count']); ?></p>
                            <?php
                                if(isset($current_album['description'])){
                                    echo $current_album['description'];
                                }                              
                            ?><br>
                            <a href="./single.php?id=<?php echo $current_album['id'] ?>" target="_blank">View Individual Photos</a>
                            <input type="hidden" name="albumId" id="albumId<?php echo $current_album['id'] ?>" value="<?php echo $current_album['id'] ?>">
                            <br>
                            <input type="submit" class="submit btn btn-sm btn-info" value="Download album in Zip" name="<?php echo $current_album['id'] ?>">               
                        </div>
                    </div>
                </div>
        <?php
            $i++;
            }
        ?>
        <div class="col-md-12" id="result">
        
        </div>
    </div>
    <script>
        $(document).ready(function(){

            $(".submit").click(function(){
                var id = $(this).attr('name');
                var albumId = $("#albumId" + id).val();
                alert(albumId);
                // $.post("ajax.php", {name: uname, email: uemail, password: upassword}, function(data){

                //     $("#result").html(data);

                // })
                    
                $.ajax({
                    type: 'POST',
                    url: './include/getData.php',
                    data: {album_id: albumId},
                    success: function(data){
                        $("#result").html(data);
                    }
                });
            });
        });
    </script>
<?php include_once "./include/footer.php" ?>