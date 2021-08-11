<?php

include_once 'BLL/sort_movie.php';
include_once 'DAL/get_genre.php';
include_once 'DAL/get_crew.php';
$movie = all_movie();

for($i=0;$i< count($movie);$i++){
    // resets strings
    $genreName = '';
    $directorName = '';
    $writerName = '';
    $actorName = '';
    
    // sets movieID
    $movieID = $movie[$i]["movieID"];
    
    // gets all genres names of a specific movie
    $genre = get_specific_movie_genre_name($movieID);
    // the following 3 gets all directors, writers and actors relevant to the current $movieID
    $director = get_director_name($movieID);
    $writer = get_writer_name($movieID);
    $actor = get_actor_name($movieID);
    
    // the next 4 for loops makes the strings ready to be displayed in the form
    for($j=0;$j< count($genre);$j++){
        if($j>0){
            $genreName .=' ';
        }
        $genreName .= $genre[$j];
    }
    
    for($j=0;$j< count($director);$j++){
        if($j>0){
            $directorName .=', ';
        }
        $directorName .= $director[$j];
    }
    
    for($j=0;$j< count($writer);$j++){
        if($j>0){
            $writerName .=', ';
        }
        $writerName .= $writer[$j];
    }
    
    for($j=0;$j< count($actor);$j++){
        if($j>0){
            $actorName .=', ';
        }
        $actorName .= $actor[$j];
    }
    // Form to display the movie info
?>
    <div id="cms" class="col-lg card-margin">
        <div class="card">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group row">
                  <label for="inputMovieID" class="col-sm-3 col-form-label"><b>Movie ID:</b></label>
                  <div class="col-sm">
                      <input min="0" max="999999" name="MovieID" type="number" class="form-control" id="inputMovieID" value="<?php echo $movieID; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputTitle" class="col-sm-3 col-form-label"><b>Title:</b></label>
                  <div class="col-sm">
                      <input maxlength="150" name="Title" type="text" class="form-control" id="inputTitle" value="<?php echo $movie[$i]["title"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputDescription" class="col-sm-3 col-form-label"><b>Description:</b></label>
                  <div class="col-sm">
                      <textarea maxlength="2000" name="Description" class="form-control" id="inputDescription" rows="5"><?php echo $movie[$i]["description"]; ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputTrailer" class="col-sm-3 col-form-label"><b>Trailer URL:</b></label>
                  <div class="col-sm">
                      <input maxlength="250" name="TrailerURL" type="text" class="form-control" id="inputTrailer" value="<?php echo $movie[$i]["trailer_url"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPoster" class="col-sm-3 col-form-label"><b>Poster:</b></label>
                  <div class="col-sm">
                      <input maxlength="150" name="Poster" type="text" class="form-control" id="inputPoster" value="<?php echo $movie[$i]["poster"]; ?>">
                  </div>
                  <label for="inputUploadPoster" class="col-form-label"><b>OR</b></label>
                  <div class="col-sm">
                      <input type="file" name="uploadPoster" class="form-control-file" accept="image/*" id="uploadPoster">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputAgeRating" class="col-sm-3 col-form-label"><b>Age rating:</b></label>
                  <div class="col-sm">
                      <input maxlength="25" name="AgeRating" type="text" class="form-control" id="inputAgeRating" value="<?php echo $movie[$i]["age_rating"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputDuration" class="col-sm-3 col-form-label"><b>Duration(minutes):</b></label>
                  <div class="col-sm">
                      <input min="0" max="999" name="Duration" type="number" class="form-control" id="inputDuration" value="<?php echo $movie[$i]["duration"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputReleaseDate" class="col-sm-3 col-form-label"><b>Release date(YYYY-MM-DD):</b></label>
                  <div class="col-sm">
                      <input name="ReleaseDate" type="text" class="form-control" id="inputReleaseDate" value="<?php echo $movie[$i]["release_date"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputGenre" class="col-sm-3 col-form-label"><b>Genre (separate with a space):</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" name="Genre" type="text" class="form-control" id="inputGenre" value="<?php echo $genreName; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputDirector" class="col-sm-3 col-form-label"><b>Director:</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" title="Separate with space" name="Director" type="text" class="form-control" id="inputDirector" value="<?php echo $directorName; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputWriter" class="col-sm-3 col-form-label"><b>Writer:</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" title="Separate with space" name="Writer" type="text" class="form-control" id="inputWriter" value="<?php echo $writerName; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputStars" class="col-sm-3 col-form-label"><b>Stars:</b></label>
                  <div class="col-sm">
                      <input required maxlength="150" title="Separate with space" name="Star" type="text" class="form-control" id="inputStars" value="<?php echo $actorName; ?>">
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <div class="form-check">
                        <input name="delete" class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        Delete movie
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button id="cms_button" type="submit" name="edit" value="<?php echo $movieID; ?>" class="btn btn-primary">Edit</button>
                  </div>
                </div>
            </form>
            
        </div>
    </div>    
<?php
}
                