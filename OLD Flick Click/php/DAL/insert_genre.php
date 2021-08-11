<?php
include_once 'get_connection.php';
include_once 'get_genre.php';

// Function to create genre
function insert_genre($genre){
    $conn = conn();

    $sqlGenre = $conn->prepare("INSERT INTO genre SET GenreName = ?");
    $sqlGenre->bind_param("s", $genreName);

    // if the genre does not exist create it
    if(genre_exists($genre)==="0"){
        $genreName = $genre;
        $sqlGenre->execute();
    }

}