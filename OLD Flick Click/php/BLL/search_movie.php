<?php
include_once 'DAL/get_movie.php';

// returns array of movies
function search_movie($movieTitle){
    $row = movie_search($movieTitle);
    
    $search_movie = array();
    
    for($i=0;$i< count($row);$i++){
        
        $search_movie[$i] = array(
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
    }
    
    return $search_movie;
}