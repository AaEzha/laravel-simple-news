<?php

namespace App\Exports;

use App\Article;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ArticlesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Article::all();
    // }

    public function view(): View
    {
        return view('article.export', [
            'articles' => Article::all(),
            'time' => date('d F Y, H:i')
        ]);
    }
}
