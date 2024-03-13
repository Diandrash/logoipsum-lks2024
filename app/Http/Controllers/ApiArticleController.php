<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Subscribe;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $articles = Article::all();
        $articles = Article::paginate(10);
        return response()->json([
            'status' => 'success',
            'data'=> $articles,
            'message' => 'All Articles'
        ]);
    }
    public function myindex(Request $request)
    {
        $userId = $request['userId'];
        $articles = Article::where('author_id', $userId)->get();   

        return response()->json([
            'status' => 'success',
            'data'=> $articles,
            'message' => 'All My Articles'
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request['keyword'];
        $articles = Article::where('title', 'LIKE', "%$keyword%")->get();
        return response()->json([
            "status"=> 200,
            "message"=> "Search Product Result",
            "data"=> $articles
        ]);

    }

    public function category(Request $request)
    {
        $categoryId = $request['categoryId'];
        $articles = Article::where('category_id', $categoryId)->get();
        return response()->json([
            "status"=> 200,
            "message"=> "Search Product Result",
            "data"=> $articles
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = Article::create([
            'author_id' => $request['author_id'],
            'category_id'=> $request['category_id'],
            'title'=> $request['title'],
            'text'=> $request['text'],
            'slug'=> $request['slug'],
            'image'=> $request['image'],
        ]);

        return response()->json([
            'status'=> 'success',
            'data'=> $article,
            'message'=> 'Article Created'
        ]);
    }
    public function categorycreate(Request $request)
    {
        $category = Category::create([
            'name'=> $request['name'],
        ]);

        return response()->json([
            'status'=> 'success',
            'data'=> $category,
            'message'=> 'category Created'
        ]);
    }

    public function subscribe(Request $request)
    {
        $subscribe = Subscribe::create([
            'user_id' => $request['user_id'],
            'article_id' => $request['article_id'],
            'author_id' => $request['author_id'],
        ]);

        return response()->json([
            'status'=> 'success',
            'data'=> $subscribe,
            'message'=> 'Subscribe Created'
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json([
            'status'=> 'success',
            'data'=> $article,
            'message'=> 'Article Details'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->update([
            'author_id' => $request['author_id'],
            'category_id'=> $request['category_id'],
            'title'=> $request['title'],
            'text'=> $request['text'],
            'slug'=> $request['slug'],
            'image'=> $request['image'],
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Article Updated',
            'data'=> $article,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            'message' => 'Article Deleted'
        ]);
    }


}


