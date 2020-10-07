<?php

namespace App\Http\Controllers;

use App\Article;
use App\Website;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $articles = Article::with('website')->where('website_id',$id)->get();
        return view('article.list')->with('articles',$articles)->with('website','websiteName');
    }
}
