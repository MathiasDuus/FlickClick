@extends('Layouts.app')

@section('content')

<div id="cms" class="col-lg card_padding">
    <div class="card">

        <form method="POST" action="/movies" enctype="multipart/form-data"> @csrf
            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label"><b>Title:</b></label>
                <div class="col-sm">
                    <input name="title" type="text" class="form-control" id="inputTitle" >
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label"><b>Description:</b></label>
                <div class="col-sm">
                    <textarea name="description" class="form-control form-control" id="editor"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="trailer_url" class="col-sm-3 col-form-label"><b>Trailer URL:
                        <span data-toggle="tooltip" data-placement="top" title="To get URL right-click on the video and select 'copy video URL'">?</span></b></label>
                <div class="col-sm">
                    <input name="trailer_url" type="text" class="form-control" id="inputTrailer">
                </div>
            </div>
            <div class="form-group row">
                <label for="poster" class="col-sm-3 col-form-label"><b>Poster:</b></label>
                <div class="col-sm">
                    <input type="file" name="poster" class="form-control-file" accept="image/*" id="uploadPoster">
                </div>
            </div>
            <div class="form-group row">
                <label for="age_rating" class="col-sm-3 col-form-label"><b>Age rating:</b></label>
                <div class="col-sm">
                    <input name="age_rating" type="text" class="form-control" id="inputAgeRating">
                </div>
            </div>
            <div class="form-group row">
                <label for="duration" class="col-sm-3 col-form-label"><b>Duration(minutes):</b></label>
                <div class="col-sm">
                    <input name="duration" type="number" class="form-control" id="inputDuration">
                </div>
            </div>
            <div class="form-group row">
                <label for="release_date" class="col-sm-3 col-form-label"><b>Release date(YYYY-MM-DD):</b></label>
                <div class="col-sm">
                    <input name="release_date" type="text" class="form-control" id="inputReleaseDate">
                </div>
            </div>
            <div class="form-group row">
                <label for="genre" class="col-sm-3 col-form-label"><b>Genre:</b></label>
                <div class="col-sm">
                    <input name="genre" type="text" class="form-control" id="inputGenre" placeholder="Genre1, Genre2">
                </div>
            </div>
            <div class="form-group row">
                <label for="director" class="col-sm-3 col-form-label"><b>Director:</b></label>
                <div class="col-sm">
                    <input name="director" type="text" class="form-control" id="inputDirector" placeholder="Director1, Director2">
                </div>
            </div>
            <div class="form-group row">
                <label for="writer" class="col-sm-3 col-form-label"><b>Writer:</b></label>
                <div class="col-sm">
                    <input name="writer" type="text" class="form-control" id="inputWriter" placeholder="Writer1, Writer2">
                </div>
            </div>
            <div class="form-group row">
                <label for="actor" class="col-sm-3 col-form-label"><b>Stars:</b></label>
                <div class="col-sm">
                    <input name="actor" type="text" class="form-control" id="inputStars" placeholder="Star1, Star2">
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



@endsection
