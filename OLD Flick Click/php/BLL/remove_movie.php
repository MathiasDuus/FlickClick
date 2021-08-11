<?php
include_once 'bin/alert.php';
include_once 'DAL/delete_movie.php';

// Function to remove movie
function remove_movie(){
    
    $movieID = $_POST['MovieID'];
    
    if (delete_movie($movieID)){
        alert($_POST['Title']." deleted successfully");
    }
    else{
        alert("An error occurred");
    }
}

