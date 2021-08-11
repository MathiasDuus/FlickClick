<?php
include_once 'DAL/create_movie.php';
include_once 'DAL/upload_image.php';
include_once 'DAL/get_movie.php';
include_once 'bin/alert.php';

// Function to create movie
function new_movie(){
    $title = $_POST['Title'];
    $trailer_url = $_POST['TrailerURL'];
    
    // Adds "/embed" before the last / to enble that the browser can play
    $url = $trailer_url;
    $pos =strripos($url, "/");
    $url = substr_replace($url,"/embed",$pos,0);
    //replaces .be with be.com
    $pos =strripos($url, ".be");
    $trailer_url = substr_replace($url,"be.com",$pos,3);

    //Check if movie already exist
    $movie = movie();
    for($i=0;$i<count($movie);$i++){
        $DBTitle = $movie[$i]["title"];
        
        if(strcmp($DBTitle, $title) === 0){
            alert("Movie already exists");
            return;
        }
    }
    
    // uploads the poster and creates the movie
    if (upload_poster()){
       
        $movie = array(
            "title"=>$title,
            "description"=>$_POST['Description'],
            "trailer_url"=>$trailer_url,
            "poster" => $_FILES['uploadPoster']["name"], 
            "age_rating"=>$_POST['AgeRating'],
            "duration"=>$_POST['Duration'],
            "release_date"=>$_POST['ReleaseDate'],
            "genre"=>$_POST['Genre'],
            "director"=>$_POST['Director'],
            "writer"=>$_POST['Writer'],
            "star"=>$_POST['Star']
            );
        create_movie($movie);
    }
    else {
        alert("Sorry could not add movie");
        return;
    }
    
    
}


