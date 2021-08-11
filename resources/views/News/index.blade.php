@extends('Layouts.app')

@section('content')

    @foreach($news as $new)
        <div class="col news">
            <h2><b>{!! $new->title !!}</b></h2>
            <p class="red-text"><b>Written:</b> {{ date('d-m-Y',strtotime($new->created_at))}}
                @if($new->created_at != $new->updated_at)
                    <b>Updated:</b> {{ date('d-m-Y',strtotime($new->updated_at)) }}
                @endif
            </p>
            <p class="news_long_cut_text">{!! $new->news_body !!}</p>
            <a href="/news/{{$new->news_id}}">Read More</a>
        </div>
    @endforeach


@endsection
