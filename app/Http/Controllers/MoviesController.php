<?php

namespace App\Http\Controllers;

use App\Models\crew;
use App\Models\genre;
use App\Models\job;
use App\Models\movie_genre;
use App\Models\person;
use App\Models\User;
use Illuminate\Http\Request;
use App\models\movie;
use App\models\comment;
use Carbon\Carbon;

class MoviesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show','latest','commented','coming']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = movie::select('movie_id','title','poster')->get();


        return view('Movie.movieFilter')->with('movies', $movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!User::isAdmin(auth()->user()->access_level)){
            return redirect('/')->with('error','Unauthorized access');
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!User::isAdmin(auth()->user()->access_level)){
            return redirect('/')->with('error','Unauthorized access');
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = movie::where('movie_id','=',$id)->first();

        // gets all genre id's to a specific movie
        $movie_genres = movie_genre::where('movie_id','=',$movie->movie_id)->select('genre_id')->get();

        // counts how many genres
        $genreCount = count($movie_genres);

        // makes array to hold the genre names
        $genres = array();
        if($genreCount>0) {
            // loop to get all genre names
            foreach ($movie_genres as $movie_genre){
                // gets the genre name for the movie and puts it in an array
                array_push($genres,genre::where('genre_id', '=', $movie_genre->genre_id)->first()->genre_name);}
        }
        else{
            // If there is no genres return N/A
            array_push($genres, "N/A");
        }

        // gets all comments on the movie
        $comments = comment::where('movie_id','=',$id)->orderBy('post_date','desc')->get();

        foreach ($comments as $comment){
            $user = User::where('user_id','=',$comment->user_id)->select('first_name','last_name')->first();
            $comment['username']= $user->first_name.' '.$user->last_name;
        }


        //gets the crew(director, actor and writer)
        $movieCrew = crew::where('movie_id','=',$id)->get();

        $crew = array();
        $i = 0;

        //dd($crew);
        foreach ($movieCrew as $person){
            $name = person::where('person_id','=',$person->person_id)->first()->name;
            $position = job::where('job_id','=',$person->job_id)->first()->job;

            switch ($position) {
                case 'Director':
                    $crew['Director'][$i]['name'] = $name;
                    break;
                case 'Writer':
                    $crew['Writer'][$i]['name'] = $name;
                    break;
                case 'Actor':
                    $crew['Actor'][$i]['name'] = $name;
                    break;
            }
            $i++;
        }

        return view('Movie.movie', ["movie" => $movie, "genres" => $genres, "comments" => $comments, "crew" =>$crew]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!User::isAdmin(auth()->user()->access_level)){
            return redirect('/')->with('error','Unauthorized access');
        }
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!User::isAdmin(auth()->user()->access_level)){
            return redirect('/')->with('error','Unauthorized access');
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!User::isAdmin(auth()->user()->access_level)){
            return redirect('/')->with('error','Unauthorized access');
        }
        //
    }

    /**
     * Display a listing of the resource, by newest release date.
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        $toDay = Carbon::today();
        $movies = movie::orderBy('release_date', 'desc')
            ->whereDate('release_date','<=', $toDay)
            ->select('movie_id','title','poster')
        ->get();

        return view('Movie.movieFilter')->with('movies', $movies);
    }

    /**
     * Display a listing of the resource, sorted by most commented.
     *
     * @return \Illuminate\Http\Response
     */
    public function commented()
    {
        $movies = movie::orderBy('release_date', 'desc')->select('movie_id','title','poster')->get();

        foreach ($movies as $movie){
            $comments = comment::where('movie_id', '=', $movie->movie_id)->select('movie_id')->get();
            $movie['comment_count']=count($comments);
        }

        $sortedMovies = $movies->sortByDesc('comment_count');

        return view('Movie.movieFilter')->with('movies', $sortedMovies);
    }

    public function coming()
    {
        $toDay = Carbon::today();
        $movies = movie::orderBy('release_date', 'desc')
            ->whereDate('release_date','>=', $toDay)
            ->select('movie_id','title','poster')
            ->get();

        return view('Movie.movieFilter')->with('movies', $movies);
    }

}
