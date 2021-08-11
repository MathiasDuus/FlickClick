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
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'profile_image'=>'nullable',
        ]);

        $user = User::find(auth()->user()->id);
        // Handle File Upload
        if($request->hasFile('profile_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('profile_image')->storeAs('public/images/user', $fileNameToStore);

        }
/*
         *CHANGE TO MATCH USER TABLE
        // Update Post
        $user->title = $request->input('title');
        $user->body = $request->input('body');
        if($request->hasFile('profile_image')){
            $user->cover_image = $fileNameToStore;
        }
        $user->save();

*/
        return redirect('/')->with('success','profile updated');
    }

}
