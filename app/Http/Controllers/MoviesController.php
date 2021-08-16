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
use phpDocumentor\Reflection\Types\Collection;

class MoviesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','admin'],['except'=>['index','show','latest','commented','coming']]);
    }

    /**
     * @param int $id
     * @return array
     */
    private function getMovieInfo(int $id):array{
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
        return ["movie" => $movie, "genres" => $genres, "crew" =>$crew];
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
        return view('Movie.create');
    }

    /**
     * @param array $people
     * @param int $movie_id
     * @param int $job_id
     */
    private function crewCreate(array $people, int $movie_id, int $job_id){
        foreach ($people as $person){
            // removes all leading whitespaces
            $person = ltrim($person);

            // makes the name lower case, to eliminate duplicates with different capitalization
            $person = strtolower($person);

            // Capitalises first letter of each word
            $person = ucwords($person);

            $person_id = person::firstOrCreate([
                'name' => $person
            ])['person_id'];


            $crew = new crew;
            $crew->person_id = $person_id;
            $crew->movie_id = $movie_id;
            $crew->job_id = $job_id;
            $crew->save();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required','string'],
            'description' => ['required','string'],
            'trailer_url' => ['required','string'],
            'poster' => ['required','image'],
            'age_rating' => ['required','string'],
            'duration' => ['required','numeric'],
            'release_date' => ['required','date'],
            'genre' => ['required','string'],
            'director' => ['required','string'],
            'writer' => ['required','string'],
            'actor' => ['required','string'],
        ]);

        $trailer_url = $request->input('trailer_url');
        // Adds "/embed" before the last / to enable that the browser can play
        $url = $trailer_url;
        $pos =strripos($url, "/");
        $url = substr_replace($url,"/embed",$pos,0);
        //replaces .be with be.com
        $pos =strripos($url, ".be");
        $trailer_url = substr_replace($url,"be.com",$pos,3);


        if($request->hasFile('poster')){
            // Get filename with the extension
            $filenameWithExt = $request->file('poster')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('poster')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('poster')->storeAs('public/images/poster', $fileNameToStore);
        }else{
            $fileNameToStore = 'lorem_poster'.'_'.time().'.'.'png';
        }

        $movie = new movie;
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->trailer_url = $trailer_url;
        $movie->poster = $fileNameToStore;
        $movie->age_rating = $request->input('age_rating');
        $movie->duration = $request->input('duration');
        $movie->release_date = $request->input('release_date');
        $movie->save();

        $movie_id = movie::where('poster','=',$fileNameToStore)->select('movie_id')->first()->movie_id;


        $genres = $request['genre'];
        $directors = $request['director'];
        $writers = $request['writer'];
        $actors = $request['actor'];


        foreach (explode(',',$genres) as $genre){
            // removes all leading whitespaces
            $genre = ltrim($genre);

            // makes the name lower case, to eliminate duplicates with different capitalization
            $genre = strtolower($genre);

            // Capitalises first letter of each word
            $genre = ucwords($genre);

            $genre_id = genre::firstOrCreate([
                'genre_name' => $genre
            ])['genre_id'];


            $movie_genre = new movie_genre;
            $movie_genre->genre_id = $genre_id;
            $movie_genre->movie_id = $movie_id;
            $movie_genre->save();
        }
        /**
         checks whether the person exist in the db and if they don't -
         Creates them and adds them to the crew table, if they exist add a new entry to crew.
        */
        // director
        $this->crewCreate(explode(',',$directors), $movie_id,1);
        // writer
        $this->crewCreate(explode(',',$writers), $movie_id,2);
        //actor
        $this->crewCreate(explode(',',$actors), $movie_id,3);


        return redirect('/cms/movies')->with('success','movie added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie_info = $this->getMovieInfo($id);
        //dd($movie_info['crew']);
        // gets all comments on the movie
        $comments = comment::where('movie_id','=',$id)->orderBy('post_date','desc')->get();

        foreach ($comments as $comment){
            $user = User::where('user_id','=',$comment->user_id)->select('first_name','last_name')->first();
            $comment['username']= $user->first_name.' '.$user->last_name;
        }

        return view('Movie.movie', ["movie" => $movie_info['movie'], "genres" => $movie_info['genres'], "comments" => $comments, "crew" =>$movie_info['crew']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie_info = $this->getMovieInfo($id);
        return view('movie.edit',["movie" => $movie_info['movie'], "genres" => $movie_info['genres'], "crew" =>$movie_info['crew']]);
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

        $this->validate($request, [
            'title' => ['required','string'],
            'description' => ['required','string'],
            'trailer_url' => ['required','string'],
            'poster' => ['nullable','image'],
            'age_rating' => ['required','string'],
            'duration' => ['required','numeric'],
            'release_date' => ['required','date'],
            'genre' => ['required','string'],
            'director' => ['required','string'],
            'writer' => ['required','string'],
            'actor' => ['required','string'],
        ]);


        //$people = $request['writer'];


        $movie_info = $this->getMovieInfo($id);




        //dd($people == $oldPeople);

        if($movie_info['movie']->trailer_url != $request->input('trailer_url')){
            $trailer_url = $request->input('trailer_url');
            // Adds "/embed" before the last / to enable that the browser can play
            $url = $trailer_url;
            $pos =strripos($url, "/");
            $url = substr_replace($url,"/embed",$pos,0);
            //replaces .be with be.com
            $pos =strripos($url, ".be");
            $trailer_url = substr_replace($url,"be.com",$pos,3);
        }

        $genres = $request['genre'];
        $directors = $request['director'];
        $writers = $request['writer'];
        $actors = $request['actor'];


        $movie = movie::find($id);

        if($request->hasFile('poster')){
            // Get filename with the extension
            $filenameWithExt = $request->file('poster')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('poster')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('poster')->storeAs('public/images/poster', $fileNameToStore);
        }

        $movie->title=$request->input('title');
        $movie->description=$request->input('description');
        if (isset($trailer_url)){
            $movie->trailer_url=$trailer_url;
        }
        if($request->hasFile('poster')){
            $movie->poster = $fileNameToStore;
        }
        $movie->age_rating=$request->input('age_rating');
        $movie->duration=$request->input('duration');
        $movie->release_date=$request->input('release_date');
        $movie->save();


        $genres = explode(',',$genres);

        foreach ($genres as $key => $genre) {
            // removes all leading whitespaces
            $genre = ltrim($genre);

            // makes the name lower case, to eliminate duplicates with different capitalization
            $genre = strtolower($genre);

            // Capitalises first letter of each word
            $genre = ucwords($genre);

            $genres[$key] = $genre;
        }

        sort($genres);
        sort($movie_info['genres']);

        $diff = count($movie_info['genres']) == count($genres);
        if (!$diff) {
            return redirect('/movies/'.$id.'/edit')->with('error', 'Accepts only '.count($movie_info['genres']).' genres');
        }

        if($genres != $movie_info['genres']){
            foreach ($genres as $key => $genre){
                $genre_id = genre::firstOrCreate([
                    'genre_name' => $genre
                ])['genre_id'];

                $oldGenreId=genre::where('genre_name',$movie_info['genres'][$key])->first()['genre_id'];

                movie_genre::updateOrInsert(
                    ['movie_id'=>$id, 'genre_id'=>$oldGenreId],
                    ['genre_id'=>$genre_id]
                );
            }
        }
        /**
        checks whether the person exist in the db and if they don't -
        Creates them and adds them to the crew table, if they exist add a new entry to crew.
         */
        // director
        $this->crewUpdate(explode(',',$directors), $movie_info['crew']['Director'], $id,1);
        // writer
        $this->crewUpdate(explode(',',$writers), $movie_info['crew']['Writer'], $id,2);
        //actor
        $this->crewUpdate(explode(',',$actors), $movie_info['crew']['Actor'], $id,3);


        //dd(auth());
        return redirect('/movies/'.$id)->with('success','Movie Updated');
    }

    /**
     * @param array $people
     * @param array $oldPeople
     * @param int $movie_id
     * @param int $job_id
     */
    private function crewUpdate(array $people, array $oldPeople, int $movie_id, int $job_id){

        foreach ($oldPeople as $key => $old){
            $oldPeople[$key] = $old['name'];
        }

        foreach ($people as $key => $person) {
            // removes all leading whitespaces
            $person = ltrim($person);

            // makes the name lower case, to eliminate duplicates with different capitalization
            $person = strtolower($person);

            // Capitalises first letter of each word
            $person = ucwords($person);

            $people[$key] = $person;
        }

        sort($people);
        sort($oldPeople);

        $diff = count($oldPeople) == count($people);
        if (!$diff) {
            return redirect('/movies/'.$movie_id.'/edit')->with('error', 'Accepts only '.count($oldPeople).' names');
        }

        if($people != $oldPeople){
            foreach ($people as $key => $person){
                $person_id = person::firstOrCreate([
                    'name' => $person
                ])['person_id'];

                $oldPersonId = person::where('name',$oldPeople[$key])->first()['person_id'];

                crew::updateOrInsert(
                    ['movie_id'=>$movie_id, 'person_id'=>$oldPersonId],
                    ['person_id'=>$person_id]
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        /**
         * Crews
         * movie_genre
         * movie
         */
        // Deletes crew related to the movie
        crew::where('movie_id',$id)->delete();

        // deletes movie_genres related to the movie
        movie_genre::where('movie_id',$id)->delete();

        // Deletes the movie
        movie::find($id)->delete();

        return redirect('/movies')->with('success', 'movie deleted');
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
