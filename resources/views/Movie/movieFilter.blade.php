@extends('Layouts.app')

@section('content')
    @auth
        @if(Auth::user()->access_level == 2)
            <div class="row card_padding">
                <div class="col-md text-left">
                    <a href="/movies/create" class="btn btn-primary"> New movie</a>
                </div>
            </div>
        @endif
    @endauth
    <div id="front" class="row">
        @foreach($movies as $movie)
            <div class="col-lg-2 card-margin">
                <div class="card">
                    <img class="card-img card-image" src="../storage/images/poster/{{$movie->poster}}" alt="Movie poster">

                    <div class="card-img-overlay">
                        <a href="/movies/{{$movie->movie_id}}">
                            <img alt="Movie Poster Overlay" class="card-image" src="../storage/images/poster-overlay.png">
                        </a>
                        <p id="poster-overlay-title">{{$movie->title}}</p>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection
