<?php
include_once 'get_connection.php';

// Gets all info regarding contact_site
function get_contact_info(){
    $conn = conn();
    
    $sql = 'SELECT * FROM contact_site;';
    
    $result = $conn->query($sql);
    
    if ($result) {
        return $result->fetch_assoc();
    }
    else{
        return false;
    }
}




