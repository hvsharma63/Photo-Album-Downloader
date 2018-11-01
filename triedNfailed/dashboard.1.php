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
        <div class="col-md-2 col-md-offset-10">
            <div class="form-group">
                <button class="btn btn-success">Download via selection</button>
            </div>
        </div>
        <!-- https://nanogallery2.nanostudio.org/documentation.html#ngy2_gallery_thumbnails_hover visit for more details documentation -->
        <div id="nanogallery2"
                data-nanogallery2 = '{
                    "thumbnailWidth":   "auto",
                    "thumbnailHeight":  300,
                    "thumbnailGutterWidth": 10,
                    "thumbnailGutterHeight": 10,
                    "thumbnailBorderHorizontal": 1,
                    "thumbnailDisplayInterval": 30,
                    "thumbnailDisplayTransition": "slideLeft",
                    "thumbnailStacks": 2,
                    "galleryTheme":    {
                        "navigationBreadcrumb": { "background": "#008" }
                    },
                    "viewerTheme":      {
                        "background": "#008"
                    },
                    "thumbnailHoverEffect2": "imageScaleIn80|imageSepiaOff|labelAppear75",
                    "thumbnailSelectable": true,
                    "thumbnailAlignment": "center",
                    "galleryFilterTags": true
                }'
        >
        <?php 
            $i=1;
            foreach($data['albums'] as $current_album)
            {
        ?>    
            <!-- content of the gallery -->
            
            <!-- first album -->
            

            <!-- second album -->
            <!-- <a href="" data-ngkind="album" data-ngid="2" data-ngthumb="berlin3t.jpg">Album B</a>
            <a href="berlin3.jpg" data-ngid="20" data-ngalbumid="2" data-ngthumb="berlin3t.jpg">Image 1</a>
            <a href="berlin2.jpg" data-ngid="21" data-ngalbumid="2" data-ngthumb="berlin2t.jpg">Image 2</a>
            <a href="berlin3.jpg" data-ngid="22" data-ngalbumid="2" data-ngthumb="berlin3t.jpg">Image 3</a> -->
                <?php 
                if(!empty($current_album['photos'])){

                ?>
                    <a href="" data-ngkind="album" data-ngid="<?php echo $current_album['id'] ?>" data-ngthumb="<?php echo $current_album['picture']['url'] ?>"><?php print_r($current_album['name']); ?> </a>
                    <?php
                        $k=0;
                        foreach($current_album['photos'] as $photos){
                    ?>
                        <a href="<?php echo $photos['images'][0]['source'];?>" data-ngid="<?php echo $k ?>" data-ngalbumid="<?php echo $current_album['id'] ?>" data-ngthumb="<?php echo $photos['images'][0]['source'];?>">Image 2</a>
                    <?php
                        $k++;
                        }
                    ?>
                <?php
                }
                ?>
        <?php
            $i++;
            }
        ?>
        </div>
        Selected items:<br>
        - counter: <span id="nb_selected">0</span><br>
        - items: <span id="selection"></span><br>

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
            
            // retrieve selected items
            $("#nanogallery2").on( 'itemSelected.nanogallery2 itemUnSelected.nanogallery2', function() {
            var ngy2data = $("#nanogallery2").nanogallery2('data');
            
            //counter
            jQuery('#nb_selected').text(ngy2data.gallery.nbSelected);
            
            // selected items
            var sel = '';
            ngy2data.items.forEach( function(item) {
                if( item.selected ) {
                sel += item.GetID() + '[' + item.title + '] ';
                }
            });
            jQuery('#selection').text(sel);
            });
            
        });
        
    </script>
<?php include_once "./include/footer.php" ?>