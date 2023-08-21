<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Content\ArticleCategoryController;
use App\Http\Controllers\Admin\Content\ArticleController;
use App\Http\Controllers\Admin\Content\CommentController;
use App\Http\Controllers\Admin\Content\NewsCategoryController;
use App\Http\Controllers\Admin\Content\NewsController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Front\ArticleController as FrontArticleController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\NewsController as FrontNewsController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//admin
Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified','active'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');

    //content
    Route::prefix('content')->group(function () {
        //article categories
        Route::controller(ArticleCategoryController::class)->prefix('article-categories')->group(function () {
            Route::get('/', 'index')->name('admin.content.article-category.index');
            Route::get('/create', 'create')->name('admin.content.article-category.create');
            Route::post('/store', 'store')->name('admin.content.article-category.store');
            Route::get('/edit/{articleCategory}', 'edit')->name('admin.content.article-category.edit');
            Route::get('/status/{articleCategory}', 'status')->name('admin.content.article-category.status');
            Route::put('/update/{articleCategory}', 'update')->name('admin.content.article-category.update');
            Route::delete('/destroy/{articleCategory}', 'destroy')->name('admin.content.article-category.destroy');
        });

        //article
        Route::controller(ArticleController::class)->prefix('articles')->group(function () {
            Route::get('/', 'index')->name('admin.content.article.index');
            Route::get('/create', 'create')->name('admin.content.article.create');
            Route::post('/store', 'store')->name('admin.content.article.store');
            Route::get('/edit/{article}', 'edit')->name('admin.content.article.edit');
            Route::get('/status/{article}', 'status')->name('admin.content.article.status');
            Route::get('/commentable/{article}', 'commentable')->name('admin.content.article.commentable');
            Route::put('/update/{article}', 'update')->name('admin.content.article.update');
            Route::delete('/destroy/{article}', 'destroy')->name('admin.content.article.destroy');
        });

        //comment
        Route::controller(CommentController::class)->prefix('comments')->group(function () {
            Route::get('/', 'index')->name('admin.content.comment.index');
            Route::get('/show/{comment}', 'show')->name('admin.content.comment.show');
            Route::delete('/destroy/{comment}', 'destroy')->name('admin.content.comment.destroy');
            Route::get('/status/{comment}', 'status')->name('admin.content.comment.status');
            Route::get('/approved/{comment}', 'approved')->name('admin.content.comment.approved');
            Route::post('/answer/{comment}', 'answer')->name('admin.content.comment.answer');
        });

        //news categories
        Route::controller(NewsCategoryController::class)->prefix('news-categories')->group(function () {
            Route::get('/', 'index')->name('admin.content.news-category.index');
            Route::get('/create', 'create')->name('admin.content.news-category.create');
            Route::post('/store', 'store')->name('admin.content.news-category.store');
            Route::get('/edit/{newsCategory}', 'edit')->name('admin.content.news-category.edit');
            Route::get('/status/{newsCategory}', 'status')->name('admin.content.news-category.status');
            Route::put('/update/{newsCategory}', 'update')->name('admin.content.news-category.update');
            Route::delete('/destroy/{newsCategory}', 'destroy')->name('admin.content.news-category.destroy');
        });

        //news
        Route::controller(NewsController::class)->prefix('news')->group(function () {
            Route::get('/', 'index')->name('admin.content.news.index');
            Route::get('/create', 'create')->name('admin.content.news.create');
            Route::post('/store', 'store')->name('admin.content.news.store');
            Route::get('/edit/{news}', 'edit')->name('admin.content.news.edit');
            Route::get('/status/{news}', 'status')->name('admin.content.news.status');
            Route::get('/commentable/{news}', 'commentable')->name('admin.content.news.commentable');
            Route::put('/update/{news}', 'update')->name('admin.content.news.update');
            Route::delete('/destroy/{news}', 'destroy')->name('admin.content.news.destroy');
        });
    });

    Route::prefix('user')->group(function () {

        //admin-user
        Route::controller(AdminUserController::class)->prefix('admin-user')->group(function () {
            Route::get('/', 'index')->name('admin.user.admin-user.index');
            Route::get('/create', 'create')->name('admin.user.admin-user.create');
            Route::post('/store', 'store')->name('admin.user.admin-user.store');
            Route::get('/edit/{user}', 'edit')->name('admin.user.admin-user.edit');
            Route::put('/update/{user}', 'update')->name('admin.user.admin-user.update');
            Route::delete('/destroy/{user}', 'destroy')->name('admin.user.admin-user.destroy');
            Route::get('/activation/{user}', 'activation')->name('admin.user.admin-user.activation');
            Route::get('/roles/{admin}', 'roles')->name('admin.user.admin-user.roles');
            Route::post('/roles/{admin}/store', 'rolesStore')->name('admin.user.admin-user.roles.store');
            Route::get('/permissions/{admin}', 'permissions')->name('admin.user.admin-user.permissions');
            Route::post('/permissions/{admin}/store', 'permissionsStore')->name('admin.user.admin-user.permissions.store');
        });
        //users
        Route::controller(UserController::class)->prefix('users')->group(function () {
            Route::get('/', 'index')->name('admin.user.users.index');
            Route::get('/create', 'create')->name('admin.user.users.create');
            Route::post('/store', 'store')->name('admin.user.users.store');
            Route::get('/edit/{user}', 'edit')->name('admin.user.users.edit');
            Route::put('/update/{user}', 'update')->name('admin.user.users.update');
            Route::delete('/destroy/{user}', 'destroy')->name('admin.user.users.destroy');
            Route::get('/activation/{user}', 'activation')->name('admin.user.users.activation');
        });

        //role
        Route::controller(RoleController::class)->prefix('role')->group(function () {
            Route::get('/', 'index')->name('admin.user.role.index');
            Route::get('/create', 'create')->name('admin.user.role.create');
            Route::post('/store', 'store')->name('admin.user.role.store');
            Route::get('/edit/{role}', 'edit')->name('admin.user.role.edit');
            Route::put('/update/{role}', 'update')->name('admin.user.role.update');
            Route::delete('/destroy/{role}', 'destroy')->name('admin.user.role.destroy');
            Route::get('/permission-form/{role}', 'permissionForm')->name('admin.user.role.permission-form');
            Route::put('/permission-update/{role}', 'permissionUpdate')->name('admin.user.role.permission-update');
        });


        //permission
        Route::controller(PermissionController::class)->prefix('permission')->group(function () {
            Route::get('/', 'index')->name('admin.user.permission.index');
            Route::get('/create', 'create')->name('admin.user.permission.create');
            Route::post('/store', 'store')->name('admin.user.permission.store');
            Route::get('/edit/{permission}', 'edit')->name('admin.user.permission.edit');
            Route::put('/update/{permission}', 'update')->name('admin.user.permission.update');
            Route::delete('/destroy/{permission}', 'destroy')->name('admin.user.permission.destroy');
        });
    });
});


//front
Route::get('/', [HomeController::class, 'home'])->name('front.home');


//profile
Route::controller(ProfileController::class)->prefix('profile')->group(function () {
    Route::get('/', 'index')->name('front.profile');
    Route::put('/update', 'update')->name('front.profile.update');
});


//article
Route::controller(FrontArticleController::class)->prefix('article')->group(function () {
    Route::get('/all-articles/{articleCategory?}', 'index')->name('front.all-articles');
    Route::get('/{article}', 'show')->name('front.show-article');
    Route::post('/add-comment/{article}', 'addComment')->name('front.article.add-comment');
    Route::post('/{article}/add-replay/{comment}', 'addReplay')->name('front.article.add-replay');
});


//news
Route::controller(FrontNewsController::class)->prefix('news')->group(function () {
    Route::get('/all-news/{newsCategory?}', 'index')->name('front.all-news');
    Route::get('/{news}', 'show')->name('front.show-news');
    Route::post('/add-comment/{news}', 'addComment')->name('front.news.add-comment');
    Route::post('/{news}/add-replay/{comment}', 'addReplay')->name('front.news.add-replay');
});

