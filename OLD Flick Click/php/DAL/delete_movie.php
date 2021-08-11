<?php
include_once 'get_connection.php';

//Function to delete movie
function delete_movie($movieID){
    $conn = conn();
    
    $sql = 'DELETE FROM movie_genre WHERE MovieID = '.$movieID.'; ';
    $sql .= 'DELETE FROM crew WHERE MovieID = '.$movieID.'; ';
    $sql .= 'DELETE FROM comment WHERE MovieID = '.$movieID.'; ';
    $sql .= 'DELETE FROM movie WHERE MovieID = '.$movieID.'; ';

    $result = $conn->multi_query($sql);
    
    return $result;
}
