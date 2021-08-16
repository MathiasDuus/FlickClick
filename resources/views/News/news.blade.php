@extends('Layouts.app')

@section('content')
    @if(Auth::user()->access_level == 2)
        <div class="row card_padding">
            <div class="col-md text-left">

                <a href="{{ route('news.edit', $news)}}" class="btn btn-primary"> Update news</a>
            </div>
            <div class="col-md text-right">
                <form method="POST" action="{{ route('news.destroy', $news)}}" >@csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger"> Delete news</button></form>
            </div>
        </div>
    @endif

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
