<?php

// Validates and logs user in
function login(){
    include 'DAL/get_user.php';
    include_once 'bin/alert.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    // the user exists set password
    if (isset( $_POST['email'] ) && isset( $_POST['password'] ) ) {
        $email = $_POST['email'];
        
        $user = get_specific_user($email);
        
        if ($user){
            $DBpassword = $user['Password'];
        }
        else{
            alert("Wrong E-mail or password");
            return;
        }


        // Verify user password and set $_SESSION
        if ( password_verify( $_POST['password'], $DBpassword) ){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_mail'] = $email;
            $_SESSION['access_level'] = $user["AccessLevel"];
        }
        else {
            alert("Wrong E-mail or password");
            return;            
        }
    }

}

