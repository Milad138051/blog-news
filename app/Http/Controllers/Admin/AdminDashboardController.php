<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content\Article;
use App\Models\Content\ArticleCategory;
use App\Models\Content\News;
use App\Models\Content\NewsCategory;
use App\Models\Content\Comment;

class AdminDashboardController extends Controller
{

    public function index()
    {
        $users = User::all()->count();
        $adminUsers = User::where('user_type', 1)->where('activation', 1)->count();
        $normalUsers = User::where('user_type', 0)->where('activation', 1)->count();
        $articles = Article::where('status', 1)->count();
        $news = News::where('status', 1)->count();
        $comments = Comment::where('status', 1)->count();
        $newsCategories = NewsCategory::where('status', 1)->count();
        $articleCategories = ArticleCategory::where('status', 1)->count();
        return view('admin.index', compact('users', 'adminUsers', 'normalUsers', 'articles', 'news', 'newsCategories', 'articleCategories', 'comments'));
    }
}
