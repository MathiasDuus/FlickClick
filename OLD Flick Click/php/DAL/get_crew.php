<?php
include_once 'get_connection.php';
include_once 'get_person.php';

// get all info regarding the director(s) to the movieID
function get_director_name($movieID){
    $conn = conn();
    $sql = 'SELECT * FROM crew WHERE MovieID = '.$movieID.' AND JobID = 1'; 
    $result = $conn->query($sql);
    
    $i = 0;
    $director = array();
    
    while($row = $result->fetch_assoc()){
    
        $director[$i] = get_specific_person($row["PersonID"]);
        $i++;
    }
    return $director;
}

// get all info regarding the writer(s) to the movieID
function get_writer_name($movieID){
    $conn = conn();
    $sql = 'SELECT * FROM crew WHERE MovieID = '.$movieID.' AND JobID = 2'; 
    $result = $conn->query($sql);
    
    $i = 0;
    $writer = array();
    while($row = $result->fetch_assoc()){
    
        $writer[$i] = get_specific_person($row["PersonID"]);
        $i++;
    }
    
    return $writer;
}

// get all info regarding the actor(s) to the movieID
function get_actor_name($movieID){
    $conn = conn();
    $sql = 'SELECT * FROM crew WHERE MovieID = '.$movieID.' AND JobID = 3'; 
    $result = $conn->query($sql);
    
    $i = 0;
    $actor = array();
    while($row = $result->fetch_assoc()){
    
        $actor[$i] = get_specific_person($row["PersonID"]);
        $i++;
    }
    
    return $actor;
}


// returns the creweID where movie id and jobID match
function get_specific_crewID($movieID, $jobID){ 
    $conn = conn();
    $sql = 'SELECT * FROM crew WHERE MovieID = '.$movieID.' AND JobID = '.$jobID; 
    $result = $conn->query($sql);
    
    $i = 0;
    $crew = array();
    
    while($row = $result->fetch_assoc()){
        $crew[$i] = $row['CrewID'];
        $i++;
    }
    
    return $crew;
}

