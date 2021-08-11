<?php
include_once 'DAL/delete_user.php';

//function to remove user
function remove_user($userID){
    return delete_user($userID);
}

