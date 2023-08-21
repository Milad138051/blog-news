<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">
            <hr>

            <a href="{{route('admin.home')}}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <section class="sidebar-part-title">بخش محتوی</section>

            @if(auth()->user()->hasRole('news-admin','super-admin') || auth()->user()->hasPermissionTo('show-news'))
                <a href="{{route('admin.content.news-category.index')}}" class="sidebar-link">
                    <i class="fas fa-bars"></i>
                    <span>دسته بندی اخبار</span>
                </a>

                <a href="{{route('admin.content.news.index')}}" class="sidebar-link">
                    <i class="fas fa-bars"></i>
                    <span>اخبار</span>
                </a>
            @endif


            @if(auth()->user()->hasRole('article-admin','super-admin') || auth()->user()->hasPermissionTo('show-article'))
                <a href="{{route('admin.content.article-category.index')}}" class="sidebar-link">
                    <i class="fas fa-bars"></i>
                    <span>دسته بندی مقالات</span>
                </a>

                <a href="{{route('admin.content.article.index')}}" class="sidebar-link">
                    <i class="fas fa-bars"></i>
                    <span>مقالات</span>
                </a>
            @endif


            @if(auth()->user()->hasRole('comment-admin','super-admin') || auth()->user()->hasPermissionTo('show-comment'))
                <a href="{{route('admin.content.comment.index')}}" class="sidebar-link">
                    <i class="fas fa-bars"></i>
                    <span>نظرات</span>
                </a>
            @endif


            @if(auth()->user()->hasRole('admin-user','super-admin') || auth()->user()->hasPermissionTo('show-user'))
                <section class="sidebar-part-title">بخش کاربران</section>
                <a href="{{route('admin.user.admin-user.index')}}" class="sidebar-link">
                    <i class="fas fa-bars"></i>
                    <span>کاربران ادمین</span>
                </a>
                <a href="{{route('admin.user.users.index')}}" class="sidebar-link">
                    <i class="fas fa-bars"></i>
                    <span>کاربران </span>
                </a>

               @if(auth()->user()->hasPermissionTo('edit-user'))
                <section class="sidebar-group-link">
                    <section class="sidebar-dropdown-toggle">
                        <i class="fas fa-chart-bar icon"></i>
                        <span>سطوح دسترسی</span>
                        <i class="fas fa-angle-left angle"></i>
                    </section>
                    <section class="sidebar-dropdown">
                        <a href="{{route('admin.user.role.index')}}">نقش ها</a>
                        <a href="{{route('admin.user.permission.index')}}">دسترسی ها</a>
                    </section>
                </section>
				@endif
            @endif

        </section>
    </section>
</aside>
