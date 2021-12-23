<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('article.index', [
            'title' => 'Articles',
            'articles' => Article::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create', [
            'title' => 'New Article',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $slug = Str::slug($request->title);

        $thumbnail = time() . "-" . $request->file('thumbnail')->getClientOriginalName();
        $request->file('thumbnail')->storeAs('public', $thumbnail);

        Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'thumbnail' => $thumbnail,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('article.index')->with('message', 'Article added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit', [
            'title' => 'Edit Article',
            'categories' => Category::all(),
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $slug = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = time() . "-" . $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->storeAs('public', $thumbnail);
            $article->update([
                'thumbnail' => $thumbnail
            ]);
        }

        $article->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('article.index')->with('message', 'Article updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('article.index')->with('message', 'Article deleted successfully!');
    }
}
