@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد کاربر </title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">ایجاد کاربر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد کاربر
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.users.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.user.users.store')}}" method="POST">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name"> نام</label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name"
                                           value={{old('name')}}>
                                </div>
                                @error('name')
                                <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email">ایمیل</label>
                                    <input type="text" class="form-control form-control-sm" name="email" id="email"
                                           value={{old('email')}}>
                                </div>
                                @error('email')
                                <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">کلمه عبور</label>
                                    <input type="password" name="password" class="form-control form-control-sm">
                                </div>
                                @error('password')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="activation">وضعیت فعال سازی</label>
                                    <select name="activation" id="activation" class="form-control form-control-sm">
                                        <option value="0">غیر فعال</option>
                                        <option value="1">فعال</option>
                                    </select>
                                </div>
                                @error('activation')
                                <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection
