<?php
include_once 'get_connection.php';

// Function to delete news
function delete_news($newsID){
    $conn = conn();
    
    $sql = 'DELETE FROM news WHERE NewsID = '.$newsID.'; ';

    $result = $conn->multi_query($sql);
    
    return $result;
}
