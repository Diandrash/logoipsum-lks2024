@extends('layout.index')


@section('container')
    <section class="mx-10 pb-20 pt-4">
        <img src="{{ asset('/articleimages/' . $article->image) }}" alt="" class="w-[80rem] h-[20rem] object-cover">
        <div class="flex justify-between">
            <h1 class="font-semibold mt-5">Author : {{ $article->author->name }}</h1> <br>
            @auth
            <form action="/subscribe/create" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="author_id" value="{{ $article->author->id }}">
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <button type="submit" class="px-10 py-2 font-semibold text-white rounded-md bg-blue-600 hover:bg-blue-700 text-sm self-center mt-5">Subscribe</button>
            </form>
            @endauth
        </div>
        <h1 class="font-semibold opacity-70">Created At : {{ date_format($article->created_at, 'd F Y') }}</h1>
        
        <h1 class="font-bold text-3xl w-[40rem] mt-2">{{ $article->title }}</h1>

        <p class="text-justify mt-8">
            {{ $article->text }}
        </p>


        <div class="related-article mt-20">
            <h1 class="font-semibold text-lg mb-10">Related Article</h1>
            <div class="grid justify-center grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($articlerelated as $article)
                <a rel="noopener noreferrer" href="/articles/{{ $article->slug }}/show" class="w-[20rem] max-w-sm mx-auto group hover:no-underline focus:no-underline dark:bg-gray-900">
                    <img role="presentation" class="object-cover w-full rounded h-44 dark:bg-gray-500" src="{{ asset('/articleimages/' . $article->image) }}" onclick="location.href=''">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold group-hover:underline group-focus:underline">{{ $article->title }}</h3>
                        <span class="text-xs dark:text-gray-400 line-clamp-3">{{ date_format($article->created_at, 'd F Y') }}</span>
                        <p class="line-clamp-2">{{ $article->text }}</p>
                    </div>
                </a>
                @endforeach
    
    
            </div>
        </div>
    </section>
@endsection