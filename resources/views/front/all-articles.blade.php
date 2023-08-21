@extends('front.layouts.master-one-col')


@section('head-tag')
    <title>my site</title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
@endsection

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h1>
                    همه مقالات
                    @if($articleCategoryName!==null)
                        ({{$articleCategoryName}})
                    @endif
                </h1>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5">
                @forelse($articles as $article)
                    <div class="col">
                        <div class="card shadow-sm">

                            <img class="bd-placeholder-img card-img-top" src="{{asset($article->image)}}" height="250">
                            <div class="card-body">
                                <h3>{{$article->title}}</h3>
                                <p class="card-text">{!!Str::limit($article->body,30)!!}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{route('front.show-article',$article)}}"
                                           class="btn btn-sm btn-outline-secondary">نمایش</a>
                                    </div>
                                    <small class="text-muted">{{$article->created_at}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
					@empty
                                            <div class="text-danger">
                                              ایتمی موجود نمیباشد  
											</div>               
				@endforelse
            </div>

            @if(!request()->has('newsCategory'))
                {{$articles->links('pagination::bootstrap-5')}}
                <section class="border-bottom mb-3"></section>
            @endif
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