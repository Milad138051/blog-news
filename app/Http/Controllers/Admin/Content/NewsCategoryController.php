<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content\NewsCategory;
use App\Http\Requests\Admin\Content\CategoryRequest;

class NewsCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:news-admin,show-news');
        $this->middleware('role:news-admin,create-news')->only(['create', 'store']);
        $this->middleware('role:news-admin,edit-news')->only(['edit', 'upadte', 'status']);
        $this->middleware('role:news-admin,delete-news')->only(['destroy']);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = NewsCategory::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.news-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.news-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $inputs = $request->all();
        NewsCategory::create($inputs);
        return to_route('admin.content.news-category.index')->with('swal-success', 'دسته بندی جدید شما با موفقیت ثبت شد');
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
    public function edit(NewsCategory $newsCategory)
    {
        return view('admin.content.news-category.edit', compact('newsCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, NewsCategory $newsCategory)
    {
        $inputs = $request->all();
        $newsCategory->update($inputs);
        return to_route('admin.content.news-category.index')->with('swal-success', 'دسته بندی شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsCategory $newsCategory)
    {
        $newsCategory->delete();
        return to_route('admin.content.news-category.index')->with('swal-success', 'ایتم مورد نظر با موفقیت حذف شد ');
    }


    public function status(NewsCategory $newsCategory)
    {
        $newsCategory->status = $newsCategory->status == 0 ? 1 : 0;
        $result = $newsCategory->save();
        if ($result) {
		  
            if ($newsCategory->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);

        }


    }


}
