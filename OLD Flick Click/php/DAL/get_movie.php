<?php
include_once 'get_connection.php';

// Gets all info in the movie table
function movie(){ 
    $conn = conn();
    $sql = 'SELECT * FROM movie'; 
    $result = $conn->query($sql);

    $movie = array();
    
    $index = 0;
    
    // Loop to populate movie array
    while ($row = $result->fetch_assoc()){
        
        $movieID = $row["MovieID"];
        $comment_count = comment_count($movieID);
        
        $movie[$index] = array(
            "movieID" => $movieID,
            "title"=>$row["Title"],
            "description"=>$row["Description"],
            "trailer_url"=>$row["TrailerURL"],
            "poster" => $row["Poster"],
            "poster_path" => '../images/poster/'.$row["Poster"].'', 
            "age_rating"=>$row["AgeRating"],
            "duration"=>$row["Duration"],
            "release_date"=>$row["ReleaseDate"],
            "comment_count" =>$comment_count,
            );
        $index++;
    }
    
    return $movie;
}

//Returns the numer of comments on a specific movie
function comment_count($movieID){ 
    $conn = conn();
    $sql = 'SELECT * FROM comment WHERE MovieID = '.$movieID; 

    $result = $conn->query($sql);
    
    if ($result) { 
        $rows = $result->num_rows;
    }
    else{
        $rows = 0;
    }
    
    return $rows;
}

// Gets all movies matching with the search
function movie_search($movieTitle){ 
    $conn = conn();
    // Checks the string before used in SQL command
    $movieTitle = $conn->real_escape_string($movieTitle);
    
    // SQL command to find all movie titles that contains the search item
    $sql = 'SELECT * FROM movie WHERE Title LIKE "%'.$movieTitle.'%"';
    $result = $conn->query($sql);
    
    $movie = array();
    
    $index = 0;
    
    // Loops to populate the array
    while ($row = $result->fetch_assoc()){
        
        $movieID = $row["MovieID"];
        $comment_count = comment_count($movieID);
        
        $movie[$index] = array(
            "movieID" => $movieID,
            "title"=>$row["Title"],
            "description"=>$row["Description"],
            "trailer_url"=>$row["TrailerURL"],
            "poster" => $row["Poster"], 
            "poster_path" => '../images/poster/'.$row["Poster"].'', 
            "age_rating"=>$row["AgeRating"],
            "duration"=>$row["Duration"],
            "release_date"=>$row["ReleaseDate"],
            "comment_count" =>$comment_count,
            );
        $index++;
    }
    
    return $movie;
}

// Gets a specific movie
function get_specific_movie($movieID){ 
    $conn = conn();
    $sql = 'SELECT * FROM movie WHERE MovieID = '.$movieID; 
    $result = $conn->query($sql);

    
    $row = $result->fetch_assoc();
        
    $movieID = $row["MovieID"];
    $comment_count = comment_count($movieID);

    $movie = array(
        "movieID" => $movieID,
        "title"=>$row["Title"],
        "description"=>$row["Description"],
        "trailer_url"=>$row["TrailerURL"],
        "poster" => $row["Poster"],
        "poster_path" => '../images/poster/'.$row["Poster"].'', 
        "age_rating"=>$row["AgeRating"],
        "duration"=>$row["Duration"],
        "release_date"=>$row["ReleaseDate"],
        "comment_count" =>$comment_count,
        );
    
    return $movie;
}

