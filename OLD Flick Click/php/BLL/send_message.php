<?php
include_once 'DAL/send_contact.php';

// function to send message
function send_message(){
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $message= $_POST["Message"];
    return send_contact($name, $email, $message);
}

