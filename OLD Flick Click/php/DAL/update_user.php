<?php
include_once 'get_connection.php';
include_once 'get_user.php';

// Function to update user
function update_user($user, $pic, $newPassword){
    $conn = conn();
    // REGION
    // Tries to remove forbidden chars, that could have been used to sql injections
    $first_name = $conn->real_escape_string($user["first_name"]);
    
    $last_name = $conn->real_escape_string($user["last_name"]);
    
    $address = $conn->real_escape_string($user["address"]);
    
    $email = $conn->real_escape_string($user["email"]);
    
    // END REGION
    
    // Hashes the password with the default(BCRYPT-26-02-2021)
    $password = password_hash($newPassword, PASSWORD_DEFAULT);
    
    // Gets the ID of the user
    $userID = get_specific_user($user["user_mail"])["UserID"];
    
    // SQL command to update the user
    $sql = 'UPDATE user SET '
            . 'FirstName="'.$first_name.'",'
            . 'LastName="'.$last_name.'",'
            . 'Address="'.$address.'",'
            . 'Email="'.$email.'",'
            . 'Tele='.$user["tele"].'';
    // If the user changes password add the new to the query
    if($newPassword!=""){
        $sql .= ', Password="'.$password.'"';
    }
    // if the user want to change profile pic add the new name to the query after is uploaded
    if($pic!=""){
        if(upload_profile_pic()){
            return false;
        }
        $sql .= ', ProfilePic="'.$pic.'"';
    }
    $sql .= ' WHERE UserID ='.$userID.'; ';

    // Executes the query and returns a bool
    return $conn->query($sql);
}




