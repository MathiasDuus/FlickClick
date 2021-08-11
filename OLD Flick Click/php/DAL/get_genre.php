<?php
include_once 'get_connection.php';

// Gets specific movie_genre name
function get_specific_movie_genre_name($movieID){
    $conn = conn();
    $sql = 'SELECT * FROM movie_genre WHERE MovieID = '.$movieID; 
    $result = $conn->query($sql);
    
    $i = 0;
    $genre = array();
    
    while($row = $result->fetch_assoc()){
        $genre[$i] = get_genre_name($row['GenreID']);
        $i++;
    }
    
    return $genre;
}

// Gets the name of specific genre
function get_genre_name($genreID){
    $conn = conn();
    $sql = 'SELECT * FROM genre WHERE GenreID = '.$genreID; 
    $result = $conn->query($sql);
    $genre_name="";
    if($result){
        $row = $result->fetch_assoc();
        $genre_name = $row['GenreName'];
    }
    return $genre_name;
}

//Gets all genres
function get_genre(){
    $conn = conn();
    $sql = 'SELECT * FROM genre'; 
    $result = $conn->query($sql);
    
    return $result->fetch_assoc();
}

// Gets specific genre
function get_specific_genre($genre_name){
    $conn = conn();
    $sql = 'SELECT * FROM genre WHERE GenreName = "'.$genre_name.'"'; 
    $result = $conn->query($sql);
    if($result){
        $row = $result->fetch_assoc();
        return $row;
    }
}

// Checks if genre exists
function genre_exists($genre_name){
    $conn = conn();
    $sql = 'SELECT EXISTS(SELECT * FROM genre WHERE GenreName = "'.$genre_name.'")';  
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['EXISTS(SELECT * FROM genre WHERE GenreName = "'.$genre_name.'")'];
}

// Gets specific movie_genre ID
function get_specific_movie_genre($movieID){
    $conn = conn();
    $sql = 'SELECT Movie_genreID FROM movie_genre WHERE MovieID = '.$movieID; 
    $result = $conn->query($sql);
    
    $i = 0;
    $genre = array();
    
    while($row = $result->fetch_assoc()){
        $genre[$i] = $row['Movie_genreID'];
        $i++;
    }
    
    return $genre;
}

