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
        include_once 'DAL/get_contact.php';
        $contact = get_contact_info();

        // Checks if user is trying to log in
        if(isset($_POST['sign_in'])){
            include_once 'BLL/validate_login.php';
            login();
        }

        // If the user want to send a message
        if(isset($_POST['contact'])){
            include_once 'BLL/send_message.php';
            send_message();
        }
        ?>
        
        <div class="container">
            <div class="row">
                <h1><b>Contact</b></h1>
            </div>
            <div class="row">
                <p><?php echo $contact["Description"]?></p>
            </div>
            <div class="row">
                <div class="col contact-form">
                    <h2 class="red-text"><b>Get in touch</b></h2>
                    <form method="POST">
                        <div class="form-group">
                            <input required maxlength="100" name="Name" type="text" class="form-control" id="inputName" placeholder="Your Name...">
                        </div>
                        <div class="form-group">
                            <input required maxlength="150" name="Email" type="email" class="form-control" id="inputEmail" placeholder="Your Email Address...">
                        </div>
                        <div class="form-group">
                            <textarea required name="Message" maxlength="1000" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Your Message..."></textarea>
                        </div>
                        <button type="submit" name="contact" class="btn btn-secondary">Send</button>                        
                    </form>
                </div>
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
