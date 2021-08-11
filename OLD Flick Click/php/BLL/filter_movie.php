<?php
include_once 'sort_movie.php';

// Function to redirect to other functions according to current filter
function filter_movie($filter){
    $movie = released_movie();
    
    if ($filter == "latest_trailer"){
        $movie = filter_latest_trailer($movie);
    }
    if ($filter == "most_commented"){
        $movie = filter_most_commented($movie);
    }
        if ($filter == "coming_soon"){
        $movie = filter_comming_soon();
    }
        
    
    return $movie;
}

// Sort array so newest first
function filter_latest_trailer($movie){
    
    usort($movie, function ($a, $b) {
    return $b["release_date"] <=> $a["release_date"];
    });
    
    return $movie;
}

// Sort array so most commented first
function filter_most_commented($movie){
    
    usort($movie, function ($a, $b) {
    return $b["comment_count"] <=> $a["comment_count"];
    });
    
    return $movie;
}

// returns movies yet to come out
function filter_comming_soon(){
    return comming_soon();
}
