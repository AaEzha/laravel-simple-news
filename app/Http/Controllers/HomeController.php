<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
    public function index()
    {
        $titles = "";
        $user_views = "";
        $articles = Article::latest()->get();
        foreach($articles as $article) {
            $titles .= "\"";
            $titles .= $article->title . ',';
            $titles .= "\"";
            $titles .= ",";
            $user_views .= $article->user_views . ",";
        }

        $titles = rtrim($titles, ",");
        $user_views = rtrim($user_views, ",");
        // dd($titles);
        return view('home', [
            'articles' => Article::all(),
            'users' => User::count(),
            'total_article' => Article::count(),
            'total_category' => Category::count(),
            'total_view' => Article::sum('user_views'),
            'titles' => $titles,
            'user_views' => $user_views
        ]);
    }

    public function titles()
    {
        return Article::latest()->pluck('title')->toArray();
    }

    public function user_views()
    {
        return Article::latest()->pluck('user_views')->toArray();
    }
}
