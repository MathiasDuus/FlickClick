<?php
include_once 'DAL/update_movie.php';
include_once 'bin/alert.php';

// funnction to edit movie
function edit_movie (){
    
    $trailer_url = $_POST['TrailerURL'];
    
    // Adds "/embed" before the last if none
    $url = $trailer_url;
    if(!strripos($url, "/embed")){
        $pos =strripos($url, "/");
        $url = substr_replace($url,"/embed",$pos,0);
    }
    
    //replaces .be with be.com if none
    $pos =strripos($url, ".be");
    if($pos){
        $trailer_url = substr_replace($url,"be.com",$pos,5);
    }
    
    $movie = array(
            "movieID" => $_POST['MovieID'],
            "title"=>$_POST['Title'],
            "description"=>$_POST['Description'],
            "trailer_url"=>$trailer_url,
            "poster" => $_POST['Poster'],
            "poster_upload" => $_FILES["uploadPoster"]["name"],
            "age_rating"=>$_POST['AgeRating'],
            "duration"=>$_POST['Duration'],
            "release_date"=>$_POST['ReleaseDate'],
            "genre"=>$_POST['Genre'],
            "director"=>$_POST['Director'],
            "writer"=>$_POST['Writer'],
            "star"=>$_POST['Star']
            );
    
    if (update_movie($movie)){
        alert($_POST['Title']." updated successfully");
    }
    else{
        alert("An error occurred");
    }
}



