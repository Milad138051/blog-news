<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content\ArticleCategory;
use App\Http\Requests\Admin\Content\CategoryRequest;


class ArticleCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:article-admin,show-article');
        $this->middleware('role:article-admin,create-article')->only(['create', 'store']);
        $this->middleware('role:article-admin,edit-article')->only(['edit', 'update', 'status']);
        $this->middleware('role:article-admin,delete-article')->only(['destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ArticleCategory::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.article-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.article-category.create');
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
        ArticleCategory::create($inputs);
        return to_route('admin.content.article-category.index')->with('swal-success', 'دسته بندی جدید شما با موفقیت ثبت شد');
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
    public function edit(ArticleCategory $articleCategory)
    {
        return view('admin.content.article-category.edit', compact('articleCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, ArticleCategory $articleCategory)
    {
        $inputs = $request->all();
        $articleCategory->update($inputs);
        return to_route('admin.content.article-category.index')->with('swal-success', 'دسته بندی شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->delete();
        return to_route('admin.content.article-category.index')->with('swal-success', 'ایتم مورد نظر با موفقیت حذف شد ');
    }


    public function status(ArticleCategory $articleCategory)
    {
        $articleCategory->status = $articleCategory->status == 0 ? 1 : 0;
        $result = $articleCategory->save();
        if ($result) {
            if ($articleCategory->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);

        }

    }


}
