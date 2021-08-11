<?php
include_once 'get_connection.php';

// Function to delte comment
function delete_comment($commentID){
    $conn = conn();
    
    $sql = 'DELETE FROM comment WHERE CommentID ='.$commentID.'; ';

    $result = $conn->query($sql);
    
    return $result;
}
