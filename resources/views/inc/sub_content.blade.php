

<div id="news-coming_soon" class="row frontpage-bottom">
    <div class="col-md">
        <div id="frontpage-bottom-header" class="row">
            <p> NEWS</p>
            <a href="/news">See all</a>
        </div>


        @foreach($footerNews as $new)
            <div id="news" class="row">
                <p id="news-date">{{ date('d-m-Y',strtotime($new->created_at))}}
                    @if($new->created_at != $new->updated_at)
                        <b>Updated:</b> {{ date('d-m-Y',strtotime($new->updated_at)) }}
                    @endif
                </p>

                <p id="news-title">{!! $new->title !!}</p>

                <p id="news-text">{!! $new->news_body !!}</p>

                <a id="news-read_more" href="/news/{{$new->news_id}}">Read more</a>


            </div>

        @endforeach

    </div>


    <div id="coming-soon" class="col-md">
        <div id="frontpage-bottom-header" class="row">
            <p> COMING SOON</p>
            <a href="/movie/coming">See all</a>
        </div>

        @foreach($footerMovies as $movie)
            <div class="row">
                <p id="coming-soon-date">{{$movie->release_date}}</p>

                <p id="coming-soon-title">{{$movie->title}}</p>
                <div class="row">
                    <img id="coming-soon-poster" src="../storage/images/poster/{{$movie->poster}}" alt="Movie poster">

                    <div class="col-md">

                        <p id="coming-soon-text">{!! Illuminate\Support\str::limit($movie->description, 130,' ...'); !!}</p>

                        <a id="news-read_more" href="movies/{{$movie->movie_id}}">Read more</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
