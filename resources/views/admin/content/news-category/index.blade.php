@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">دسته بندی اخبار</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسته بندی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    @if(auth()->user()->hasPermissionTo('create-news'))
                        <a href="{{ route('admin.content.news-category.create') }}" class="btn btn-info btn-sm">ایجاد
                            دسته بندی</a>
                    @endif

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>توضیحات</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $key=>$category)

                            <tr>
                                <th>{{ $key += 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>

                                <td>
                                    <label>
                                        @if(auth()->user()->hasPermissionTo('edit-news'))
                                            <input id="{{ $category->id }}" onchange="changeStatus({{ $category->id }})"
                                                   data-url="{{ route('admin.content.news-category.status', $category->id) }}"
                                                   type="checkbox" @if ($category->status === 1) checked @endif>
                                        @else
                                            <div class="text-danger">
                                                شما مجاز به انجام این عملیات نیستید
                                            </div>
                                        @endif
                                    </label>
                                </td>

                                <td class="width-16-rem text-left">
                                    @if(auth()->user()->hasPermissionTo('edit-news'))
                                        <a href="{{ route('admin.content.news-category.edit', $category->id) }}"
                                           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    @endif

                                    @if(auth()->user()->hasPermissionTo('delete-news'))
                                        <form class="d-inline"
                                              action="{{ route('admin.content.news-category.destroy', $category->id) }}"
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
                            sweetalertStatusSuccess('ایتم با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked', false);
                            sweetalertStatusSuccess('ایتم با موفقیت غیر فعال شد')

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
