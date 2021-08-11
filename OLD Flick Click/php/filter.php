<?php
// Checks if a session is active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Flick Click</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../css/Style.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body onload="runJS();">        
        <header id="header">
        </header>
        <?php
        include_once 'bin/alert.php';

        // Checks if the user is trying to sign in
        if(isset($_POST['sign_in'])){
            include_once 'BLL/validate_login.php';
            login();
        }
        ?>

        <div class="container">           
            
            <div id="front" class="row">
                
                <?php
                $movie = array();

                // Check if a filter is active
                if(isset($_GET['filter'])){
                    include_once 'BLL/filter_movie.php';
                    $movie = filter_movie($_GET['filter']);
                }
                // Checks $movie isn't NULL/unset
                if($movie){
                    //loop through all movies and display them
                    for($i=0;$i< count($movie);$i++){
                    ?>
                        <div class="col-lg-2 card-margin">
                          <div class="card">
                              <img class="card-img card-image" src="<?php echo $movie[$i]["poster"]; ?>" alt="Movie poster">

                              <div class="card-img-overlay">
                                <a href="movie.php?movie=<?php echo $movie[$i]["movieID"];?>">
                                    <img alt="Movie Poster Overlay" class="card-image" src="../images/poster-overlay.png">
                                </a>
                                <p id="poster-overlay-title"><?php echo $movie[$i]["title"];?></p>
                              </div>
                          </div>
                        </div>    

                    <?php

                    }
                }
                
                ?>

            </div>
            
            <div id="news-coming_soon" class="row frontpage-bottom">
               <?php
                //Display news and coming soon
                include 'bin/news_coming_soon.php';
               ?>
            </div>
            
        </div>
    
    <footer id="footer" class="footer">
    </footer>
        
<!--        All Java Script files  -->
    <?php
    include 'bin/JavaScriptLinks.php';
    ?>
  </body>
</html>