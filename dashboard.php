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
            $i=0;
            foreach($data['albums'] as $current_album)
            {
        ?>
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $current_album['name'] ?> </h3>
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
                            <!-- <input type="button" class="btn btn-sm btn-primary" value="Start Slideshow" name="<?php echo $current_album['id'] ?>" data-toggle="modal" data-target="<?php echo "#".$current_album['id'] ?>"> -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="<?php echo "#".$current_album['id'] ?>">Open Modal</button>
                            <input type="submit" class="submit btn btn-sm btn-info" value="Download album in Zip" name="<?php echo $current_album['id'] ?>">               
                
                
                            <div class="modal fade" id="<?php echo $current_album['id'] ?>" role="dialog">
                                <div class="modal-dialog ">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            
                                            <ul class="rslides">
                                            <?php 
                                            if(!empty($current_album['photos'])){
                                                foreach($current_album['photos'] as $photos){
                                            ?>
                                                    <li><img src="<?php echo $photos['images'][0]['source'];?>" alt=""></li>
                                            <?php 
                                                }
                                            }
                                            else{
                                                echo "Sorry, This album doesn't contain any photos.";
                                            }
                                            ?>
                                            </ul>
                                            <p>Some text in the modal.</p>    <!-- Dig this http://responsiveslides.com/ -->
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    

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
        $(function() {
            $(".rslides").responsiveSlides({
                auto: true,             // Boolean: Animate automatically, true or false
                speed: 1000,            // Integer: Speed of the transition, in milliseconds
                timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
                pager: false,           // Boolean: Show pager, true or false
                nav: true,             // Boolean: Show navigation, true or false
                random: false,          // Boolean: Randomize the order of the slides, true or false
                pause: false,           // Boolean: Pause on hover, true or false
                pauseControls: true,    // Boolean: Pause when hovering controls, true or false
                prevText: "Previous",   // String: Text for the "previous" button
                nextText: "Next",       // String: Text for the "next" button
                maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
                navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
                manualControls: "",     // Selector: Declare custom pager navigation
                namespace: "rslides",   // String: Change the default namespace used
                before: function(){},   // Function: Before callback
                after: function(){}     // Function: After callback
            });
        });
</script>
  
<?php include_once "./include/footer.php" ?>