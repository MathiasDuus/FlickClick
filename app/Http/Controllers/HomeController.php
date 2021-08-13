<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function index($id)
    {
        if(auth()->id() != $id)
        {
            return redirect('/')->with('error','Unauthorized access');
        }
        //dd($request);
        $comments = comment::where('user_id', '=', $id)->OrderBy('post_date','desc')->get();
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
        if($request->update_user != auth()->id()){
            return redirect('/')->with('error','Unauthorized access');
        }
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'password' => 'nullable|string|confirmed',
            'profile_image'=>'nullable|image',
        ]);

        $user = User::find($request->update_user);
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


        // Update User
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        if($request->input('password') !== null && strlen($request->input('password'))>=8) {
            $user->password = Hash::make($request->input('password'));
        }
        if($request->hasFile('profile_image')){
            $user->profile_pic = $fileNameToStore;
        }
        $user->save();


        return redirect('/')->with('success','profile updated');
    }

}
