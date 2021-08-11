<?php
include_once 'get_connection.php';
include_once 'insert_person.php';
include_once 'insert_genre.php';
include_once 'get_crew.php';
include_once 'upload_image.php';


function update_movie($movie){
    $conn = conn();
    // REGION
    // checks the string for illegal chars
    $title = $conn->real_escape_string($movie['title']);
    
    $description = $conn->real_escape_string($movie['description']);
    
    $trailer_url = $conn->real_escape_string($movie['trailer_url']);
    
    $age_rating = $conn->real_escape_string($movie['age_rating']);
    
    $genre = $conn->real_escape_string($movie['genre']);
    
    $director= $conn->real_escape_string($movie['director']);
    
    $writer = $conn->real_escape_string($movie['writer']);
    
    $actor = $conn->real_escape_string($movie['star']);
    
    // END REGION 
    
    // If poster_upload is null set $poster to the text input poster
    $poster = $movie["poster_upload"] ?? $movie["poster"];
    
    // If poster_upload is set and isn't empty upload the poster to the server
    if(isset($movie["poster_upload"]) && $movie["poster_upload"] !=""){
        // Poster is uploaded sets the poster
        if(upload_poster()){
            $poster = $movie["poster_upload"];
        }
    }
    else{
        // Check Poster string for SQL injections
        $poster = $conn->real_escape_string($movie["poster"]);
    }
    
    $duration = $movie["duration"];
    $release_date = $movie["release_date"];
    $movieID = $movie["movieID"];
    
    // Command to update movie
    $sql = 'UPDATE movie SET '
            . 'Title="'.$title.'",'
            . 'Description="'.$description.'",'
            . 'TrailerURL="'.$trailer_url.'",'
            . 'Poster="'.$poster.'",'
            . 'AgeRating="'.$age_rating.'",'
            . 'Duration="'.$duration.'",'
            . 'ReleaseDate="'.$release_date.'" '
            . 'WHERE MovieID="'.$movieID.'"; ';

    // split genre to array of genre names
    $genre = explode(' ', $genre);
    // gets genres of current movie
    $movieGenreID = get_specific_movie_genre($movieID);

    // loops through array of genre names
    for($i=0;$i<count($genre);$i++){
        // sets genre_name
        $genre_name=$genre[$i];
        
        // If the genre exists add update command to the SQL string
        // Else insert the genre and add update command to the SQL string
        if(genre_exists($genre_name)==="1"){
            $genreName = get_specific_genre($genre_name);
            
            $sql .= 'UPDATE movie_genre SET '
            . 'GenreID='.$genreName["GenreID"].' '
            . 'WHERE Movie_genreID = '.$movieGenreID[$i].'; ';
        }
        else{
            $sqlGenre = 'INSERT INTO genre(GenreName) VALUES("'.$genre_name.'"); ';
            
            $conn->query($sqlGenre);
            $genreName = get_specific_genre($genre_name);
            
            $sql .= 'UPDATE movie_genre SET '
            . 'GenreID ='.$genreName["GenreID"].' '
            . 'WHERE Movie_genreID = '.$movieGenreID[$i].' OR MovieID ='.$movieID.'; ';
        }
    }
    
    // Makes array of the director names
    $director = explode(', ', $director);
    // gets CrewID for the director of the movie
    $crewID = get_specific_crewID($movieID, 1);
    
    // Loop through the director array
    for($i=0;$i<count($director);$i++){
        // Sets the director name
        $director_name = $director[$i];
        
        // If the director exist add update command to SQL string
        //ELSE add the director to the person table, and add update command to the SQL string
        if(person_exists($director_name)==="1"){
            $personID = get_person_id($director_name);
            $sql .= 'UPDATE crew SET '
                . 'PersonID='.$personID.' '
                . 'WHERE CrewID ='.$crewID[$i].' AND JobID = 1; ';
        }
        else{
            $sqlDirector = 'INSERT INTO person(Name) VALUES("'.$director_name.'"); ';

            $conn->query($sqlDirector);
            $personID = get_person_id($director_name);
            $sql .= 'UPDATE crew SET '
                . 'PersonID='.$personID.' '
                . 'WHERE CrewID ='.$crewID[$i].' AND JobID = 1; ';
        }
    }


    $crewID = get_specific_crewID($movieID, 2);
    // gets CrewID for the writers of the movie
    $writer = explode(', ', $writer);
    // Makes array of the writer 
    
    for($i=0;$i<count($writer);$i++){
        // If the writer exist add update command to SQL string
        //ELSE add the writer to the person table, and add update command to the SQL string
        if(person_exists($writer[$i])==="1"){
            $personID = get_person_id($writer[$i]);
            $sql .= 'UPDATE crew SET '
                . 'PersonID='.$personID.' '
                . 'WHERE CrewID ='.$crewID[$i].' AND JobID = 2; ';
        }
        else{
            $sqlWriter = 'INSERT INTO person(Name) VALUES("'.$writer[$i].'"); ';
            
            $conn->query($sqlWriter);
            $personID = get_person_id($writer[$i]);
            $sql .= 'UPDATE crew SET '
                . 'PersonID='.$personID.' '
                . 'WHERE CrewID ='.$crewID[$i].' AND JobID = 2; ';
        }       
    }

    $crewID = get_specific_crewID($movieID, 3);
    // gets CrewID for the actors of the movie
    $actor = explode(', ', $actor);
    // Makes array of the actor names
    
    for($i=0;$i<count($actor);$i++){
        // If the actor exist add update command to SQL string
        //ELSE add the actor to the person table, and add update command to the SQL string
        if(person_exists($actor[$i])==="1"){
            $personID = get_person_id($actor[$i]);
            $sql .= 'UPDATE crew SET '
                . 'PersonID='.$personID.' '
                . 'WHERE CrewID ='.$crewID[$i].' AND JobID = 3; ';
        }
        else{
            $sqlActor = 'INSERT INTO person(Name) VALUES("'.$actor[$i].'"); ';
            
            $conn->query($sqlActor);
            $personID = get_person_id($actor[$i]);
            $sql .= 'UPDATE crew SET '
                . 'PersonID='.$personID.' '
                . 'WHERE CrewID ='.$crewID[$i].' AND JobID = 3; ';
        }
        
    }
    
    //executes all the queries above and returns the result
    return $conn->multi_query($sql);
}




