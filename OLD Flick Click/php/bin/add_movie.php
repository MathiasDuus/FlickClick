<div class="container">
    <div id="cms" class="col-lg card-margin">
        <div class="card">
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group row">
                  <label for="inputTitle" class="col-sm-3 col-form-label"><b>Title:</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" name="Title" type="text" class="form-control" id="inputTitle" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputDescription" class="col-sm-3 col-form-label"><b>Description:</b></label>
                  <div class="col-sm">
                      <textarea required name="Description" maxlength="2000" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputTrailer" class="col-sm-3 col-form-label"><b>Trailer URL:
                            <span data-toggle="tooltip" data-placement="top" title="To get URL right-click on the video and select 'copy video URL'">?</span></b></label>
                  <div class="col-sm">
                      <input required maxlength="250" name="TrailerURL" type="text" class="form-control" id="inputTrailer">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPoster" class="col-sm-3 col-form-label"><b>Poster:</b></label>
                  <div class="col-sm">
                      <input required type="file" name="uploadPoster" class="form-control-file" accept="image/*" id="uploadPoster">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputAgeRating" class="col-sm-3 col-form-label"><b>Age rating:</b></label>
                  <div class="col-sm">
                      <input required maxlength="25" name="AgeRating" type="text" class="form-control" id="inputAgeRating">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputDuration" class="col-sm-3 col-form-label"><b>Duration(minutes):</b></label>
                  <div class="col-sm">
                      <input required min="0" max="999" maxlength="4" name="Duration" type="number" class="form-control" id="inputDuration">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputReleaseDate" class="col-sm-3 col-form-label"><b>Release date(YYYY-MM-DD):</b></label>
                  <div class="col-sm">
                      <input required maxlength="10" name="ReleaseDate" type="text" class="form-control" id="inputReleaseDate">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputGenre" class="col-sm-3 col-form-label"><b>Genre (seperate with a space):</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" name="Genre" type="text" class="form-control" id="inputGenre" placeholder="Genre1 Genre2">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputDiretor" class="col-sm-3 col-form-label"><b>Director:</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" title="Seperate with space" name="Director" type="text" class="form-control" id="inputDiretor" placeholder="Director1, Diretor2">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputWriter" class="col-sm-3 col-form-label"><b>Writer:</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" title="Seperate with space" name="Writer" type="text" class="form-control" id="inputWriter" placeholder="Writer1, Writer2">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputStars" class="col-sm-3 col-form-label"><b>Stars:</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" title="Seperate with space" name="Star" type="text" class="form-control" id="inputStars" placeholder="Star1, Star2">
                  </div>
                </div>               


                
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button id="cms_button" type="submit" name="add_movie" class="btn btn-success">Add</button>
                  </div>
                </div>
              </form>

        </div>
    </div>
</div>
