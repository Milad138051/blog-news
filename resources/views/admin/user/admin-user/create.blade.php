@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد کاربر ادمین</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">ایجاد ادمین جدید</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد ادمین
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.user.admin-user.store')}}" method="POST">
                        @csrf
                        <section class="row">


                            <section class="col-12">
                                <div class="form-group">
                                    <label for="category_id">کاربران</label>
                                    <select name="user_id" id="" class="form-control form-control-sm">
                                        <option value="">کاربران را انتخاب کنید</option>
                                        @foreach ($allUsers as $user)
                                            <option value="{{ $user->id }}"
                                                    @if(old('user') == $user->id) selected @endif>{{ $user->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('user')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
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
