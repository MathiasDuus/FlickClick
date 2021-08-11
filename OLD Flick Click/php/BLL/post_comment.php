<?php
include_once 'DAL/get_user.php';
include_once 'DAL/create_comment.php';
include_once 'bin/alert.php';

// Function to post a comment
function post_comment($movieID){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $user = get_specific_user($_SESSION['user_mail']);
    
    if ($user){
        $userID = $user["UserID"];
        $postDate = date("Y-m-d");
        $comment = $_POST["comment"];
        create_comment($userID, $comment, $postDate, $movieID);
    }
    else {
        alert("An error occurred while posting this comment");
    }
    
}

