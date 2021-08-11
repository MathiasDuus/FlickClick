<?php 
include_once 'DAL/get_user.php';

$user = get_user();
 
//Loops through all users
for($i=0;$i< count($user);$i++){
    // if the user is admin skip them
    if($user[$i]["access_level"]==="2"){
        continue;
    }
?>
<div id="cms" class="col-lg card-margin">
    <p><?php echo $user[$i]["first_name"].' '.$user[$i]["last_name"]?></p>
    <form method="POST" action="">
        <button type="submit" name="delete_user" class="btn btn-danger" value="<?php echo $user[$i]["userID"]?>">Delete</button>
    </form>
</div>
<?php
}
    
