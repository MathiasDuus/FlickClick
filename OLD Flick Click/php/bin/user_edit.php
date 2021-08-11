    <form method="POST" action="" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputFirstName">First name</label>
        <input maxlength="20" type="text" name="first_name" class="form-control" id="inputFirstName" value="<?php echo $user["FirstName"]; ?>">
      </div>

      <div class="form-group col-md-6">
        <label for="inputLastName">Last name</label>
        <input maxlength="50" type="text" name="last_name" class="form-control" id="inputLastName" value="<?php echo $user["LastName"]; ?>">
      </div>
    </div>

    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input maxlength="75" type="email" name="email" class="form-control" id="inputEmail" value="<?php echo $user["Email"]; ?>">
    </div>

    <div>
        <input name="change_password" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          Change password
        </label>
    </div>

    <div class="form-group">
      <input maxlength="150"
             title="Password must be at least 8 characters long and must contain at least one lower case letter, one upper case letter, a number and a special character"
             pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
             type="password" name="password" class="form-control" id="inputPassword">
    </div>

    <div class="form-group">
      <label for="inputAddress">Address</label>
      <input maxlength="340" type="text" name="address" class="form-control" id="inputAddress" value="<?php echo $user["Address"]; ?>">
    </div>

    <div class="form-group">
      <label for="inputTelephonenumber">Telephone number</label>
      <input type="number" min="0" max="99999999" name="tele" class="form-control" id="inputTelephonenumber" value="<?php echo $user["Tele"]; ?>">
    </div>


    <div>
        <input name="updatePic" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          Update profile picture
        </label>
    </div>
    <div class="form-group">
      <input type="file" name="profile_pic" class="form-control-file" accept="image/*" id="uploadProfilePicture">
    </div>

    <button type="submit" name="update_user" value="<?php echo $_SESSION["user_mail"]; ?>" class="btn btn-primary">Update</button>
  </form>
