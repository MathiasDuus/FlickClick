

<form method="POST" action="/edit_user" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputFirstName">First name</label>
            <input maxlength="20" type="text" name="first_name" class="form-control" id="inputFirstName" value="{{Auth::user()->first_name}}">
        </div>

        <div class="form-group col-md-6">
            <label for="inputLastName">Last name</label>
            <input maxlength="50" type="text" name="last_name" class="form-control" id="inputLastName" value="{{Auth::user()->last_name}}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input maxlength="75" type="email" name="email" class="form-control" id="inputEmail" value="{{Auth::user()->email}}">
    </div>

    <div class="form-group">
        <input type="password" name="password" class="form-control" id="inputPassword">
    </div>

    <div class="form-group">
        <input type="file" name="profile_pic" class="form-control-file" accept="image/*" id="uploadProfilePicture">
    </div>

    <button type="submit" name="update_user" value="{{Auth::user()->user_id}}" class="btn btn-primary">Update</button>
</form>
