<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use App\Models\Content\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Content\NewsRequest;


class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:news-admin,show-news');
        $this->middleware('role:news-admin,show-news');
        $this->middleware('role:news-admin,create-news')->only(['create', 'store']);
        $this->middleware('role:news-admin,edit-news')->only(['edit', 'upadte', 'status', 'commentable']);
        $this->middleware('role:news-admin,delete-news')->only(['destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = NewsCategory::where('status', 1)->get();
        return view('admin.content.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/news'), $fileName);
            $inputs['image'] = 'images/news/' . '' . $fileName;
        }
        $inputs['user_id'] = auth()->user()->id;
        $news = News::create($inputs);
        return redirect()->route('admin.content.news.index')->with('swal-success', 'ایتم  جدید شما با موفقیت ثبت شد');
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
    public function edit(News $news)
    {
        $categories = NewsCategory::where('status', 1)->get();
        return view('admin.content.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/news'), $fileName);
            $inputs['image'] = 'images/news/' . '' . $fileName;
        }
        $news->update($inputs);
        return redirect()->route('admin.content.news.index')->with('swal-success', 'ایتم شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.content.news.index')->with('swal-success', 'ایتم مورد نظر با موفقیت حذف شد ');
    }

    public function status(News $news)
    {
        $news->status = $news->status == 0 ? 1 : 0;
        $result = $news->save();
        if ($result) {

            if ($news->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function commentable(News $news)
    {
        $news->commentable = $news->commentable == 0 ? 1 : 0;
        $result = $news->save();
        if ($result) {

            if ($news->commentable == 0) {
                return response()->json(['commentable' => true, 'checked' => false]);
            } else {
                return response()->json(['commentable' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['commentable' => false]);

        }
    }


}