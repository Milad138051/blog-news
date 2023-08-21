@extends('admin.layouts.master')

@section('head-tag')
    <title>اخبار</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">اخبار</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اخبار
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    @if(auth()->user()->hasPermissionTo('create-news'))
                        <a href="{{ route('admin.content.news.create') }}" class="btn btn-info btn-sm">ایجاد</a>
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

                        @foreach ($news as $key=>$singleNews)
                            <tr>
                                <th>{{ $key += 1 }}</th>
                                <td>{{ $singleNews->title }}</td>
                                <td>{{ $singleNews->newsCategory->name }}</td>
                                <td>{{ Str::limit($singleNews->body,10) }}</td>
                                <td>
                                    <img src="{{asset($singleNews->image)}}" width="50" height="50">
                                </td>
                                <td>{{ $singleNews->user->name }}</td>

                                <td>

                                    @if(auth()->user()->hasPermissionTo('edit-news'))
                                        <label>
                                            <input id="{{ $singleNews->id }}"
                                                   onchange="changeStatus({{ $singleNews->id }})"
                                                   data-url="{{ route('admin.content.news.status', $singleNews->id) }}"
                                                   type="checkbox" @if ($singleNews->status === 1)
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
                                        @if(auth()->user()->hasPermissionTo('edit-news'))
                                            <input id="{{ $singleNews->id }}-commentable"
                                                   onchange="commentable({{ $singleNews->id }})"
                                                   data-url="{{ route('admin.content.news.commentable', $singleNews->id) }}"
                                                   type="checkbox" @if ($singleNews->commentable === 1)
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
                                    @if(auth()->user()->hasPermissionTo('edit-news'))
                                        <a href="{{route('admin.content.news.edit',$singleNews->id)}}"
                                           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    @endif


                                    @if(auth()->user()->hasPermissionTo('delete-news'))
                                        <form class="d-inline"
                                              action="{{ route('admin.content.news.destroy', $singleNews->id) }}"
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

            // function successToast(message){
            //
            //     var successToastTag = '<section class="toast" data-delay="5000">\n' +
            //         '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
            //             '<strong class="ml-auto">' + message + '</strong>\n' +
            //             '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
            //                 '<span aria-hidden="true">&times;</span>\n' +
            //                 '</button>\n' +
            //                 '</section>\n' +
            //                 '</section>';
            //
            //                 $('.toast-wrapper').append(successToastTag);
            //                 $('.toast').toast('show').delay(5500).queue(function() {
            //                     $(this).remove();
            //                 })
            // }
            //
            // function errorToast(message){
            //
            //     var errorToastTag = '<section class="toast" data-delay="5000">\n' +
            //         '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
            //             '<strong class="ml-auto">' + message + '</strong>\n' +
            //             '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
            //                 '<span aria-hidden="true">&times;</span>\n' +
            //                 '</button>\n' +
            //                 '</section>\n' +
            //                 '</section>';
            //
            //                 $('.toast-wrapper').append(errorToastTag);
            //                 $('.toast').toast('show').delay(5500).queue(function() {
            //                     $(this).remove();
            //                 })
            // }


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
