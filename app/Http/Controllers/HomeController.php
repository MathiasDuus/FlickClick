<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request )
    {
        //dd($request);
        $comments = comment::where('user_id', '=', $request->profile)->OrderBy('post_date','desc')->get();
        if(count($comments)>0)
        {
            foreach ($comments as $comment){
                $movie = movie::where('movie_id','=',$comment->movie_id)->select('title')->first()->title;
                $comment['movie']=$movie;
            }
        }

        return view('user.homePage')->with('comments', $comments);
    }

    public function edit(Request $request)
    {


        return view('user.home');
    }

}
