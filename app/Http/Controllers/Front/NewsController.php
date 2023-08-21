<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content\News;
use App\Models\Content\NewsCategory;
use App\Models\Content\Comment;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NewsCategory $newsCategory = null)
    {
        $newsCategoryName = null;
        if ($newsCategory) {
            $news = $newsCategory->news()->paginate(4);
            $newsCategoryName = $newsCategory->name;
        } else {
            $news = News::orderBy('created_at', 'desc')->where('status', 1)->paginate(4);
        }
        return view('front.all-news', compact('news', 'newsCategoryName'));
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
    public function show(News $news)
    {
        return view('front.show-news', compact('news'));

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

    public function addComment(News $news, Request $request)
    {

        if ($news->commentable == 1) {
            if (auth()->user()->activation == 0) {
                return back()->with('swal-error', 'برای نظر دادن باید حساب کاربری شما فعال باشد');
            }

            $request->validate([
                'body' => 'required|max:2000',
            ]);
            $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
            $inputs['user_id'] = auth()->user()->id;
            $inputs['commentable_id'] = $news->id;
            $inputs['commentable_type'] = News::class;
            $inputs['status'] = 1;
            Comment::create($inputs);
            return back()->with('swal-success', ' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
        } else {
            return back()->with('swal-error', 'نظر دادن برای این خبر مجاز نمیباشد');
        }
    }

    public function addReplay(News $news, Comment $comment, Request $request)
    {
        if ($news->commentable == 1) {

            if (auth()->user()->activation == 0) {
                return back()->with('swal-error', 'برای نظر دادن باید حساب کاربری شما فعال باشد');
            }
            $request->validate([
                'body' => 'required|max:2000',
            ]);
            $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
            $inputs['user_id'] = auth()->user()->id;
            $inputs['commentable_id'] = $news->id;
            $inputs['commentable_type'] = News::class;
            $inputs['parent_id'] = $comment->id;
            $inputs['status'] = 1;
            Comment::create($inputs);
            return back()->with('swal-success', ' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
        } else {
            return back()->with('swal-error', 'نظر دادن برای این خبر مجاز نمیباشد');
        }
    }
}
