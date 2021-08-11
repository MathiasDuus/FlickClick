<?php
// Checks if a session is active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create new user</title>
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

        // Checks if the user is logged in
        if(isset($_POST['sign_in'])){
            include_once 'BLL/validate_login.php';
            login();
        }
        
        // If the user tries to sign up´, start creation of a new user
        if(isset($_POST['sign_up'])){
            include_once 'BLL/new_user.php';
            create_new_user();
        }
        
        ?>
        
        
        <div id="login_form" class="container">
        
            <form method="POST" action="" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputFirstName">First name</label>
                  <input required maxlength="20" type="text" name="first_name" class="form-control" id="inputFirstName" placeholder="John">
                </div>
                  
                <div class="form-group col-md-6">
                  <label for="inputLastName">Last name</label>
                  <input required maxlength="50" type="text" name="last_name" class="form-control" id="inputLastName" placeholder="Hansen">
                </div>
              </div>
                
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail">Email</label>
                  <input required maxlength="75" type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
                  
                <div class="form-group col-md-6">
                  <label for="inputPassword">Password</label>
                  <input required maxlength="150"
                         title="Password must be at least 8 characters long and must contain at least one lower case letter, one upper case letter, a number and a special character" 
                         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                         type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
              </div>
                
              <div class="form-group">
                <label for="inputAddress">Address</label>
                <input required maxlength="340" type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
              </div>
                
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">City</label>
                  <input required maxlength="150" type="text" name="city" class="form-control" id="inputCity">
                </div>
                  
                <div class="form-group col-md-2">
                  <label for="inputZip">Zip</label>
                  <input required min="0" max="9999" type="number" name="zip" class="form-control" id="inputZip">
                </div>
                  
                <div class="form-group col-md">
                  <label for="inputTelephonenumber">Telephone number</label>
                  <input required type="number" min="0" max="99999999" name="tele" class="form-control" id="inputTelephonenumber" placeholder="12345678">
                </div>
              </div>
                
              <div class="form-group">
                <label for="uploadProfilePicture">Upload profile picture</label>
                <input required type="file" name="profile_pic" class="form-control-file" accept="image/*" id="uploadProfilePicture">
              </div>
                
                <button type="submit" name="sign_up" class="btn btn-primary">Sign up</button>
            </form>
            

        </div>
    
    <footer id="footer" class="footer">
    </footer>
        
<!--        All Java Script files  -->
    <?php
    include 'bin/JavaScriptLinks.php';
    ?>
  </body>
</html>













