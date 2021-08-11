<?php 
include_once 'bin/edit_news.php';
include_once 'BLL/sort_news.php';

$news = cut_news();
// loops through all news
    for($i=0;$i< count($news);$i++){
    ?>
    <div class="col-lg card-margin">
        <form id="cms" method="POST" action="">
            <div class="form-group row">
                <label for="inputTitle" class="col-sm-3 col-form-label"><b>Title:</b></label>
                <div class="col-sm">
                    <input maxlength="250" name="Title" type="text" class="form-control" id="inputTitle" value="<?php echo $news[$i]["title"]?>">
                </div>
            </div>
            <div class="form-group row">
              <label for="inputDescription" class="col-sm-3 col-form-label"><b>Text:</b></label>
              <div class="col-sm">
                  <textarea name="Text" maxlength="5000" class="form-control" id="inputDescription" rows="10"><?php echo $news[$i]["text"]?></textarea>
              </div>
            </div>
            <button type="submit" name="news_delete" class="btn btn-danger" value="<?php echo $news[$i]["newsID"]?>">Delete</button>
        </form>
    </div>
    <?php
    }
    
