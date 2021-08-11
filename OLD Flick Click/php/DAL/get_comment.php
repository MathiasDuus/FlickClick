<?php
include_once 'get_connection.php';
include_once 'get_movie.php';

// gets comments related to a specific movie
function get_comment($movieID){
    $conn = conn();
    $sql = 'SELECT comment.CommentText, comment.PostDate, user.UserID, user.FirstName, user.LastName'
            . ' FROM comment '
            . ' LEFT JOIN user'
            . ' ON comment.UserID = user.UserID'
            . ' WHERE MovieID = '.$movieID; 
    $result = $conn->query($sql);
    
    $i = 0;
    $comment = array();
    
    while($row = $result->fetch_assoc()){
    
        $comment[$i] = array(
            "comment_text" =>$row["CommentText"],
            "post_date" =>$row["PostDate"],
            "user_name" =>$row["FirstName"].' '.$row["LastName"]
            );
        $i++;
    }
    return $comment;
}

// gets comments related to a user
function get_specific_comment($userID){
    $conn = conn();
    $sql = 'SELECT * FROM comment WHERE UserID = '.$userID; 
    $result = $conn->query($sql);
    
    $i = 0;
    $comment = array();
    
    while($row = $result->fetch_assoc()){
    
        $comment[$i] = array(
            "comment_text" =>$row["CommentText"],
            "post_date" =>$row["PostDate"],
            "movie_name" => get_specific_movie($row["MovieID"])["title"]
            );
        $i++;
    }
    return $comment;
}

// gets all comments
function get_all_comment(){
    $conn = conn();
    $sql = 'SELECT comment.*, movie.Title'
            . ' FROM comment '
            . ' LEFT JOIN movie'
            . ' ON comment.MovieID = movie.MovieID';
    
    $result = $conn->query($sql);
    
    $i = 0;
    $comment = array();
    
    while($row = $result->fetch_assoc()){
    
        $comment[$i] = array(
            "commentID" =>$row["CommentID"],
            "userID" =>$row["UserID"],
            "comment_text" =>$row["CommentText"],
            "post_date" =>$row["PostDate"],
            "MovieID" =>$row["MovieID"],
            "movie_title" =>$row["Title"]
            );
        $i++;
    }
    return $comment;
}