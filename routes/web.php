<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
        'active' => 'home'
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active' => 'about',
        'name' => 'Achmad Syaiful Anand',
        'email' => 'achmadsyaifulanand@gmail.com',
        'phone' => '0895334351825',
        'img' => 'anand.jpg'
    ]);
});

Route::get('/blog', [PostController::class, 'index']);

Route::get('/blog/{post:slug}',[PostController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
  return view('dashboard.index', [
    'title' => 'Dashboard',
    'active' => 'dashboard'
  ]);
})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/posts' , DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/categories' , AdminCategoryController::class)->except('show');

// Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

// Route::get('/author/{user:username}', function (User $user){
//     return view('blog', [
//         'title' => "Author: $user->name",
//         // 'active' => 'author',
//         // eager lazi
//         'posts' => $user->posts->load('author', 'category')
//     ]);
// });
