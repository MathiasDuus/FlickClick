@extends('Layouts.app')

@section('content')
    <form method="POST" action="{{route('news.store')}}">@csrf
        <div class="form-group row">
            <label for="inputTitle" class="col-sm-3 col-form-label"><b>Title:</b></label>
            <div class="col-sm">
                <input name="title" type="text" class="form-control" id="inputTitle" >
            </div>
        </div>
        <div class="form-group row">
            <label for="deck" class="col-sm-3 col-form-label"><b>Deck:</b></label>
            <div class="col-sm">
                <textarea name="deck" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="news_body" class="col-sm-3 col-form-label"><b>Body:</b></label>
            <div class="col-sm">
                <textarea name="news_body" class="form-control" id="editor"></textarea>
            </div>
        </div>
        <button type="submit" value="add" class="btn btn-primary">Add news</button>
    </form>


@endsection
