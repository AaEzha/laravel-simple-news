<?php

namespace App\Http\Controllers;

use App\Exports\ArticlesExport;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;

class ExportArticleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return \Excel::download(new ArticlesExport, 'articles.xlsx');
    }
}
