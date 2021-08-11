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

        // Checks if user is logged in
        if(isset($_POST['sign_in'])){
            include_once 'BLL/validate_login.php';
            login();
        }
        // Checks if the user wants to post a comment
        if(isset($_POST["post_comment"])){
            include_once 'BLL/post_comment.php';
            post_comment($_POST["post_comment"]);
        }
        ?>
        
        <div class="container">                
            
            <?php
            // If movie is set, display the movie with that ID
            if(isset($_GET['movie'])){
                include_once 'BLL/sort_movie.php';
                $movieID = filter_var($_GET["movie"], FILTER_SANITIZE_NUMBER_INT);
                list($movie, $director, $writer, $actor, $genre)= movie_details($movieID);
            ?>
            
                <div id="top_movie" class="row">
                    <div class="col-md">
                        <h1><b><?php echo $movie["title"]; ?></b></h1>
                    </div>
                    <div class="col-md">
                        <p class="float-right">Comments: <?php echo $movie["comment_count"] ?? "N/A"; ?></p>
                    </div>                
                </div>
                <div id="top_info_movie" class="row">
                    <div class="col-md">
                        <P><b>Age Rating: </b><b class="red-text"><?php echo $movie["age_rating"] ?? "N/A"; ?></b></P>
                    </div>
                    <div class="col-md">
                        <P><b>Duration: </b><b class="red-text"><?php echo $movie["duration"] ?? "N/A"; ?></b></P>
                    </div> 
                    <div class="col-md">
                        <P><b>Genres: </b><b class="red-text"><?php for($i=0;$i<count($genre);$i++){if($i>0){echo ', ';} echo $genre[$i] ?? "N/A"; } ?></b></P>
                    </div>
                    <div class="col-md">
                        <P class="float-right"><b>Release Date: </b><b class="red-text"><?php echo $movie["release_date"] ?? "N/A"; ?></b></P>
                    </div> 
                </div>
                <div id="poster_trailer" class="row">
                    <div class="col-md-3">
                        <img id="poster_movie" src="<?php echo $movie["poster_path"]; ?>" alt="Movie poster">
                    </div>
                    <div class="col-md">
                        <iframe id="trailer_movie" type="text/html"
                        src="<?php echo $movie["trailer_url"]; ?>">
                        </iframe>
                    </div>         
                </div>
                <div id="button_info_movie" class="row">
                    <div class="col-md">
                        <P><b>Director: </b><b class="red-text"><?php for($i=0;$i<count($director);$i++){if($i>0){echo ', ';} echo $director[$i] ?? "N/A";} ?></b></P>                        
                    </div>
                    <div class="col-md">
                        <P><b>Writers: </b><b class="red-text"><?php for($i=0;$i<count($writer);$i++){if($i>0){echo ', ';} echo $writer[$i] ?? "N/A";} ?></b></P>                        
                    </div> 
                    <div class="col-md">
                        <P><b>Stars: </b><b class="red-text"><?php for($i=0;$i<count($actor);$i++){if($i>0){echo ', ';} echo $actor[$i] ?? "N/A"; } ?></b></P>                        
                    </div>                
                </div>
                <div id="description_title_movie" class="row">
                    <h2><b>Description</b></h2>
                </div>
                <div id="description_movie" class="row">
                    <p><?php echo $movie["description"] ?? "N/A"; ?></p>
                </div>
                <div id="description_comment_count" class="row">
                    <p>Comments: <?php echo $movie["comment_count"] ?? "N/A"; ?></p>
                </div>
                <?php 
                // check if a session is active

                
                // If the user is logged in enable it to post a comment
                if (isset($_SESSION['user_mail'])) {
                ?>
            
                <div id="comment_title_movie" class="row">
                    <h3><b>Post a comment</b></h3>
                </div>
                <div id="post_comment_movie" class="row">

                    <form id="comment_form" method="POST" action="">
                        <div class="form-group row">
                            <label for="movie_comment"></label>
                            <textarea maxlength="500" name="comment" class="form-control" id="movie_comment" rows="5" placeholder="Write your comment here..."></textarea>
                        </div>
                        <div class="form-group row">
                            <button id="cms_button" type="submit" name="post_comment" value="<?php echo $movie["movieID"]; ?>" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                </div>
                <?php
                
                } else {?>
                    <div class="row">
                        <h3><b>To post a comment you must be logged in</b></h3>
                    </div>
                <?php
                }
                include_once 'BLL/show_comment.php';
                $comment = show_comment($movieID);
                // Loop to show all comment on this movie
                for ($i=0;$i<count($comment);$i++){
                ?>
                    <div id="comment_title" class="row">
                        <p><?php echo $comment[$i]["user_name"];?> <span class="red-text"><?php echo $comment[$i]["post_date"];?></span></p>
                        
                    </div>
                    <div class="row">
                        <p><?php echo nl2br($comment[$i]["comment_text"]);?> </p>
                    </div>
                <?php
                }
            }
            ?>
            
            
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
