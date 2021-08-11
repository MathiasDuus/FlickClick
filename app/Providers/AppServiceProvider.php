<?php

namespace App\Providers;

use App\Models\movie;
use App\Models\news;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $toDay = Carbon::today();
        $footerMovies = movie::orderBy('release_date', 'desc')->whereDate('release_date','>=', $toDay)->paginate(2);

        $footerNews = news::orderBy('updated_at', 'desc')->paginate(3);


        foreach ($footerNews as $new){
            $textShortCut = str::limit($new->news_body, 130,' ...');
            $new['news_body']=$textShortCut;
        }

        View::share(["footerNews" => $footerNews, "footerMovies"=>$footerMovies]);
    }
}
