@extends('layout.index')

@section('container')
    <section class="mx-10 pb-20">
        <h1 class="font-semibold text-2xl">Update Article</h1>

    <form action="/myarticles/{{ $article->id }}/edit" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="author_id" value="{{ auth()->user()->id }}" >


            <div class="input-area mt-5">
                <label for="title" class="font-semibold text-lg">Article Title</label><br>
                <input name="title" type="text" class="font-semibold mt-2 w-full text-lg h-16 pl-3 rounded-md" placeholder="Article Title Here" value="{{ old('title', $article->title) }}">
                @error('title')
                    <h1 class="mt-2 text-red-600">{{ $message }}</h1>
                @enderror
            </div>
            <div class="input-area mt-5">
                <label for="slug" class="text-lg">Article Slug</label><br>
                <input name="slug" type="text" class="font-semibold mt-2 w-full text-lg h-16 pl-3 rounded-md" placeholder="Article slug Here" value="{{ old('slug', $article->slug) }}">
                @error('slug')
                    <h1 class="mt-2 text-red-600">{{ $message }}</h1>
                @enderror
            </div>
            <div class="input-area mt-5">
                <label for="category_id" class="text-lg">Article Category</label><br>
                <select name="category_id" id="" class="font-semibold text-lg h-16 pl-3 mt-2 w-full">
                    <option value="" selected hidden class="font-semibold text-lg h-16 pl-3 mt-2 w-full">Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ old('category_id',  $category->id) }}" @if ($category->id == $article->category_id)
                            selected
                        @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-area mt-5">
                <label for="text" class="text-lg">Article Text</label><br>
                    <textarea name="text" id="" cols="30" rows="10" class="w-full font-semibold mt-2 text-lg p-1 rounded-md">
                        {{ old('text', $article->text) }}
                    </textarea>
                    @error('ext')
                        <h1 class="mt-2 text-red-600">{{ $message }}</h1>
                    @enderror
            </div>
            <div class="input-area mt-5">
                <label for="image" class="text-lg">Article Image</label><br>
                <img src="{{ asset('/articleimages/' . $article->image) }}" alt="" class="w-32">
                <label for="image" class="text-lg">Update Article Image</label><br>
                <input name="image" type="file" class="font-semibold mt-2 w-full text-2xl rounded-md bg-white">
                @error('image')
                    <h1 class="mt-2 text-red-600">{{ $message }}</h1>
                @enderror   
            </div>
            
            <button class="w-full py-3 font-semibold text-white rounded-md bg-blue-600 hover:bg-blue-800 text-lg mt-16">Update Now</button>
        </form>
    </section>
@endsection