<?php
include_once 'get_connection.php';
include_once 'get_person.php';

// Function to create person
function insert_person($crewName){
    $conn = conn();
    
    //Prepared SQL command
    $sqlCrew = $conn->prepare("INSERT INTO person SET Name = ?");
    $sqlCrew->bind_param("s", $name);
    
    // if the person does not exist create it
    if(person_exists($crewName)==="0"){
        $name = $crewName;
        $sqlCrew->execute();
    }

}
