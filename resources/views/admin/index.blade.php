@extends('admin.layouts.master')

@section('head-tag')
    <title>admin-panel</title>
@endsection


@section('content')
    <!-- // باکس ها -->
    <section class="row">
        <!--// هر باکس-->
        <section class="col-lg-3 col-md-6 col-sm-12">
            <a href="" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-yellow text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h3>{{$users}}</h3>
                                <p class="card_title">تعداد اعضای سایت</p>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </section>
                        </section>
                    </section>

                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i>
                        بروزرسانی شده در تاریخ {{now()}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-sm-12">
            <a href="" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-green text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h3>{{$adminUsers}}</h3>
                                <p class="card_title">تعداد ادمین های سایت</p>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </section>
                        </section>
                    </section>

                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i>
                        بروزرسانی شده در تاریخ {{now()}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-sm-12">
            <a href="" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-green text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h3>{{$normalUsers}}</h3>
                                <p class="card_title">تعداد اعضای عادی</p>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </section>
                        </section>
                    </section>

                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i>
                        بروزرسانی شده در تاریخ {{now()}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-sm-12">
            <a href="" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-light-green text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h3>{{$articles}}</h3>
                                <p class="card_title">تعداد مقالات سایت</p>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </section>
                        </section>
                    </section>

                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i>
                        بروزرسانی شده در تاریخ {{now()}}
                    </section>
                </section>
            </a>
        </section>

        <section class="col-lg-3 col-md-6 col-sm-12">
            <a href="" class="text-decoration-none d-block mb-4">
                <section class="card bg-danger text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h3>{{$news}}</h3>
                                <p class="card_title">تعداد اخبارسایت</p>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </section>
                        </section>
                    </section>

                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i>
                        بروزرسانی شده در تاریخ {{now()}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-sm-12">
            <a href="" class="text-decoration-none d-block mb-4">
                <section class="card bg-success text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h3>{{$articleCategories}}</h3>
                                <p class="card_title">تعداد دسته بندی های مقالات</p>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </section>
                        </section>
                    </section>

                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i>
                        بروزرسانی شده در تاریخ {{now()}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-sm-12">
            <a href="" class="text-decoration-none d-block mb-4">
                <section class="card bg-warning text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h3>{{$newsCategories}}</h3>
                                <p class="card_title">تعداد دسته بندی های اخبار</p>

                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </section>
                        </section>
                    </section>

                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i>
                        بروزرسانی شده در تاریخ {{now()}}
                    </section>
                </section>
            </a>
        </section>


        <section class="col-lg-3 col-md-6 col-sm-12">
            <a href="" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-green text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h3>{{$comments}}</h3>
                                <p class="card_title">تعداد کامنت های سایت</p>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </section>
                        </section>
                    </section>

                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i>
                        بروزرسانی شده در تاریخ {{now()}}
                    </section>
                </section>
            </a>
        </section>

    </section>
    <!--// بخش متن پایین باکس ها-->
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>بخش کاربران</h5>
                    <p>سیمتردسیمندرنسیدرنسیئرم/شثئرنبکثلرتشخسگبرتمشب
                        شرمندشسنمزدشنزدشمسنزدمشدزنشسدمزنسشدمزندشمسز</p>
                </section>
                <section class="body-content">
                    <p>متشسردمسنیدرمنسیدرنمسیدرنمسیدرنسد رکسیدرنکسدینردسنمیرد</p>
                    <p>متشسردمسنیدرمنسیدرنمسیدرنمسیدرنسد رکسیدرنکسدینردسنمیرد</p>
                    <p>متشسردمسنیدرمنسیدرنمسیدرنمسیدرنسد رکسیدرنکسدینردسنمیرد</p>
                </section>
            </section>
        </section>
    </section>
@endsection
