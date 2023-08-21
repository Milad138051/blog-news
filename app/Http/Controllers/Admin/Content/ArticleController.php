<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Article;
use App\Models\Content\ArticleCategory;
use App\Models\Content\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Content\ArticleRequest;


class ArticleController extends Controller
{


    public function __construct()
    {
        $this->middleware('role:article-admin,show-article');
        $this->middleware('role:article-admin,create-article')->only(['create', 'store']);
        $this->middleware('role:article-admin,edit-article')->only(['edit', 'update', 'status', 'commentable']);
        $this->middleware('role:article-admin,delete-article')->only(['destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ArticleCategory::where('status', 1)->get();
        return view('admin.content.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/articles'), $fileName);
            $inputs['image'] = 'images/articles/' . '' . $fileName;
        }
        $inputs['user_id'] = auth()->user()->id;
        Article::create($inputs);
        return redirect()->route('admin.content.article.index')->with('swal-success', 'ایتم با موفقیت ذخیره شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = ArticleCategory::where('status', 1)->get();
        return view('admin.content.article.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/articles'), $fileName);
            $inputs['image'] = 'images/articles/' . '' . $fileName;
        }
        $article->update($inputs);
        return redirect()->route('admin.content.article.index')->with('swal-success', 'ایتم شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.content.article.index')->with('swal-success', 'ایتم مورد نظر با موفقیت حذف شد ');
    }

    public function status(Article $article)
    {
        $article->status = $article->status == 0 ? 1 : 0;
        $result = $article->save();
        if ($result) {

            if ($article->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function commentable(Article $article)
    {
        $article->commentable = $article->commentable == 0 ? 1 : 0;
        $result = $article->save();
        if ($result) {

            if ($article->commentable == 0) {
                return response()->json(['commentable' => true, 'checked' => false]);
            } else {
                return response()->json(['commentable' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['commentable' => false]);

        }
    }


}