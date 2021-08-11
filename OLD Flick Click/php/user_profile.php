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
        
        // Checks if the user is trying to update their profile
        if(isset($_POST['update_user'])){
            include_once 'BLL/edit_user.php';
            edit_user($_POST["update_user"]);
        }
        
        // If the user is logged in, display their profile
        if (isset($_SESSION['user_mail'])) {
            include_once 'DAL/get_user.php';
            // Gets all relevant info regarding a specific user
            $user = get_specific_user($_SESSION['user_mail']);
        ?>
        
        <div class="container">                
            <div class="row" id="user_name">
                <h1 class="col"><?php echo $user["FirstName"].' '.$user["LastName"]; ?></h1>
            </div>
            <div class="row">
                <div class="col-3">
                    <img class="profile_pic" src="<?php echo "../images/user/".$user["ProfilePic"]; ?>" alt="Profile Picture">
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <p><b>Address: </b><?php echo $user["Address"]; ?></p>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <p><b>E-mail: </b><?php echo $user["Email"]; ?></p>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><b>Telephone Nr: </b><?php echo $user["Tele"]; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><b>oprettelsesdato: </b><?php echo $user["Date"]; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <?php
                    // If the user is an admin, display the CMS button
                    if (isset($_SESSION['access_level']) && $_SESSION['access_level'] === 2) {
                    ?>
                    <form method="POST" action="cms.php">
                        <button type="submit" name="go_cms" class="btn btn-info">CMS</button>
                    </form>
                    <?php       
                    }
                    // If the user has pressed the edit button display the update_user form
                    if(isset($_POST["user_edit"])){?>
                    <h2>Rediger profil</h2>
                    <?php
                        include 'bin/user_edit.php'; 
                    }else{
                    ?>
                    <form method="POST" action="">
                        <button type="submit" name="user_edit" class="btn btn-success">Edit</button>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col" id="comment_user">
                <h2><b>Comments:</b></h2>
                <?php
                include_once 'DAL/get_comment.php';
                // Gets all comments related to this user
                $comment = get_specific_comment($user["UserID"]);
                
                // Sorts the comments so the newest comment is first
                usort($comment, function ($a, $b) {
                return $b["post_date"] <=> $a["post_date"];
                });
                
                // Loop to display all comments
                for($i=0;$i< count($comment);$i++){
                ?>
                <div class="row">
                    <h3><?php echo $comment[$i]["movie_name"]; ?> <span class="red-text"><?php echo $comment[$i]["post_date"]; ?></span></h3>
                </div>
                <div class="row">
                    <p><?php echo nl2br($comment[$i]["comment_text"]); ?></p>
                </div>
                
                <?php
                }
                ?>
            </div>
            
        </div>
    
    <footer id="footer" class="footer">
    </footer>
        
<!--        All Java Script files  -->
    <?php
        }
    include 'bin/JavaScriptLinks.php';
    ?>
  </body>
</html>
