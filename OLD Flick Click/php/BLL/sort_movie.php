<?php
include_once 'DAL/get_movie.php';  

// Function to get all released movies
function released_movie(){
    $row = movie();
    
    $released_movie = array();
    $index=0;
    
    for($i=0;$i< count($row);$i++){
        
        // if the release date is today or before today skip it
        if($row[$i]["release_date"]>=date("Y-m-d")){
            continue;
        }
        
        $released_movie[$index] = array(
            "movieID" => $row[$i]["movieID"],
            "title"=>$row[$i]["title"],
            "description"=>$row[$i]["description"],
            "trailer_url"=>$row[$i]["trailer_url"],
            "poster" => $row[$i]["poster_path"], 
            "age_rating"=>$row[$i]["age_rating"],
            "duration"=>$row[$i]["duration"],
            "release_date"=>$row[$i]["release_date"],
            "comment_count" =>$row[$i]["comment_count"],
            );
        
        $index++;
        
    }
    
    return $released_movie;
    
}

// Function to get movie yet to come out
function coming_soon(){
    include_once 'cut_string.php';
    $row = movie();
    
    $coming_movie = array();
    $index=0;
    
    for($i=0;$i< count($row);$i++){
        
        // If the release date is not before today add it to the array
        if($row[$i]["release_date"]>date("Y-m-d")){
            
            $coming_movie[$index] = array(
                "movieID" => $row[$i]["movieID"],
                "title" => $row[$i]["title"],
                "description" => $row[$i]["description"],
                "description_cut" =>  limit_text($row[$i]["description"],20),
                "trailer_url" => $row[$i]["trailer_url"],
                "poster"  => $row[$i]["poster_path"], 
                "age_rating" => $row[$i]["age_rating"],
                "duration" => $row[$i]["duration"],
                "release_date" => $row[$i]["release_date"],
                "comment_count" => $row[$i]["comment_count"],
                );        
            $index++;
        }
    }
    
    // Sorts the array so the closes one to release is first
    usort($coming_movie, function ($a, $b) {
        return $a["release_date"] <=> $b["release_date"];
    });
    
    return $coming_movie;
}

// gets all info of movie
function all_movie(){
    $row = movie();
    
    $all_movie = array();
    
    for($i=0;$i< count($row);$i++){
        
        $all_movie[$i] = array(
            "movieID" => $row[$i]["movieID"],
            "title"=>$row[$i]["title"],
            "description"=>$row[$i]["description"],
            "trailer_url"=>$row[$i]["trailer_url"],
            "poster" => $row[$i]["poster"], 
            "poster_path" => $row[$i]["poster_path"], 
            "age_rating"=>$row[$i]["age_rating"],
            "duration"=>$row[$i]["duration"],
            "release_date"=>$row[$i]["release_date"],
            "comment_count" =>$row[$i]["comment_count"],
            );        
    }
    
    return $all_movie;
}

// Get details of a specific movie
function movie_details($movieID){
    include_once 'DAL/get_crew.php';
    include_once 'DAL/get_genre.php';
    
    $movie = get_specific_movie($movieID);
    
    //Formats the duration to match screenshot
    $movie["duration"] = convertToHoursMins($movie["duration"]);
    
    //Formats the date to match screenshot
    $date=date_create($movie["release_date"]);
    $movie["release_date"] = date_format($date, "d F Y");
    
    $director = get_director_name($movieID);
    $writer = get_writer_name($movieID);
    $actor = get_actor_name($movieID);
    $genre = get_specific_movie_genre_name($movieID);
    
    return array($movie, $director, $writer, $actor, $genre);
}

// function to convert minutes to 0h 00 m
function convertToHoursMins($time, $format = '%2dh %02dm') {
    if ($time < 1) {
        return "N/A";
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}