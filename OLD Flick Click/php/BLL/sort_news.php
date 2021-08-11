<?php
include_once 'cut_string.php';
include_once 'DAL/get_news.php';    

// Function to cut the news
function cut_news(){
    $row = news();
    
    $cut_news = array();
    
    for($i=0;$i< count($row);$i++){
        
        $cut_news[$i] = array(
            "title" => $row[$i]["title"],
            "text_cut" => limit_text($row[$i]["text"],20),
            "text_long_cut" => limit_text($row[$i]["text"],60),
            "text" => $row[$i]["text"],
            "date" => $row[$i]["date"],
            "newsID" => $row[$i]['newsID']
            );        
    }
    
    return $cut_news;
}

//Function to get specific news
function specific_news($newsID){
    return news_specific($newsID);    
}