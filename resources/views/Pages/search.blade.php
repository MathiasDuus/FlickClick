@extends('Layouts.app')

@section('content')

    <form id="search_form" class="form-inline" method="POST" action="/search">
        @csrf
        <div class="form-group col-md-10 mx-sm-3 mb-2">
            <label for="search_input"></label>
            <input id="search_input" type="search" name="search_movie" class="form-control" placeholder="Search movie...">
        </div>
        <button name="search" type="submit" class="btn btn-primary mb-2">Search</button>
    </form>


    <div id="front" class="row">

        @foreach($search as $movie)
            <div class="col-lg-2 card-margin">
                <div class="card">
                    <img class="card-img card-image" src="../storage/images/poster/{{$movie->poster}}" alt="Movie poster">

                    <div class="card-img-overlay">
                        <a href="movies/{{$movie->movie_id}}">
                            <img alt="Movie Poster Overlay" class="card-image" src="../storage/images/poster-overlay.png">
                        </a>
                        <p id="poster-overlay-title">{{$movie->title}}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
