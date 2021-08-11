<?php
include_once 'get_connection.php';

//Function to delete the user
function delete_user($userID){
    $conn = conn();
    
    // first delete all comments by the user
    //the delete the user
    $sql = 'DELETE FROM comment WHERE UserID ='.$userID.'; ';
    $sql .= 'DELETE FROM user WHERE UserID ='.$userID.'; ';

    $result = $conn->multi_query($sql);
    
    return $result;
}
