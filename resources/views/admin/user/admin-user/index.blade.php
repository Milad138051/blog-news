@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        کاربران ادمین
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
				        @if(auth()->user()->hasPermissionTo('create-user'))
                    <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین
                        جدید</a>
						@endif
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ایمیل</th>
                            <th>نام کاربری</th>
                            <th>نقش</th>
                            <th>دسترسی سریع</th>
                            <th>وضعیت فعالسازی</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $key => $admin)
                            <tr>
                                <th>{{$key + 1}}</th>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->name}}</td>

                                <td>
                                    @forelse($admin->roles as $role)
                                        <div>
                                            {{$role->name}}
                                        </div>
                                    @empty
                                        <div class="text-danger">
                                            نقشی برای این کاربر تعریف نشده
                                        </div>
                                    @endforelse
                                </td>

                                <td>
                                    @forelse($admin->permissions as $permission)
                                        <div>
                                            {{$permission->name}}
                                        </div>
                                    @empty
                                        <div class="text-danger">
                                            هیچ دسترسی برای این کاربر تعریف نشده
                                        </div>
                                    @endforelse
                                </td>

                                <td>
                                    <label>
									    @if(auth()->user()->hasPermissionTo('edit-user'))
                                        <input id="{{ $admin->id }}-activation"
                                               onchange="changeActivation({{ $admin->id }})"
                                               data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}"
                                               type="checkbox" @if ($admin->activation === 1)
                                               checked
                                                @endif>
									    @else
                                            <div class="text-danger">
                                                شما مجاز به انجام این عملیات نیستید
                                            </div>
										@endif
                                    </label>
                                </td>

                                <td class="width-22-rem text-left">
									    @if(auth()->user()->hasPermissionTo('edit-user'))
                                    <a href="{{route('admin.user.admin-user.roles',$admin)}}"
                                       class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> نقش</a>
										@endif
									  
								    	@if(auth()->user()->hasPermissionTo('edit-user'))
										<a href="{{route('admin.user.admin-user.permissions',$admin)}}"
                                       class="btn btn-success btn-sm"><i class="fa fa-edit"></i> دسترسی</a>
										@endif
			
                            			@if(auth()->user()->hasPermissionTo('edit-user'))
                                    <a href="{{ route('admin.user.admin-user.edit', $admin->id) }}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
										@endif
                            			
										@if(auth()->user()->hasPermissionTo('delete-user'))
										<form class="d-inline"
                                          action="{{ route('admin.user.admin-user.destroy', $admin->id) }}"
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

        function changeActivation(id) {
            var element = $("#" + id + '-activation')
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
