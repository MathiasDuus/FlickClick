@extends('Layouts.app')

@section('content')
    @if($movie)
        <div id="top_movie" class="row">
            <div class="col-md">
                <h1><b>{{ $movie->title }}</b></h1>
            </div>
            <div class="col-md">
                <p class="float-right">Comments: {{ $commentCount = count($comments)}}</p>
            </div>
        </div>
        <div id="top_info_movie" class="row">
            <div class="col-md">
                <P><b>Age Rating: </b><b class="red-text">{{$movie->age_rating}}</b></P>
            </div>
            <div class="col-md">
                <P><b>Duration: </b><b class="red-text">{{$movie->duration}}</b></P>
            </div>
            <div class="col-md">
                <P><b>Genres: </b><b class="red-text">

                    @foreach ($genres as $genre)
                            {{$genre}}
                        @if($genre != $genres[+1])
                            {{', '}}
                        @endif
                    @endforeach

                    </b></P>
            </div>

            <div class="col-md">
                <P class="float-right"><b>Release Date: </b><b class="red-text">{{date('d-m-Y',strtotime($movie->release_date))}}</b></P>
            </div>
        </div>
        <div id="poster_trailer" class="row">
            <div class="col-md-3">
                <img id="poster_movie" src="../images/poster/{{$movie->poster}}" alt="Movie poster">
            </div>
            <div class="col-md">
                <iframe id="trailer_movie" type="text/html"
                        src="{{$movie->trailer_url}}">
                </iframe>
            </div>
        </div>

        <div id="button_info_movie" class="row">
            <div class="col-md">
                <P><b>Director: </b><b class="red-text">
                        @if(count($crew['Director'])>0)
                            @foreach($crew['Director'] as $director)
                                {{ $director['name'] }}
                            @endforeach
                        @endif
                    </b></P>
            </div>
            <div class="col-md">
                <P><b>Writers: </b><b class="red-text">
                        @if(count($crew['Writer'])>0)
                            @foreach($crew['Writer'] as $writer)
                                {{ $writer['name'] }}
                            @endforeach
                        @endif
                    </b></P>
            </div>
            <div class="col-md">
                <P><b>Stars: </b><b class="red-text">
                        @if(count($crew['Actor'])>0)
                            @foreach($crew['Actor'] as $actor)
                                {{ $actor['name'] }}
                            @endforeach
                        @endif
                    </b></P>
            </div>
        </div>
        <div id="description_title_movie" class="row">
            <h2><b>Description</b></h2>
        </div>
        <div id="description_movie" class="row">
            <p>{!! $movie->description !!}</p>
        </div>
        <div id="description_comment_count" class="row">
            <p>Comments: {{$commentCount}}</p>
        </div>

        @auth
            <div id="comment_title_movie" class="row">
                <h3><b>Post a comment</b></h3>
            </div>
            <div id="post_comment_movie" class="row">

                <form id="comment_form" method="POST" action="/comment"> @csrf
                    <div class="form-group row">
                        <label for="comment_body"></label>
                        <textarea name="comment_body" class="form-control" id="editor" placeholder="Write your comment here..."></textarea>
                    </div>
                    <div class="form-group row">
                        <button id="cms_button" type="submit" name="post_comment" value="{{$movie->movie_id}}" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        @else
            <div class="row">
                <h3><b>To post a comment you must be logged in</b></h3>
            </div>
        @endauth


        @foreach ($comments as $comment)
        <div id="comment_title" class="row">
            <p>{{$comment->username}} <span class="red-text">{{date('d-m-Y',strtotime($comment->post_date))}}</span></p>

        </div>
        <div class="row">
            <p>{!! nl2br($comment->comment_body) !!} </p>
        </div>
        @endforeach
@endif

@endsection
