
<h2>Edit profile</h2>
<form method="POST" action="/edit_user" enctype="multipart/form-data"> @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputFirstName">First name</label>
            <input type="text" name="first_name" class="form-control" id="inputFirstName" required value="{{Auth::user()->first_name}}">
        </div>

        <div class="form-group col-md-6">
            <label for="inputLastName">Last name</label>
            <input type="text" name="last_name" class="form-control" id="inputLastName" required value="{{Auth::user()->last_name}}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" name="email" class="form-control" id="inputEmail" required value="{{Auth::user()->email}}">
    </div>

    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>

        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>

        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"autocomplete="new-password">
    </div>

    <div class="form-group">
        <input type="file" name="profile_pic" class="form-control-file" accept="image/*" id="uploadProfilePicture">
    </div>

    <button type="submit" name="update_user" value="{{Auth::user()->user_id}}" class="btn btn-primary">Update</button>
</form>


