@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش نظر ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> نظرات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظر ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظرها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        کاربر : {{$comment->user->name}}
                        با کد : {{$comment->user_id}}
                    </section>

                    <section class="card-body">
                        <h5 class="card-text">مربوط به مقاله : {{$comment->commentable->title}}</h5>

                        <p class="card-text">متن نظر : {{$comment->body}}</p>
                    </section>
                </section>

                <section>
                    <form action="{{ route('admin.content.comment.answer', $comment )}}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="answer">پاسخ ادمین</label>

                                    @if(auth()->user()->hasPermissionTo('answer-comment'))
                                        ‍<textarea id="answer" class="form-control form-control-sm" name="body"
                                                   rows="4"></textarea>
                                </div>
                                @error('answer')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                                @endif
                            </section>

                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection
