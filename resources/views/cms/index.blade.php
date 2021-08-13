@extends('Layouts.app')

@section('content')


    <div class="row col">
        <h1>Content Management System</h1>
    </div>
    <div class="row">
        <div class="col-md">
            <a href="/cms/movies" class="btn btn-primary">Movies</a>
        </div>
        <div class="col-md">
            <a href="/cms/news" class="btn btn-primary">News</a>
        </div>
        <div class="col-md">
            <a href="/cms/comments" class="btn btn-primary">Comments</a>
        </div>
        <div class="col-md">
            <a href="/cms/users" class="btn btn-primary">Users</a>
        </div>
        <div class="col-md">
            <a href="/cms/contact_site" class="btn btn-primary">Contact_site</a>
        </div>
    </div>

@endsection
