@extends('admin.layouts.master')

@section('head-tag')
    <title>دسترسی ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active"> سطوح دسترسی</li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسترسی ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسترسی ها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
				        @if(auth()->user()->hasPermissionTo('edit-user'))
                    <a href="{{ route('admin.user.permission.create') }}" class="btn btn-info btn-sm">ایجاد دسترسی
                        ها</a>
						@endif
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسترسی</th>
                            <th>توضیحات</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$permission->name}}</td>
                                <td>
                                    {{$permission->description}}
                                </td>

                                <td class="width-22-rem text-left">
									   
									   @if(auth()->user()->hasPermissionTo('edit-user'))
                                    <a href="{{route('admin.user.permission.edit',$permission->id)}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
									   @endif
								
         								@if(auth()->user()->hasPermissionTo('edit-user'))
                                    <form class="d-inline"
                                          action="{{ route('admin.user.permission.destroy', $permission->id) }}"
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
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
