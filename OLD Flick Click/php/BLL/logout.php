<?php
// checks if the user wats to logout
if (isset($_POST['logout'])){
    logout();
}

//function to end session and logout
function  logout(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_destroy();
    
    header('Location: ../index.php');
}

