<?php
include_once 'get_connection.php';

//Function to create comment
function create_comment($userID, $comment, $postDate, $movieID){
    $conn = conn(); 
    
    $comment = $conn->real_escape_string($comment);
    
    
    $sql = 'INSERT INTO comment(UserID, CommentText, PostDate, MovieID) VALUES ("'.$userID.'","'.$comment.'","'.$postDate.'","'.$movieID.'")';
    
    if ($conn->query($sql) === TRUE) {
        alert("Comment posted");
        //returns to the movie page (clears post)
        header("location: movie.php?movie=".$movieID);
    }
    else{
        alert("An error ocured comment not posted");
    }
}

