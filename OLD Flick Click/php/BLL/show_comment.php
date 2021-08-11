<?php
include_once 'DAL/get_comment.php';

//Function to get comments
function show_comment($movieID){
    
    return get_comment($movieID);
}

