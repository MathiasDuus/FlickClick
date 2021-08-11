<?php
// Function to upload profile picture to the server
function upload_profile_pic(){
    $target_dir = "../images/user/";
    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
    $uploadOk = 1;

    // Check if image file is an actual image or fake image
    if(isset($_POST["sign_up"])) {
      $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $_POST["error"] ="Please upload an image file";
        $uploadOk = 0;
        return false;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      $_POST["error"] ="Sorry, file already exists.";
      $uploadOk = 0;
      return false;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_POST["error"] ="Sorry, your file was not uploaded.";
        return false;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
          return true;
      } else {
        $_POST["error"] ="Sorry, there was an error uploading your file.";
        return false;
      }
    }
}

// Function to upload movie poster to the server
function upload_poster(){
    $target_dir = "../images/poster/";
    $target_file = $target_dir . basename($_FILES["uploadPoster"]["name"]);
    $uploadOk = 1;

    // Check if image file is an actual image or fake image
    if(isset($_POST["add_movie"])) {
      $check = getimagesize($_FILES["uploadPoster"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
          alert("Please upload an image file");
        $uploadOk = 0;
      }
    }

    // Check if file already exists, if it exists don't upload but return the name
    if (file_exists($target_file)) {
      $uploadOk = 0;
      return $_FILES["uploadPoster"]["name"];
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        alert("Sorry, your file was not uploaded.");
        return false;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["uploadPoster"]["tmp_name"], $target_file)) {
          return true;
      } else {
        alert("Sorry, there was an error uploading your file.");
        return false;
      }
    }
}