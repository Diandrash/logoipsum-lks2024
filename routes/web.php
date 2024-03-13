<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleController;

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

Route::get('/', function () {
    return redirect()->intended('/articles');
});
Route::get('/home', function () {
    return redirect()->intended('/articles');
});


Route::get('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/login', [LoginController::class, 'auth']);
Route::get('/register', [LoginController::class, 'register']);
Route::post('/register', [LoginController::class, 'store']);

Route::get('/articles', [ArticleController::class,'index']);
Route::get('/articles/{article:slug}/show', [ArticleController::class,'show']);

Route::get('/myarticles', [ArticleController::class,'myindex']);
Route::post('/articles/search', [ArticleController::class,'search']);
Route::post('/articles/category', [ArticleController::class,'category']);
Route::get('/myarticles/create', [ArticleController::class,'create']);
Route::post('/myarticles/create', [ArticleController::class,'store']);
Route::delete('/myarticles/{article:slug}/delete', [ArticleController::class,'destroy']);
Route::get('/myarticles/{article:slug}/edit', [ArticleController::class,'edit']);
Route::put('/myarticles/{article}/edit', [ArticleController::class,'update']);




Route::post('/subscribe/create', [ArticleController::class,'subscribe']);
Route::get('/subscribe', [ArticleController::class,'indexsubscribe']);



Route::get('/category/create', [ArticleController::class,'createcategory']);
Route::post('/category/create', [ArticleController::class,'categorycreate']);