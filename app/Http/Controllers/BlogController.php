<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog', [
            'articles' => Article::simplePaginate(5)
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
