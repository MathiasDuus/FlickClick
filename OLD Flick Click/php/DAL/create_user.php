<?php
include 'get_connection.php';

// Function to create user
function create_user($first_name, $last_name, $address, $city, $zip, $email, $password, $tele, $profile_pic){
    $conn = conn(); 
    
    $first_name = $conn->real_escape_string($first_name);
    
    $last_name = $conn->real_escape_string($last_name);
    
    $address = $conn->real_escape_string($address);
    
    $city = $conn->real_escape_string($city);
    
    $email = $conn->real_escape_string($email);
    
    // Hashes the password with default (BCRYPT 26-02-2021)
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // Makes the address string match db format
    $address = "{$address}, {$city}, {$zip}";
    
    $date = date("Y-m-d");
    
    $sql = 'INSERT INTO user(FirstName, LastName, Address, Email, Password, Tele, Date, ProfilePic) VALUES ("'.$first_name.'","'.$last_name.'","'.$address.'","'.$email.'","'.$password.'",,"'.$tele.'","'.$profile_pic.'")';
    
    if ($conn->query($sql) === TRUE) {
        alert("User created");
    }
    else{
        alert("An error occurred user not created");
    }
    
}


