<?php
include_once 'get_connection.php';

// takes personID and returns name of person
function get_specific_person($personID){ 
    $conn = conn();
    $sql = 'SELECT * FROM person WHERE PersonID = '.$personID; 
    $result = $conn->query($sql);
    
    
    $row = $result->fetch_assoc();
    
    return $row['Name'];
}

// Function to get PersonID of specific person
function get_person_id($personName){
    $conn = conn();
    $sql = 'SELECT PersonID FROM person WHERE Name = "'.$personName.'"';  
    $result = $conn->query($sql);
    
    $row = $result->fetch_assoc();
    
    return $row["PersonID"];
}

//Function to check if person exists
function person_exists($personName){
    $conn = conn();
    $sql = 'SELECT EXISTS(SELECT * FROM person WHERE Name = "'.$personName.'")';  
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['EXISTS(SELECT * FROM person WHERE Name = "'.$personName.'")'];
}

