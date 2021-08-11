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
        include_once 'BLL/sort_news.php';
        include_once 'BLL/sort_movie.php';

        // Checks if the user wants to log in
        if(isset($_POST['sign_in'])){
            include_once 'BLL/validate_login.php';
            login();
        }
        ?>
        
        <div class="container">                
            <div id="front" class="row">
                
                <div class="frontpage-title row"> 
                    <p> LATEST TRAILERS </p>
                    <a href="filter.php?filter=latest_trailer">See all</a>
                </div>
                
                <?php
                
                //--------------------------- LATEST TRAILER -----------------------------------

                include_once 'BLL/sort_movie.php';
                $movie = released_movie();
                // Sort the array so the newest movie is first
                usort($movie, function ($a, $b) {
                return $b["release_date"] <=> $a["release_date"];
                });
                // loop to display the 6 latest movies if less than 6 movies exist display them
                for($i=0;$i<6 && $i< count($movie);$i++){
                ?>
                    <div class="col-lg card-margin">
                      <div class="card">
                          <img class="card-img card-image" src="<?php echo $movie[$i]["poster"]; ?>" alt="Movie poster">
                          
                          <div class="card-img-overlay">
                            <a href="movie.php?movie=<?php echo $movie[$i]["movieID"];?>">
                                <img alt="Movie Poster Overlay" class="card-image" src="../images/poster-overlay.png">
                            </a>
                            <p id="poster-overlay-title"><?php echo $movie[$i]["title"];?></p>
                          </div>
                          
                          <div class="img-container">
                            <img class="comment-bubble" src="../images/comment-icon.png" alt="Comment icon"/>
                            <p class="card-title commentCount"><?php echo $movie[$i]["comment_count"]; ?></p>
                          </div>
                      </div>
                    </div>    
                <?php
                }
                ?>

            </div>
            <div id="most-commented" class="row">
                
                <div class="frontpage-title row"> 
                    <p> MOST COMMENTED </p>
                    <a href="filter.php?filter=most_commented">See all</a>
                </div>
                
                <?php
                //------------------------------------------ MOST COMMENTED --------------------------------------
                //Sort array according to the comment count
                usort($movie, function ($a, $b) {
                    return $b["comment_count"] <=> $a["comment_count"];
                });
                
                // loop to display the 6 most commented movies if less than 6 movies exist display them
                for($i=0;$i<6 && $i< count($movie);$i++){
                ?>
                    <div class="col-lg card-margin">
                      <div class="card">
                          <img class="card-img-top card-image" src="<?php echo $movie[$i]["poster"]; ?>" alt="Movie poster">
                            <div class="card-img-overlay">
                                <a href="movie.php?movie=<?php echo $movie[$i]["movieID"];?>">
                                    <img alt="Movie Poster Overlay" class="card-image" src="../images/poster-overlay.png">
                                </a>
                                <p id="poster-overlay-title"><?php echo $movie[$i]["title"];?></p>
                            </div>
                          <div class="img-container">
                            <img class="comment-bubble" src="../images/comment-icon.png" alt="Comment icon"/>
                            <p class="card-title commentCount"><?php echo $movie[$i]["comment_count"]; ?></p>
                          </div>
                      </div>
                    </div>    
                <?php
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
