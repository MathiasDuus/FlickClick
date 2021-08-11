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

        // Checks if user is logged in
        if(isset($_POST['sign_in'])){
            include_once 'BLL/validate_login.php';
            login();
        }

        // checks if value is set, else display all news
        if(isset($_GET['value'])){
            // Gets the appropriate news
            $news = specific_news($_GET['value']);
            ?>
            <div class="container">
                <div class="col news">
                    <h1><?php echo $news["Title"]?></h1>
                    <p class="red-text"><?php echo $news["Date"]?></p>
                    <p class="news_long_cut_text"><?php echo $news["Text"]?></p>
                    <a href="javascript:history.back()">Back</a>
                </div>
                <div id="news-coming_soon" class="row frontpage-bottom">

                </div>
            </div>        
        <?php
        }else{?>
            <div class="container">           
                <h1 class="col"><b>News</b></h1>
            <?php
            $news = cut_news();
            
            // Loop to show all news, with a cut text
            for($i=0;$i< count($news);$i++){
        ?>
                <div class="col news">
                    <h2><b><?php echo $news[$i]["title"]?></b></h2> 
                    <p class="red-text"><?php echo $news[$i]["date"]?></p>
                    <p class="news_long_cut_text"><?php echo $news[$i]["text_long_cut"]?></p>
                    <a href="news.php?value=<?php echo $news[$i]["newsID"];?>">Read More</a>
                </div>
        <?php
            }
        ?>
            <div id="news-coming_soon" class="row frontpage-bottom">
               <?php
               //Display news and coming soon
                include 'bin/news_coming_soon.php';
               ?>
            </div>
        </div>
            <?php
        }
        ?>

    
    <footer id="footer" class="footer">
    </footer>
        
<!--        All Java Script files  -->
    <?php
    include 'bin/JavaScriptLinks.php';
    ?>
  </body>
</html>
