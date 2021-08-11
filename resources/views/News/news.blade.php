@extends('Layouts.app')

@section('content')


    <div class="col news">
        <h2><b>{!! $news->title !!}</b></h2>
            @if($news->created_at != $news->updated_at)
                <b>Updated:</b> {{ date('d-m-Y',strtotime($news->updated_at)) }}
            @endif
        </p>
        <p class="news_long_cut_text">{!! $news->news_body !!}</p>
        <a href="javascript:history.back()">Back</a>
    </div>

@endsection
