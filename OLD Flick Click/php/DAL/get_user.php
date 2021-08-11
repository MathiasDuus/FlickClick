<?php
include_once 'get_connection.php';

// Function to get all user info
function get_user(){
    $conn = conn();
    $sql = 'SELECT * FROM user'; 
    $result = $conn->query($sql);

    $user = array();
    
    $index = 0;
    
    // loop to populate an array of users
    while ($row = $result->fetch_assoc()){
        
        // array to contain all info regarding users
        $user[$index] = array(
            "userID" => $row["UserID"],
            "first_name" => $row["FirstName"],
            "last_name" => $row["LastName"],
            "address" => $row["Address"],
            "email" => $row["Email"],
            "password" => $row["Password"],
            "tele" => $row["Tele"],
            "date" => $row["Date"],
            "profile_pic" => $row["ProfilePic"],
            "access_level" => $row["AccessLevel"]);
        
        $index++;
    }
    
    //returns the array
    return $user;
}

// function to get a specific user
function get_specific_user($email){
    $conn = conn();
    $email = $conn->real_escape_string($email);
    $sql = 'SELECT * FROM user WHERE Email = "'.$email.'"';
    $result = $conn->query($sql);
    
    // if the SQL was success return array
    if($result){
        return $result->fetch_assoc();
    }
    else{
        return false;
    }
}