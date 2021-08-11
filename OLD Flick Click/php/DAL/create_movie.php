<?php
include_once 'get_connection.php';
include_once 'insert_person.php';
include_once 'insert_genre.php';
include_once 'get_genre.php';
include_once 'get_person.php';
include_once 'bin/alert.php';

// Function to create movie
function create_movie($movie){
    $conn = conn(); 
    
    $title = $conn->real_escape_string($movie['title']);
    
    $description = $conn->real_escape_string($movie['description']);
    
    $trailer_url = $conn->real_escape_string($movie['trailer_url']);
    
    $age_rating = $conn->real_escape_string($movie['age_rating']);
    
    $genre = $conn->real_escape_string($movie['genre']);
    
    $director= $conn->real_escape_string($movie['director']);
    
    $writer = $conn->real_escape_string($movie['writer']);
    
    $actor = $conn->real_escape_string($movie['star']);
    
    $poster = $movie["poster"];
    $duration = $movie["duration"];
    $release_date = $movie["release_date"];
    
    
    
    $sql = 'INSERT INTO movie(Title, Description, TrailerURL, Poster, AgeRating, Duration, ReleaseDate) VALUES ("'.$title.'","'.$description.'","'.$trailer_url.'","'.$poster.'","'.$age_rating.'","'.$duration.'","'.$release_date.'");';
    
    $result = $conn->query($sql);
    

// If the movie is inserted add movie_genre and crew to it
    if($result){
        $sqlMovie = 'SELECT MovieID FROM movie WHERE Title = "'.$title.'"';

        $resultNew = $conn->query($sqlMovie);
        $newMovie = $resultNew->fetch_assoc();
        
        $genre = explode(' ', $genre);
    
        for($i=0;$i<count($genre);$i++){
            insert_genre($genre[$i]);
            
            $DBgenre = get_specific_genre($genre[$i]);
            $genreID = $DBgenre["GenreID"];

            $sqlMovieGenre = 'INSERT INTO movie_genre(MovieID, GenreID) VALUES ("'.$newMovie["MovieID"].'","'.$genreID.'");';
            $conn->query($sqlMovieGenre);
        }
        
        
        $director = explode(', ', $director);
        for($i=0;$i<count($director);$i++){
            insert_person($director[$i]);
            $personID = get_person_id($director[$i]);
            
            $sqlDirector = 'INSERT INTO crew(PersonID, MovieID, JobID) VALUES ("'.$personID.'","'.$newMovie["MovieID"].'",1);';
            $conn->query($sqlDirector);
        }
        
        
        $writer = explode(', ', $writer);
        for($i=0;$i<count($writer);$i++){
            insert_person($writer[$i]);
            $personID = get_person_id($writer[$i]);

            $sqlWriter= 'INSERT INTO crew(PersonID, MovieID, JobID) VALUES ("'.$personID.'","'.$newMovie["MovieID"].'",2);';
            $conn->query($sqlWriter);
        }
        
        $actor = explode(', ', $actor);
        for($i=0;$i<count($actor);$i++){
            insert_person($actor[$i]);
            $personID = get_person_id($actor[$i]);

            $sqlActor = 'INSERT INTO crew(PersonID, MovieID, JobID) VALUES ("'.$personID.'","'.$newMovie["MovieID"].'",3);';
            $conn->query($sqlActor);
        }
        
        
        
    }
    
    if ($result === TRUE) {
        alert("Movie created");
    }
    else{
        alert("An error ocured movie not created");
    }
}

