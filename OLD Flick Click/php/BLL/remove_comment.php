<?php
include_once 'DAL/delete_comment.php';

//Function to remove comment
function remove_comment($commentID){
    return delete_comment($commentID);
}
