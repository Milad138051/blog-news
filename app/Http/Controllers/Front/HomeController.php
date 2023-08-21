<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content\Article;
use App\Models\Content\News;


class HomeController extends Controller
{
    public function home()
    {
        //dd(auth()->user()->can('edit-news',auth()->user()));
        $articles = Article::orderBy('created_at', 'desc')->where('status', 1)->take(3)->get();
        $news = News::orderBy('created_at', 'desc')->where('status', 1)->take(3)->get();
        return view('front.home', compact('articles', 'news'));
    }


}


