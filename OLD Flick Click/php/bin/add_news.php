<?php include_once 'bin/edit_news.php';?>
<form method="POST" action="">
    <div class="form-group row">
        <label for="inputTitle" class="col-sm-3 col-form-label"><b>Title:</b></label>
        <div class="col-sm">
            <input required maxlength="250" name="Title" type="text" class="form-control" id="inputTitle" >
        </div>
    </div>
    <div class="form-group row">
      <label for="inputDescription" class="col-sm-3 col-form-label"><b>Text:</b></label>
      <div class="col-sm">
          <textarea required name="Text" maxlength="5000" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
      </div>
    </div>
    <button type="submit" name="add_news" value="add" class="btn btn-primary">Add news</button>
</form>