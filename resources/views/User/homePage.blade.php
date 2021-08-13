@extends('layouts.app')

@section('content')
    {{-- Auth::user()->first_name --}}

    <div class="row" id="user_name">
        <h1 class="col">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h1>
    </div>
    <div class="row">
        <div class="col-3">
            <img class="profile_pic" src="../storage/images/user/{{Auth::user()->profile_pic}}" alt="Profile Picture">
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <p><b>E-mail: </b>{{Auth::user()->email}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><b>oprettelsesdato: </b>{{Auth::user()->created_at}}</p>
                </div>
            </div>
        </div>
        <div class="col">

            {{-- If the user is an admin, display the CMS button --}}
            @if (Auth::user()->access_level == 2)
            <a href="/cms" class="btn btn-primary">CMS</a>
            @endif

            @include('user.edit')


        </div>
    </div>
    <div class="col" id="comment_user">
        <h2><b>Comments:</b></h2>
        @if($comments!= null && count($comments) >0)
            @foreach($comments as $comment)
                <div class="row">
                    <h3>{{$comment->movie}} <span class="red-text">{{$comment->post_date}}</span></h3>
                </div>
                <div class="row">
                    <p>{!! nl2br($comment->comment_body) !!}</p>
                </div>
            @endforeach
        @endif

    </div>
@endsection
