<?php

namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class newsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin'],['except'=>['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = news::orderBy('updated_at', 'desc')->get();

        return view('News.index')->with('news', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('News.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'deck' => 'required|string|min:3|max:255',
            'news_body' => 'required|string',
        ]);

        $news = new news;
        $news->title = $request->input('title');
        $news->news_body = $request->input('news_body');
        $news->deck = $request->input('deck');
        $news->save();

        return redirect('/news')->with('success','News created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = news::where('news_id','=', $id)->first();

        return view('News.news')->with('news', $news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = news::where('news_id','=', $id)->first();

        return view('News.edit')->with('news', $news);
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
            'title' => 'required|string',
            'deck' => 'required|string|min:3|max:255',
            'news_body' => 'required|string',
        ]);

        $news = news::find($id);
        $news->title = $request->input('title');
        $news->news_body = $request->input('news_body');
        $news->deck = $request->input('deck');
        $news->save();

        return redirect('/news/'.$id)->with('success','news updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        news::find($id)->delete();
        return redirect('/news')->with('success','news deleted');
    }
}
