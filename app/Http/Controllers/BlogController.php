<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        DB::table('articles')->increment('user_views');
        return view('blog', [
            'articles' => Article::latest()->simplePaginate(5)
        ]);
    }

    public function show(Article $article)
    {
        $article->increment('user_views');

        return view('read', [
            'article' => $article
        ]);
    }

}
