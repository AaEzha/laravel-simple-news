<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use PDF;

class ExportArticlePDFController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = [
            'articles' => Article::all(),
            'time' => date('d F Y, H:i')
        ];

        $pdf = PDF::loadView('article.export-pdf', $data);

        return $pdf->download('articles.pdf');
    }
}
