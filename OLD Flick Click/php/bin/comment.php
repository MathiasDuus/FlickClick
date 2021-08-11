<?php 
include_once 'DAL/get_comment.php';

$comment = get_all_comment();
// loops through all comments and displays them
for($i=0;$i< count($comment);$i++){
?>
<div id="cms" class="col-lg card-margin">
    <p><b><?php echo $comment[$i]["movie_title"]?></b></p>
    <p><?php echo $comment[$i]["comment_text"]?></p>
    <form method="POST" action="">
        <button type="submit" name="delete_comment" class="btn btn-danger" value="<?php echo $comment[$i]["commentID"]?>">Delete</button>
    </form>
</div>
<?php
}
    
