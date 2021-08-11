<?php
include_once 'get_connection.php';

// Gets all news
function news(){
    $conn = conn();
    $sql = 'SELECT * FROM news'; 
    $result = $conn->query($sql);

    $news = array();
    
    $index = 0;
    
    // Loop to populate array of news
    while ($row = $result->fetch_assoc()){
        
        $news[$index] = array(
            "title" => $row["Title"],
            "text" => $row["Text"],
            "date" => $row["Date"],
            "newsID" => $row['NewsID']);
        
        $index++;
    }
    
    return $news;
}

// Gets specific news
function news_specific($newsID){
    $conn = conn();
    $sql = 'SELECT * FROM news WHERE NewsID = '.$newsID; 
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    
    return $row;
}
