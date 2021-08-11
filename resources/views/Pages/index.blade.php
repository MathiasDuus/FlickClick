@extends('Layouts.app')

@section('content')
    <div id="front" class="row">

        <div class="frontpage-title row">
            <p> LATEST TRAILERS </p>
            <a href="/movie/latest">See all</a>
        </div>

        @foreach($latest as $movie)
            <div class="col-lg card-margin">
                <div class="card">
                    <img class="card-img card-image" src="../images/poster/{{$movie->poster}}" alt="Movie poster">

                    <div class="card-img-overlay">
                        <a href="movies/{{$movie->movie_id}}">
                            <img alt="Movie Poster Overlay" class="card-image" src="../images/poster-overlay.png">
                        </a>
                        <p id="poster-overlay-title">{{$movie->title}}</p>
                    </div>

                    <div class="img-container">
                        <img class="comment-bubble" src="../images/comment-icon.png" alt="Comment icon"/>
                        <p class="card-title commentCount">{{$movie->comment_count}}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div id="most-commented" class="row">

        <div class="frontpage-title row">
            <p> MOST COMMENTED </p>
            <a href="/movie/commented">See all</a>
        </div>

        @foreach($commented as $movie)

        <div class="col-lg card-margin">
            <div class="card">
                <img class="card-img-top card-image" src="../images/poster/{{$movie->poster}}" alt="Movie poster">
                <div class="card-img-overlay">
                    <a href="movies/{{$movie->movie_id}}">
                        <img alt="Movie Poster Overlay" class="card-image" src="../images/poster-overlay.png">
                    </a>
                    <p id="poster-overlay-title">{{$movie->title}}</p>
                </div>
                <div class="img-container">
                    <img class="comment-bubble" src="../images/comment-icon.png" alt="Comment icon"/>
                    <p class="card-title commentCount">{{$movie->comment_count}}</p>
                </div>
            </div>
        </div>

        @endforeach

    </div>

@endsection
