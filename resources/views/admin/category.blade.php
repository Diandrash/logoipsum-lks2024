@extends('layout.index')

@section('container')
    <section class="mx-10 pb-20">
        <h1 class="font-semibold text-2xl">Create New Category</h1>

        <form action="/category/create" method="post" enctype="multipart/form-data">
            @csrf

            <div class="input-area mt-5">
                <label for="name" class="font-semibold text-lg">Category name</label><br>
                <input name="name" type="text" class="font-semibold mt-2 w-full text-lg h-16 pl-3 rounded-md" placeholder="Category name Here" value="{{ old('name') }}">
                @error('name')
                    <h1 class="mt-2 text-red-600">{{ $message }}</h1>
                @enderror
            </div>
            
            <button class="w-full py-3 font-semibold text-white rounded-md bg-blue-600 hover:bg-blue-800 text-lg mt-16">Create Now</button>
        </form>
    </section>
@endsection