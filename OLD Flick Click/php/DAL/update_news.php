<?php
include_once 'get_connection.php';
include_once 'get_news.php';

// Function to update news
function update_news($newsID){
    $conn = conn();
    
    // checks the strings to make sure SQL injection is not tried
    $title = $conn->real_escape_string($_POST["Title"]);
    
    $text = $conn->real_escape_string($_POST["Text"]);
    
    // SQL command to update the news
    $sql = 'UPDATE news SET '
            . 'Title="'.$title.'",'
            . 'Text="'.$text.'",'
            . 'Date="'.date("Y-m-d").'" '
            . 'WHERE NewsID ='.$newsID.'; ';
    

    // Executes the query and returns true if it is a success
    return $conn->query($sql);
}




