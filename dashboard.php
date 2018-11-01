<?php 
    require_once "config.php";
    if(isset($_SESSION['fb_access_token'])){
        $data = $_SESSION['data'];
        $logout = 1;    
        // echo '<a href="logout.php">Log out!</a>';
    }
    else{
        header("Location:index.php");
    }
?>


<?php include_once "./include/header.php" ?>
    
    
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Photo-Album Downloader</a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(isset($logout)){
                    if($logout == 1){
                ?>
                <li><a href="logout.php">Logout</a></li>
                <?php
                    }
                }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    
    <div class="container">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Instructions: </strong><br>
            <ul>
                <li>When you start the slideshow, close it by double clicking the <strong>x</strong> icon on the RHS of the window.</li>
                <li>Downloading single or multiple album may take more/less time depending upon the number of photos you have in the album.</li>
                <li>The count of total photos in the album may vary as facebook also counts an image even if the image is somehow deleted or is not made public to all.</li>
            </ul>
        </div>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Notice: </strong> <em>This is the beta site</em> <br>
            <ul>
                <li>This is <code>beta</code> branch. It is ugly coded.</li>
                <li>Refer to the <code>master</code> branch for pretty code and for old update.</li>
            </ul>
        </div>
        
        <div class="navbar">
            <div class="well well-sm well-success" style="background-color:#ddd">
                <div class="radio">
                    Select the download type: 
                    <label>
                        <input type="radio" name="download_type" id="single" value="Single">
                        Single Album
                    </label>
                    <label>
                        <input type="radio" name="download_type" id="multiple" value="Multiple">
                        Multiple Download
                    </label>
                </div>
                <!-- <button id="blob" class="btn btn-primary">click to download</button> -->
                <!-- <button id="blob" name="download_selected" style="display:none" class="btn btn-success d_all">Download Selected Albums</button> -->
                <input type="submit" value="Download Selected Albums" id="download_selected" name="download_selected" style="display:none" class="btn btn-success d_all">
            </div>
        </div>
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
                            <!-- <img src="<?php echo $current_album['picture']['url'] ?>" alt="photo" srcset=""> -->
                            <a data-fancybox-trigger="<?php echo $current_album['id'] ?>" href="#<?php echo $current_album['id'] ?>">
                                <img src="<?php echo $current_album['picture']['url'] ?>" alt="photo" srcset="">
                            </a>
                            <div class="hide" style="display:hidden">
                            <?php 
                                if(!empty($current_album['photos'])){
                                    foreach($current_album['photos'] as $photos){
                            ?>
                                <a href="<?php echo $photos['images'][0]['source'];?>" data-fancybox="<?php echo $current_album['id'] ?>" data-caption="Caption #1">
	                                <img src="<?php echo $photos['images'][0]['source'];?>" alt="" class="aid<?php echo $current_album['id'] ?>" />
                                </a>
                            <?php 
                                }
                            }?>
                            </div>
                            <p>Total Photos in Album: <?php print_r($current_album['count']); ?></p>
                            <p>Description:
                            <?php
                                if(isset($current_album['description'])){
                                    echo $current_album['description'];
                                }else{
                                    echo "<em>Description Not Available</em>";
                                }
                            ?></p>
                            <input type="hidden" name="albumId" id="albumId<?php echo $current_album['id'] ?>" value="<?php echo $current_album['id'] ?>">
                            <a href="./single.php?id=<?php echo $current_album['id'] ?>" target="_blank">View Individual Photos</a>
                            <input type="submit" class="submit btn btn-sm btn-info d_s" style="display:none" value="Download album in Zip" name="<?php echo $current_album['id'] ?>">
                            <br>
                            <p class="d_all" style="display:none"><input type="checkbox" class="d_all" style="display:none" name="selectedAlbum" id="" value="<?php echo $current_album['id'];  ?>">
                            Select this album!</p>
                        </div>
                    </div>
                    <!-- Modal -->
                    
                
                </div>
        <?php
            $i++;
            }
        ?>
        <div class="col-md-12" id="result">
        <?php
        ?>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){

            $('#download_selected').click(function(){
                var selectedAlbums = [];
                $.each($("input[name='selectedAlbum']:checked"), function(){
                    selectedAlbums.push($(this).val());
                });
                // alert(selectedAlbums);
                $.ajax({
                    type: 'POST',
                    url: './include/getAlbums.php',
                    data: {selectedAlbums: selectedAlbums},
                    success: function(data){
                        $("#result").html(data);
                    }
                });
            });

            $('input:radio[name=download_type]').change(function (e) { 
                e.preventDefault();
                if(this.value == 'Single'){
                    $('.d_s').show();
                    $('.d_all').hide();
                }
                else if(this.value == 'Multiple'){
                    $('.d_all').show();
                    $('.d_s').hide();
                }
            });

            $('[data-fancybox="gallery"]').fancybox({
                // Options will go here
            });
            
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