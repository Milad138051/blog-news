@extends('admin.layouts.master')

@section('head-tag')
    <title>نقش ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active"> سطوح دسترسی</li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نقش ها</li>

        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نقش ها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
				        @if(auth()->user()->hasPermissionTo('edit-user'))
                    <a href="{{ route('admin.user.role.create') }}" class="btn btn-info btn-sm">ایجاد نقش جدید</a>
				        @endif
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام نقش</th>
                            <th>دسترسی ها</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$role->name}}</td>
                                <td>

                                    @if(empty($role->permissions()->get()->toArray()))
                                        <span class="text-danger">برای این نقش دسترسی تعریف نشده است</span>
                                    @else
                                        @foreach($role->permissions as $permission)

                                            {{$permission->name}} <br>

                                        @endforeach

                                    @endif


                                    <br>
                                </td>

                                <td class="width-22-rem text-left">
				                       @if(auth()->user()->hasPermissionTo('edit-user'))
                                    <a href="{{route('admin.user.role.permission-form',$role->id)}}"
                                       class="btn btn-success btn-sm"><i class="fa fa-user-graduate"></i> دسترسی ها</a>
                                    <a href="{{route('admin.user.role.edit',$role->id)}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
				                  
                                    <form class="d-inline" action="{{ route('admin.user.role.destroy', $role->id) }}"
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
