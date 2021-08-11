<?php

include 'DAL/create_user.php';
include 'bin/alert.php';
include 'DAL/upload_image.php';
include 'DAL/get_user.php';

// Function to create a new user
function create_new_user(){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip= $_POST['zip'];
    $email = $_POST['email'];  
    $password = $_POST['password'];     
    $tele = $_POST['tele'];
    

    //Check if email already exist
    $user = get_user();
    for($i=0;$i<count($user);$i++){
        $DBemail = $user[$i]["email"];
        
        if(strcmp($DBemail, $email) === 0){
            $mailMatch = true;
            break;
        }
        else{
            $mailMatch = false;
        }
    }
    // if the mail match a email already existing warn user and return
    if ($mailMatch == true){
        alert("Account already exists");
        return;
    }
     
    // Upload profile picture and creates user
    if (upload_profile_pic()){
        $profile_pic = $_FILES["profile_pic"]["name"];
        
        create_user($first_name, $last_name, $address, $city, $zip, $email, $password, $tele, $profile_pic);
    }
    else {
        alert($_POST["error"]);
        return;
    }
    
    
}


