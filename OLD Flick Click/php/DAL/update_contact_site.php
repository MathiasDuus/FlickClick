<?php
include_once 'get_connection.php';

// Function to update the contact sites description
function update_contact_site($description){
    $conn = conn();
    
    // Check the string for SQL injection
    $description = $conn->real_escape_string($description);
    
    $sql = 'UPDATE contact_site SET '
            . 'Description ="'.$description.'" '
            . 'WHERE Contact_siteID = 1; ';
    
    // executes SQL and returns the result
    return $conn->query($sql);
}

