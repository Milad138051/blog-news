<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('front.home')}}">my site</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">


                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">ثبت نام</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">ورود</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="{{route('front.profile')}}">پروفایل</a></li>
                            <li>
                                <form action="{{route('logout')}}" method=POST>
                                    @csrf
                                    <button class="dropdown-item" type="submit">خروج</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth


                <li class="nav-item">
                    <a class="nav-link" href="{{route('front.home')}}">خانه</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('front.all-articles')}}">مقالات</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('front.all-news')}}">اخبار</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        دسته بندی ها
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <b class="m-3">اخبار</b>
                        @foreach($newsCategories as $newsCategory)
                            <li><a class="dropdown-item"
                                   href="{{route('front.all-news',$newsCategory)}}">{{$newsCategory->name}}</a></li>
                        @endforeach

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <b class="m-3">مقالات</b>
                        @foreach($articleCategories as $articleCategory)
                            <li><a class="dropdown-item"
                                   href="{{route('front.all-articles',$articleCategory)}}">{{$articleCategory->name}}</a>
                            </li>
                        @endforeach

                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>













		