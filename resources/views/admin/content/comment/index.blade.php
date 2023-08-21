@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نظرات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر </a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نظر</th>
                            <th>پاسخ به</th>
                            <th>کد کاربر</th>
                            <th>نویسنده نظر</th>
                            <th>کد خبر/مقاله</th>
                            <th>عنوان خبر/مقاله</th>
                            <th>وضعیت تایید</th>
                            <th>وضعیت نمایش در سایت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $key => $comment)

                            <tr>
                                <th>{{$key += 1 }}</th>
                                <td>{{Str::limit($comment->body, 10) }}</td>
                                <td>{{$comment->parent ? Str::limit($comment->parent->body, 10) : 'نظر والد ندارد' }}</td>
                                <td>{{$comment->user->id}}</td>
                                <td>{{$comment->user->name}}</td>
                                <td>{{$comment->commentable_id}}</td>
                                <td>{{$comment->commentable->title}}</td>
                                <td>{{$comment->approved ==1 ? 'تایید شده' :'در انتظار تایید' }}</td>
                                <td>
                                    <label>
                                        @if(auth()->user()->hasPermissionTo('show-in-site-comment'))
                                            <input id="{{ $comment->id }}" onchange="changeStatus({{ $comment->id }})"
                                                   data-url="{{ route('admin.content.comment.status', $comment->id) }}"
                                                   type="checkbox" @if ($comment->status === 1)
                                                   checked
                                                    @endif>
                                        @endif
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">

                                    @if(auth()->user()->hasPermissionTo('show-comment'))
                                        <a href="{{ route('admin.content.comment.show',$comment->id) }}"
                                           class="btn btn-info btn-sm"><i class="fa fa-eye"></i> نمایش</a>
                                    @endif

                                    @if(auth()->user()->hasPermissionTo('approved-comment'))
                                        @if($comment->approved==1)
                                            <a href="{{route('admin.content.comment.approved',$comment->id)}}"
                                               class="btn btn-warning btn-sm" type="submit"><i class="fa fa-clock"></i>
                                                عدم تایید</a>
                                        @else
                                            <a href="{{route('admin.content.comment.approved',$comment->id)}}"
                                               class="btn btn-success btn-sm" type="submit"><i class="fa fa-check"></i>
                                                تایید</a>
                                        @endif
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
                        text: 'هنگام ویرایش مشکلی بوجود امده است',
                        icon: 'error',
                        confirmButtonText: 'باشه',
                    });
                });
            }


        }
    </script>




@endsection
