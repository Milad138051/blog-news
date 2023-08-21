<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content\Comment;
use App\http\requests\Admin\Content\CommentRequest;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:comment-admin,show-comment');
        $this->middleware('role:comment-admin,show-comment')->only(['show']);
        $this->middleware('role:comment-admin,approved-comment')->only(['approved']);
        $this->middleware('role:comment-admin,answer-comment')->only(['answer']);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $comments = Comment::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.comment.index', compact('comments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('admin.content.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {

            if ($comment->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);

        }
    }

    public function approved(Comment $comment)
    {

        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            return redirect()->route('admin.content.comment.index')->with('swal-success', ' وضعیت نظر با موفقیت تغییر کرد');
        } else {
            return redirect()->route('admin.content.comment.index')->with('swal-error', ' خطایی رخ داد');
        }
    }


    public function answer(Request $request, Comment $comment)
    {
        $request->validate([
            'answer' => 'required|max:2000',
        ]);
        $inputs['user_id'] = auth()->user()->id;
        $inputs['parent_id'] = $comment->id;
        $inputs['article_id'] = $comment->article_id;
        $inputs['approved'] = 1;
        $inputs['status'] = 1;
        $inputs['body'] = $request->body;
        $inputs['commentable_id'] = $comment->commentable_id;
        $inputs['commentable_type'] = $comment->commentable_type;

        Comment::create($inputs);
        return redirect()->route('admin.content.comment.index')->with('swal-success', 'پاسخ با موفقیت ثبت شد');

    }

}
