<?php
include_once 'DAL/update_user.php';

// function to edit the users info
function edit_user($userMail){
    
    // checks if the checkbox to change password is clicked and set password string to user input
    // else set password string to ""
    if(isset($_POST["change_password"]) && $_POST["change_password"]) {
        $password = $_POST["password"];
    }
    else{
        $password ="";
    }
    
    // checks if the checkbox to update profile picture is clicked and set pic string to user input
    // else set pic string to ""
    if(isset($_POST["updatePic"]) && $_POST["updatePic"]){
        $pic = $_FILES["profile_pic"]["name"];
    }
    else{
        $pic ="";
    }
    
    $user = array(
        "first_name"=>$_POST["first_name"],
        "last_name"=>$_POST["last_name"],
        "address"=>$_POST["address"],
        "email"=>$_POST["email"],
        "user_mail"=>$userMail,
        "tele"=>$_POST["tele"]
    );
    
    // updates the users info in the database and sets the session user_mail to the new mail
    if(update_user($user, $pic, $password)){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["user_mail"] = $user["email"];
        header("location: user_profile.php");
    }
    else{
        alert($_POST["error"]??"An error occurred");
        return;
    }
}




