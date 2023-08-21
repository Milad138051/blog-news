@extends('front.layouts.master-one-col')


@section('head-tag')
    <title>my site</title>
@endsection

@section('content')

    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">

                <article style="width:100%">

                    <header class="mb-4">
                        <!-- title-->
                        <h1 class="fw-bolder mb-1">حساب</h1>
                    </header>

                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <section class="d-flex justify-content-end my-4">
                            <a class="btn btn-link btn-sm text-info text-decoration-none mx-1" data-bs-toggle="modal"
                               data-bs-target="#edit-profile"><i class="fa fa-edit px-1"></i>ویرایش حساب</a>
                        </section>


                        <section class="row">
                            <section class="col-6 border-bottom mb-2 py-2">
                                <section class="field-title">نام کاربری</section>
                                <section class="field-value overflow-auto">{{ auth()->user()->name ?? '-' }}</section>
                            </section>


                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">ایمیل</section>
                                <section class="field-value overflow-auto">{{ auth ()->user()->email ?? '-' }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">وضعیت حساب</section>
                                <section
                                        class="field-value overflow-auto">{{ auth ()->user()->activation==1 ? 'فعال' :'غیر فعال' }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">نوع حساب</section>
                                <section
                                        class="field-value overflow-auto">{{ auth ()->user()->user_type==0 ? 'کاربر سایت' :'ادمین'}}</section>
                            </section>
                        </section>


                        <section class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="edit-profile-label"
                                 aria-hidden="true">
                            <section class="modal-dialog">
                                <section class="modal-content">
                                    <section class="modal-header">
                                        <h5 class="modal-title" id="edit-profile-label"><i class="fa fa-plus"></i>
                                            ویرایش
                                            حساب </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </section>
                                    <section class="modal-body">
                                        <form class="row" method="post"
                                              action="{{ route('front.profile.update') }}">
                                            @csrf
                                            @method('PUT')

                                            <section class="col-6 mb-2">
                                                <label for="name" class="form-label mb-1">نام کاربری
                                                </label>
                                                <input value="{{ auth()->user()->name ?? auth()->user()->name }}"
                                                       type="text" name="name" class="form-control form-control-sm"
                                                       id="name" placeholder="نام">
                                            </section>

                                            <section class="col-6 mb-2">
                                                <label for="email" class="form-label mb-1">ایمیل
                                                </label>
                                                <input value="{{ auth()->user()->email ?? auth()->user()->email }}"
                                                       disabled type="text" name="email"
                                                       class="form-control form-control-sm"
                                                       id="email" placeholder="نام">
                                            </section>

                                    </section>

                                    <section class="modal-footer py-1">
                                        <button type="submit" class="btn btn-sm btn-primary">ویرایش
                                            حساب
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                                data-bs-dismiss="modal">بستن
                                        </button>
                                    </section>
                                    </form>

                                </section>
                            </section>
                        </section>


                    </section>
                </article>
            </div>
        </div>
    </div>




@endsection





