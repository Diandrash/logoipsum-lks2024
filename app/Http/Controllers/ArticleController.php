<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Subscribe;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "http://localhost:8001/api/articles";
        $response = $client->request("GET", $url);
        $articleJson = $response->getBody()->getContents();
        // dd($articleJson);
        $articleArray = json_decode($articleJson, true)['data'];
        $collections = $articleArray['data'];
        $paginate = $articleArray['links'];
        // dd($paginate);
        // dd($articleArray['data']);
        $articles = collect($collections)->map(function ($articledata) {
            return Article::updateOrCreate(['id' => $articledata['id']], $articledata);
        });
        http://localhost:8000/articles

        $categories = Category::all();
        $singlearticle = Article::latest()->take(1)->first();
    return view('news.index', [
            'articles' => $articles,
            // 'paginates' => $paginates,
            'single' => $singlearticle,
            'categories' => $categories,
        ]);
    }
    public function search(Request $request)
    {
        $client = new Client();
        $url = "http://localhost:8001/api/articles/search";
        $parameter = [
            $keyword = $request['search'],
        ];
        $response = $client->request('POST', $url, [
            'headers' => ['Content-Type'=>'application/json'],
            'json' => [
                'keyword' => $keyword,
            ],
        ]);
        $jsonArticles = $response->getBody()->getContents();
        $articleArray = json_decode($jsonArticles, true)['data'];
        // Membuat koleksi artikel dari data yang diterima
        $articles = collect($articleArray)->map(function ($articleData) {
            // Mencoba mencari artikel berdasarkan id, dan kemudian memperbarui atau membuat artikel
            return Article::updateOrCreate(['id' => $articleData['id']], $articleData);
        });
        $categories = Category::all();
        $singlearticle = Article::latest()->take(1)->first();
        return view('news.index', [
            'title' => $keyword . 'Search',
            'categories' => $categories,
            'articles' => $articles,
            'single' => $singlearticle,
        ]);
    }

    public function category(Request $request)
    {
        $client = new Client();
        $url = 'http://localhost:8001/api/articles/category';
        $response = $client->request('POST', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'categoryId' => $request['category']
            ]
            ]);
        $jsonArticles = $response->getBody()->getContents();
        $articleArray = json_decode($jsonArticles, true)['data'];
        // dd($articleArray);
        // Membuat koleksi artikel dari data yang diterima
        $articles = collect($articleArray)->map(function ($articleData) {
            // Mencoba mencari artikel berdasarkan id, dan kemudian memperbarui atau membuat artikel
            return Article::updateOrCreate(['id' => $articleData['id']], $articleData);
        });
        $categories = Category::all();
        $singlearticle = Article::latest()->take(1)->first();
        // dd($articles);
        return view('news.index', [
            'title' => 'Category Search',
            'categories' => $categories,
            'articles' => $articles,
            'single'=> $singlearticle,
        ]);
    }

    public function myindex()
    {

        $userId = auth()->user()->id;
        $client = new Client();
        $url = "http://localhost:8001/api/myarticles";
        $response = $client->request("POST", $url, [
            'headers' => ['Application-Type'=>'application/json'],
            'json' => [
                'userId' => json_encode($userId)
            ]
        ]);
        $articleJson = $response->getBody()->getContents();
        $articleArray = json_decode($articleJson, true)['data'];
        $articles = collect($articleArray)->map(function ($articledata) {
            return Article::updateOrCreate(['id' => $articledata['id']], $articledata);
        });

        // dd($articles);
        return view('news.myindex', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('news.create', [
            'categories'=> $categories
        ]);
    }
    public function createcategory()
    {
        return view('admin.category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'author_id' => 'required',
            'category_id' => 'required',
            'title' => 'required|min:3|max:300',
            'slug' => 'required|min:3|max:300',
            'text' => 'required|min:3|max:3048',
            'image' => 'required|mimes:jpg,jpeg,png,heic,webp',
        ]);


            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move('articleimages', $filename);

        $parameter = [
            'author_id'=> $request['author_id'],
            'category_id'=> $request['category_id'],
            'title' => $request['title'],
            'slug' => $request['slug'],
            'image'=> $filename,
            'text'=> $request['text'],
        ];
        $client = new Client();
        $url = "http://localhost:8001/api/myarticles/create";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-Type'=>'application/json'],
            'body' => json_encode($parameter) 
        ]);

        Alert::success('Success', 'Article Created');
        return redirect()->intended('/myarticles');
    }
    public function subscribe(Request $request)
    {


        $parameter = [
            'author_id'=> $request['author_id'],
            'user_id'=> $request['user_id'],
            'article_id'=> $request['article_id'],
        ];
        $client = new Client();
        $url = "http://localhost:8001/api/subscribe/create";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-Type'=>'application/json'],
            'body' => json_encode($parameter) 
        ]);

        Alert::success('Success', 'Subscribe Success');
        return redirect()->intended('/home');
    }
    public function categorycreate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:300|unique:categories',
        ]);

        $parameter = [
            'name' => $request['name'],
        ];
        $client = new Client();
        $url = "http://localhost:8001/api/category/create";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-Type'=>'application/json'],
            'body' => json_encode($parameter) 
        ]);

        Alert::success('Success', 'Category Created');
        return redirect()->intended('/myarticles');
    }
    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $client = new Client();
        $slug = $article->slug;
        $url = "http://localhost:8001/api/articles/$slug/show";
        $response = $client->request("GET", $url);
        $articleJson = $response->getBody()->getContents();
        $articleArray = json_decode($articleJson, true)['data'];
        // dd($articleArray);
        $articleCollection = collect($articleArray);
        $articleModel = new Article();
        $articlemodel = Article::find($articleArray['id']);
        
        $articlerelated = Article::where('category_id', $article->category_id)->whereNotIn('id', [$article->id])->get();

        return view('news.show', [
            'article' => $article,
            'articlerelated'=> $articlerelated,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {

        return view('news.edit', [
            'article' => $article,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validatedData = $request->validate([
            'author_id' => 'required',
            'category_id' => 'required',
            'title' => 'required|min:3|max:300',
            'slug' => 'required|min:3|max:300',
            'text' => 'required|min:3|max:3048',
            'image' => 'mimes:jpg,jpeg,png,heic,webp',
        ]);

        $filename = $article->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move('articleimages', $filename);
        }

        $parameter = [
            '_method' => 'PUT',
            'author_id'=> $request['author_id'],
            'category_id'=> $request['category_id'],
            'title' => $request['title'],
            'slug' => $request['slug'],
            'image'=> $filename,
            'text'=> $request['text'],
        ];
        $client = new Client();
        $articleId = $article->id;
        $slug = $article->slug;
        $url = "http://localhost:8001/api/myarticles/$slug/edit";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-Type'=>'application/json'],
            'body' => json_encode($parameter) 
        ]);

        Alert::success('Success', 'Article Updated');
        return redirect()->intended('/myarticles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $parameter = [
            '_method' => 'DELETE'
        ];
        $client = new Client();
        $articleId = $article->id;
        $slug = $article->slug;
        $url = "http://localhost:8001/api/myarticles/$slug/delete";
        $response = $client->request("POST", $url, [
            'headers' => ['Application-Type'=>'application/json'],
            'body' => json_encode($parameter)
        ]);

        Alert::success('Success', 'Article Deleted');
        return redirect()->intended('/myarticles');
    }

    public function indexsubscribe(Request $request)
    {
        $subscriber = Subscribe::where('author_id', auth()->user()->id)->get();
        return view('subscribe.index', [
            'subscriber'=> $subscriber
        ]);
    }
}
