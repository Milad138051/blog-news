<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content\Article;
use App\Models\Content\ArticleCategory;
use App\Models\Content\Comment;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArticleCategory $articleCategory = null)
    {
        $articleCategoryName = null;
        if ($articleCategory) {
            $articles = $articleCategory->articles()->paginate(4);
            $articleCategoryName = $articleCategory->name;
        } else {
            $articles = Article::orderBy('created_at', 'desc')->where('status', 1)->paginate(4);
        }
        return view('front.all-articles', compact('articles', 'articleCategoryName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('front.show-article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function addComment(Article $article, Request $request)
    {
        if ($article->commentable == 1) {

            if (auth()->user()->activation == 0) {
                return back()->with('swal-error', 'برای نظر دادن باید حساب کاربری شما فعال باشد');
            }
            $request->validate([
                'body' => 'required|max:2000',
            ]);
            $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
            $inputs['user_id'] = auth()->user()->id;
            $inputs['commentable_id'] = $article->id;
            $inputs['commentable_type'] = Article::class;
            $inputs['status'] = 1;
            Comment::create($inputs);
            return back()->with('swal-success', ' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
        } else {
            return back()->with('swal-error', 'نظر دادن برای این مقاله مجاز نمیباشد');
        }
    }

    public function addReplay(Article $article, Comment $comment, Request $request)
    {
        if ($article->commentable == 1) {

            if (auth()->user()->activation == 0) {
                return back()->with('swal-error', 'برای نظر دادن باید حساب کاربری شما فعال باشد');
            }
            $request->validate([
                'body' => 'required|max:2000',
            ]);
            $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
            $inputs['user_id'] = auth()->user()->id;
            $inputs['commentable_id'] = $article->id;
            $inputs['commentable_type'] = Article::class;
            $inputs['parent_id'] = $comment->id;
            $inputs['status'] = 1;
            Comment::create($inputs);
            return back()->with('swal-success', ' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
        } else {
            return back()->with('swal-error', 'نظر دادن برای این مقاله مجاز نمیباشد');
        }
    }
}
