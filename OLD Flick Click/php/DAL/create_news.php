<?php
include_once 'get_connection.php';

// Function to create news
function create_news(){
    $conn = conn(); 
    
    $title = $conn->real_escape_string($_POST["Title"]);    
    $text = $conn->real_escape_string($_POST["Text"]);
    $date = date("Y-m-d");
    
    $sql = 'INSERT INTO news(Title, Text, Date) VALUES ("'.$title.'","'.$text.'","'.$date.'");';
    
    if ($conn->query($sql)) {
        header("location: cms.php");
    }
    else{
        return false;
    }
}

