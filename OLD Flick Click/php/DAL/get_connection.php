<?php

function conn(){
    /*$conn = new mysqli("fdb30.awardspace.net", "3807671_flickclickdb","123QWEasdZXC%_&",
                        "3807671_flickclickdb");*/
    $conn = new mysqli("localhost", "3807671_flickclickdb","123QWEasdZXC%_&",
        "3807671_flickclickdb");
    // makes sure æøå works
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
