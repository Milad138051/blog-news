@extends('admin.layouts.master')

@section('head-tag')
    <title>مقالات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> مقالات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        مقالات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    @if(auth()->user()->hasPermissionTo('create-article'))
                        <a href="{{ route('admin.content.article.create') }}" class="btn btn-info btn-sm">ایجاد</a>
                    @endif
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>دسته</th>
                            <th>بدنه</th>
                            <th>تصویر</th>
                            <th>نویسنده</th>
                            <th>وضعیت نمایش در سایت</th>
                            <th>امکان درج کامنت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($articles as $key=>$article)

                            <tr>
                                <th>{{ $key += 1 }}</th>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->articleCategory->name }}</td>
                                <td>{{ Str::limit($article->body,10) }}</td>
                                <td>
                                    <img src="{{asset($article->image)}}" width="50" height="50">
                                </td>
                                <td>{{ $article->user->name }}</td>

                                <td>
                                    <label>
                                        @if(auth()->user()->hasPermissionTo('edit-article'))
                                            <input id="{{ $article->id }}" onchange="changeStatus({{ $article->id }})"
                                                   data-url="{{ route('admin.content.article.status', $article->id) }}"
                                                   type="checkbox" @if ($article->status === 1)
                                                   checked
                                                    @endif>
                                        @else
                                            <div class="text-danger">
                                                شما مجاز به انجام این عملیات نیستید
                                            </div>
                                        @endif
                                    </label>
                                </td>

                                <td>
                                    <label>
                                        @if(auth()->user()->hasPermissionTo('edit-article'))
                                            <input id="{{ $article->id }}-commentable"
                                                   onchange="commentable({{ $article->id }})"
                                                   data-url="{{ route('admin.content.article.commentable', $article->id) }}"
                                                   type="checkbox" @if ($article->commentable === 1)
                                                   checked
                                                    @endif>
                                        @else
                                            <div class="text-danger">
                                                شما مجاز به انجام این عملیات نیستید
                                            </div>
                                        @endif
                                    </label>
                                </td>

                                <td class="width-16-rem text-left">

                                    @if(auth()->user()->hasPermissionTo('edit-article'))
                                        <a href="{{route('admin.content.article.edit',$article->id)}}"
                                           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش
                                        </a>
                                    @endif

                                    @if(auth()->user()->hasPermissionTo('delete-article'))
                                        <form class="d-inline"
                                              action="{{ route('admin.content.article.destroy', $article->id) }}"
                                              method="post">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                        class="fa fa-trash-alt"></i> حذف
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')

    <script type="text/javascript">
        function changeStatus(id) {
            var element = $("#" + id)
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            // successToast('ایتم با موفقیت فعال شد')
                            sweetalertStatusSuccess('ایتم با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked', false);
                            // successToast('ایتم با موفقیت غیر فعال شد')
                            sweetalertStatusSuccess('ایتم با موفقیت غیر فعال شد')
                        }
                    }
                    else {
                        element.prop('checked', elementValue);
                        // errorToast('هنگام ویرایش مشکلی بوجود امده است')
                        sweetalertStatusError('هنگام ویرایش مشکلی بوجود امده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    // errorToast('ارتباط برقرار نشد')
                    sweetalertStatusError('ارتباط برقرار نشد')
                }
            });

            function sweetalertStatusSuccess(msg) {
                $(document).ready(function () {
                    Swal.fire({
                        title: msg,
                        text: 'عملیات با موفقیت ذخیره شد',
                        icon: 'success',
                        confirmButtonText: 'باشه',
                    });
                });
            }

            function sweetalertStatusError(msg) {
                $(document).ready(function () {
                    Swal.fire({
                        title: msg,
                        text: 'عملیات با موفقیت ذخیره شد',
                        icon: 'error',
                        confirmButtonText: 'باشه',
                    });
                });
            }


        }
    </script>


    <script type="text/javascript">
        function commentable(id) {
            var element = $("#" + id + '-commentable')
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response.commentable) {
                        if (response.checked) {
                            element.prop('checked', true);
                            sweetalertStatusSuccess('امکان درج کامنت فعال شد')
                        }
                        else {
                            element.prop('checked', false);
                            sweetalertStatusSuccess('امکان درج کامنت غیر فعال شد')
                        }
                    }
                    else {
                        element.prop('checked', elementValue);
                        sweetalertStatusError('هنگام ویرایش مشکلی بوجود امده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    sweetalertStatusError('ارتباط برقرار نشد')
                }
            });


            function sweetalertStatusSuccess(msg) {
                $(document).ready(function () {
                    Swal.fire({
                        title: msg,
                        text: 'عملیات با موفقیت ذخیره شد',
                        icon: 'success',
                        confirmButtonText: 'باشه',
                    });
                });
            }

            function sweetalertStatusError(msg) {
                $(document).ready(function () {
                    Swal.fire({
                        title: msg,
                        text: 'هنگام ویرایش مشکلی بوجود امده است',
                        icon: 'error',
                        confirmButtonText: 'باشه',
                    });
                });
            }


        }
    </script>

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
