@extends('Layouts.app')

@section('content')
    @if(Auth::user()->access_level == 2)
        <div class="row card_padding">
            <div class="col-md text-left">
                <a href="news/create" class="btn btn-success"> New News</a>
            </div>
        </div>
    @endif
    @foreach($news as $new)
        <div class="col news">
            <h2><b>{!! $new->title !!}</b></h2>
            <p class="red-text"><b>Written:</b> {{ date('d-m-Y',strtotime($new->created_at))}}
                @if($new->created_at != $new->updated_at)
                    <b>Updated:</b> {{ date('d-m-Y',strtotime($new->updated_at)) }}
                @endif
            </p>
            <div class="news_long_cut_text">
                <p>{!! $new->deck.' ...' !!} </p>
            </div>
            <a href="/news/{{$new->news_id}}">Read More</a>
        </div>
    @endforeach


@endsection
