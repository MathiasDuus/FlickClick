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
        
        //Checks if the user is logged in
        if(isset($_POST['sign_in'])){
            include_once 'BLL/validate_login.php';
            login();
        }


        // If it is an admin grant access to the CMS, else return to frontpage
        if (isset($_SESSION['access_level']) && $_SESSION['access_level'] = 2) {
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md">
                    <form method="POST" action="">
                        <button type="submit" name="new_movie" class="btn btn-success">New movie</button>
                    </form>
                </div>
                <div class="col-md">
                    <form method="POST" action="">
                        <button type="submit" name="edit_movie" class="btn btn-primary">Edit movie</button>
                    </form>
                </div>
                <div class="col-md">
                    <form method="POST" action="">
                        <button type="submit" name="news" class="btn btn-info">News</button>
                    </form>
                </div>
                <div class="col-md">
                    <form method="POST" action="">
                        <button type="submit" name="contact" class="btn btn-info">Contact</button>
                    </form>
                </div>
                <div class="col-md">
                    <form method="POST" action="">
                        <button type="submit" name="User" class="btn btn-info">User</button>
                    </form>
                </div>
                <div class="col-md">
                    <form method="POST" action="">
                        <button type="submit" name="Comment" class="btn btn-info">Comment</button>
                    </form>
                </div>
            </div>
            <?php
            // If new movie button is pressed display form
            if(isset($_POST['new_movie'])){
                include_once 'bin/add_movie.php';
            }
            
            // If edit movie button is pressed display form
            if(isset($_POST['edit_movie'])){
                include_once 'bin/movie_edit.php';
            }
            
            // If News button is pressed display 3: new, edit, delete news
            if(isset($_POST['news'])){
                include_once 'bin/edit_news.php';
            }
            
            // If User button is pressed display users
            if(isset($_POST['User'])){
                include_once 'bin/user.php';
            }
            
            // If comment button is pressed show all comments on the site
            if(isset($_POST['Comment'])){
                include_once 'bin/comment.php';
            }
            
            // If add_movie try and create a new movie
            if(isset($_POST['add_movie'])){
                include_once 'BLL/new_movie.php';
                new_movie();
            }
            // If edit is pressed try and edit the movie
            if(isset($_POST['edit'])){
                include_once 'BLL/edit_movie.php';
                
                // If the "delete" checkbox is checked try and delete the movie
                if(isset($_POST['delete'])){
                    include_once 'BLL/remove_movie.php';
                    remove_movie();
                }
                else {
                    edit_movie();
                }
            }
            
            // add news is pressed display the form to add news
            if(isset($_POST['add_news'])){
                include_once 'bin/add_news.php';
                // If the add news button at the end of the form is pressed try and create a new news
                if($_POST['add_news']==="add"){
                    include_once 'DAL/create_news.php';
                    create_news();
                }
            }
            // if edit_news show form toi edit news
            if(isset($_POST['edit_news'])){  
                include_once 'bin/news_edit.php';   
            }
            // If edit is pressed try and edit news
            if(isset($_POST['news_edit'])){
                    include_once 'DAL/update_news.php';
                    update_news($_POST['news_edit']);
            }            
            // If delete_news is pressed show form for delete news
            if(isset($_POST['delete_news'])){
                include_once 'bin/remove_news.php';    
            }
            // If edit is pressed try and edit news
            if(isset($_POST['news_delete'])){
                include_once 'DAL/delete_news.php';
                delete_news($_POST['news_delete']);
            }
            
            
            // If contact is pressed show form to edit contact
            if(isset($_POST['contact'])){
                include_once 'bin/edit_contact.php';
            }
            // If update contact is pressed update the contact description
            if(isset($_POST['update_contact'])){
                include_once 'DAL/update_contact_site.php';
                update_contact_site($_POST["Description"]);
            }
            
            
            // If delete user is pressed try and delete user
            if(isset($_POST['delete_user'])){
                include_once 'BLL/remove_user.php';
                remove_user($_POST["delete_user"]);
            }
            
            
            // If delete comment is pressed try and delete comment
            if(isset($_POST['delete_comment'])){
                include_once 'BLL/remove_comment.php';
                remove_comment($_POST["delete_comment"]);
            }
            
            ?>
            
            
        </div>

        
        
<!--        All Java Script files  -->
    <?php
        }
        else{
            header("location: index.php");
        }
    include 'bin/JavaScriptLinks.php';
    ?>
  </body>
</html>