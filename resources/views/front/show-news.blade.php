@extends('front.layouts.master-one-col')


@section('head-tag')
    <title>my site</title>
@endsection

@section('content')

    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{$news->title}}</h1>
                        <div class="text-muted fst-italic mb-2">Posted on {{$news->created_at}}
                            by {{auth()->user()->name}}</div>

                        <img style="width:100%" src="{{asset($news->image)}}">
                    </header>
                    <!-- Post content-->
                    <section class="mb-5">{!! $news->body !!}</p>
                    </section>
                </article>

                <section class="border-bottom mb-3 mt-3"></section>

                <div class="d-flex justify-content-between align-items-center">
                    <h5>نظرات</h5>
                </div>

                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            @guest
                                <section class="col-12">
                                    <p>کاربر گرامی لطفا برای ثبت نظر ابتدا وارد حساب کاربری خود شوید </p>
                                    <p>لینک ثبت نام و یا ورود
                                        <a href="{{route('register')}}">ثبت نام</a>
                                        <a href="{{route('login')}}">ورود</a>
                                    </p>
                                </section>
                            @endguest


                            @auth
                                @if($news->commentable==1)
                                    <form class="mb-4" action="{{route('front.news.add-comment',$news)}}" method="POST">
                                        @csrf
                                        <textarea class="form-control" rows="3" name="body"></textarea>
                                        @error('body')
                                        <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                                        @enderror

                                        <section class="col-12 mt-5">
                                            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                                        </section>
                                    </form>
                                @else
                                    <h4 class="text-danger">نظر دادن برای این خبر , مجاز نمیباشد</h4>
                                @endif
                            @endauth

                            @foreach($news->activeComments() as $comment)
                                <div class="ms-3 single_comment mt-3">
                                    <div class="fw-bold">{{$comment->user->name}}</div>
                                    <div class="fw-bold">{{$comment->created_at}}</div>
                                    <div class="d-flex flex-row-reverse">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal-{{$comment->id}}" data-bs-whatever="@mdo">
                                            پاسخ
                                        </button>
                                        <!-- start add replay Modal -->
                                        <div class="modal fade" id="exampleModal-{{$comment->id}}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">افزودن
                                                            دیدگاه</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <form action="{{route('front.news.add-replay',[$news,$comment])}}"
                                                                  id="form-{{$comment->id}}" method="POST">
                                                                @csrf
                                                                <label for="message-text"
                                                                       class="col-form-label">دیدگاه:</label>
                                                                <textarea class="form-control" id="message-text"
                                                                          name="body"></textarea>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                        <button type="submit" class="btn btn-primary"
                                                                onclick="document.getElementById('form-{{$comment->id}}').submit();">
                                                            ثبت
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end add replay Modal -->
                                    </div>
                                    {{$comment->body}}

                                    <section class="border-bottom mb-3 mt-3"></section>
                                    @foreach($comment->activeAnswers() as $answer)
                                    <!-- Child comment 1-->
                                        <div class="d-flex mt-4">
                                            <div class="ms-3">
                                                <div class="fw-bold">{{$answer->user->name}}</div>
                                                <div class="fw-bold">{{$answer->created_at}}</div>

                                                {{$answer->body}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>


                    </div>
                </section>
            </div>


        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
    </footer>


@endsection


@section('script')
    <!-- Bootstrap core JS-->
    <script src="{{asset('front-assets/css/bootstrap/bootstrap.bundle.js')}}"></script>
    <!-- Core theme JS-->
    <script src="{{asset('front-assets/js/scripts.js')}}"></script>

@endsection