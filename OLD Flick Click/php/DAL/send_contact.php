<?php
include_once 'get_connection.php';

// Function to send the message to the database
function send_contact($name, $email, $message){
    $conn = conn(); 
    
    // Checks the strings for SQL injection
    $name = $conn->real_escape_string($name);    
    $email = $conn->real_escape_string($email);
    $message = $conn->real_escape_string($message);
    
    //Command to add message to the database
    $sql = 'INSERT INTO contact(Name, Email, Message) VALUES ("'.$name.'","'.$email.'","'.$message.'");';
    
    // If the query is executed successfully head back to the contact site (clearing POST)
    if ($conn->query($sql)) {
        header("location: contact.php");
    }
    else{
        return false;
    }
}

