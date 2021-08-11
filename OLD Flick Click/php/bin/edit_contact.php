<?php
include_once 'DAL/get_contact.php';
$contact = get_contact_info();
?>
<div class="col-lg card-margin">
    <form id="cms" method="POST" action="">
        <div class="form-group row">
          <label for="inputDescription" class="col-sm-3 col-form-label"><b>Description:</b></label>
          <div class="col-sm">
              <textarea name="Description" maxlength="400" class="form-control" id="inputDescription" rows="5"><?php echo $contact["Description"]?></textarea>
          </div>
        </div>
        <button type="submit" name="update_contact" class="btn btn-info">Update</button>
    </form>
</div>
    
