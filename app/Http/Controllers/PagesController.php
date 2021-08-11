<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use App\Models\contact;
use App\Models\news;
use Carbon\Carbon;
use App\models\movie;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index(){
        $toDay = Carbon::today();
        $latest = movie::orderBy('release_date', 'desc')->whereDate('release_date','<=', $toDay)->select('movie_id','title','poster')->paginate(6);

        foreach ($latest as $movie){
            $comments = comment::where('movie_id', '=', $movie->movie_id)->select('movie_id')->get();
            $movie['comment_count']=count($comments);
        }

        $movies = movie::select('movie_id','title','poster')->get();
        foreach ($movies as $movie){
            $comments = comment::where('movie_id', '=', $movie->movie_id)->select('movie_id')->get();
            $movie['comment_count']=count($comments);
        }

        $sortedMovies = $movies->sortByDesc('comment_count')->slice(0,6);

        return view('Pages.index', ["latest" => $latest, "commented" => $sortedMovies]);
    }

    public function news(){
        $news = news::orderBy('updated_at', 'desc')->get();

        foreach ($news as $new){
            $textLongCut = str::limit($new->news_body, 400,' ...');
            $new['news_body']=$textLongCut;
        }
        //dd($news);
        return view('News.index')->with('news', $news);
    }

    public function showNews($id){
        // return a view to show specific news article
        $news = news::where('news_id','=', $id)->first();

        //dd($news);
        return view('News.news')->with('news', $news);
    }

    public function search(Request $item){

        $search = movie::where('title','LIKE','%'.$item->search_movie.'%')->select('movie_id','title','poster')->get();

        return view('Pages.search')->with('search', $search);
    }
}
