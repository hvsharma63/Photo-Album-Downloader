<?php 
    require_once "config.php";
    if(isset($_SESSION['fb_access_token'])){
        $data = $_SESSION['data'];         
        //echo '<a href="logout.php">Log out!</a>';
    }
    else{
        header("Location:index.php");
    }
?>
<?php include_once "./include/header.php"; 
    include_once "./include/head.php";
?>    

    <div class="container" style="margin-top: 30px;">
        <div class="card-deck">
        <?php 
            $i=0;
            foreach($data['albums'] as $current_album)
            {
        ?>
                <div class="col-md-4" style="margin-bottom: 50px;">
                    <div class="card bg-white text-white">
                        <img class="card-img" src="<?php echo $current_album['picture']['url'] ?>" alt="Card image">
                        <div class="reveal card-img-overlay" >
                            <h5 class="card-title"><?php echo $current_album['name'] ?></h5>
                            <p class="card-text">Count: <?php print_r($current_album['count']); ?></p></p>
                            <br>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">View Images</button>
                            <br><button type="button" class="btn btn-primary">View Individual photos</button>
                            <br><button type="button" class="btn btn-success">Download in zip</button>
                        </div>
                    </div>
                </div>
        <?php
            $i++;
            }
        ?>
            <!-- Large modal -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                ...
                </div>
            </div>
            </div>
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