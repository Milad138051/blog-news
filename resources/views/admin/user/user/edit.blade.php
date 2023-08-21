@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کاربر</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">ویرایش کاربر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش کاربر
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.users.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.user.users.update',$user->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">نام</label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name"
                                           value={{old('name',$user->name)}}>
                                </div>
                                @error('name')
                                <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">ایمیل</label>
                                    <input type="text" class="form-control form-control-sm " disabled name="email"
                                           value={{old('email',$user->email)}}>
                                </div>
                                @error('email')
                                <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="activation">وضعیت فعال سازی</label>
                                    <select name="activation" id="activation" class="form-control form-control-sm">
                                        <option @if(old('activation',$user->activation)==0) selected @endif value="0">
                                            غیر فعال
                                        </option>
                                        <option @if(old('activation',$user->activation)==1) selected @endif value="1">
                                            فعال
                                        </option>
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
