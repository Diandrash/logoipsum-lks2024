<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/articles', [ApiArticleController::class,'index']);
Route::get('/articles/{article:slug}/show', [ApiArticleController::class,'show']);
Route::post('/articles/search', [ApiArticleController::class,'search']);
Route::post('/articles/category', [ApiArticleController::class,'category']);

Route::post('/myarticles', [ApiArticleController::class,'myindex']);
Route::post('/myarticles/create', [ApiArticleController::class,'store']);
Route::post('/myarticles/{article:slug}/delete', [ApiArticleController::class,'destroy']);
Route::put('/myarticles/{article:slug}/edit', [ApiArticleController::class,'update']);

Route::post('/subscribe/create', [ApiArticleController::class,'subscribe']);
Route::post('/category/create', [ApiArticleController::class,'categorycreate']);








