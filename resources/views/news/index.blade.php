@extends('layout.index')

@section('container')
<section class=" mx-5 my-5 rounded-md">
	<div class="container max-w-6xl p-6 mx-auto space-y-6 sm:space-y-12">
        <div class="hero-section bg-white">
            <a rel="noopener noreferrer" href="#" class="block max-w-sm gap-3 mx-auto sm:max-w-full group hover:no-underline focus:no-underline lg:grid lg:grid-cols-12 dark:bg-gray-900">
                <img src="{{ asset('/articleimages/' . $single->image) }}" alt="" class="object-cover w-[50rem] h-64 rounded sm:h-96 lg:col-span-7 dark:bg-gray-500">
                <div class="p-6 space-y-2 lg:col-span-5">
                    <div class="profile-area flex mb-4">
                        <img src="/img/profile.png" class="w-12" alt="">
                        <div class="text-area ml-3">
                            <h1 class="font-semibold text-black text-base">{{ $single->author->name }}</h1>
                            <h1 class="font-semibold text-black text-sm opacity-55">{{ date_format($single->created_at, 'D F Y') }}</h1>
                        </div>
                    </div>
                    <h3 class="text-2xl font-semibold sm:text-4xl group-hover:underline group-focus:underline">{{ $single->title }}</h3>
                    <p class="line-clamp-3 h-32">{{ $single->text }}.</p>

                    <button onclick="location.href='/articles/{{ $single->slug }}/show'" class="px-10 py-3 font-semibold bg-blue-800 hover:bg-blue-700 rounded-md text-white mt-10">Read More</button>
                </div>
            </a>
        </div>

        <h1 class="font-semibold text-2xl">All Articles</h1>
        <div class="header-area flex justify-between">
            <form action="/articles/category" method="post">
                @csrf
                <select onchange="this.form.submit()" name="category" id="" class="font-semibold text-base h-10 w-[10rem] bg-transparent">
                    <option value="" selected hidden class="font-semibold text-base pl-3 mt-2 w-full">Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ old('category_id',  $category->id) }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </form>
            <form action="/articles/search" method="post">
                @csrf
                <input type="text" name="search" class="bg-white rounded-md h-10 w-[15rem] pl-3" placeholder="Search here">
            </form>
        </div>

		<div class="grid justify-center grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
            <a rel="noopener noreferrer" href="/articles/{{ $article->slug }}/show" class="w-[20rem] max-w-sm mx-auto group hover:no-underline focus:no-underline dark:bg-gray-900 bg-white hover:bg-slate-200 rounded-md">
				<img role="presentation" class="object-cover w-full rounded h-44 dark:bg-gray-500" src="{{ asset('/articleimages/' . $article->image) }}" onclick="location.href=''">
				<div class="p-6">
					<h3 class="text-2xl h-20 line-clamp-2 font-semibold group-hover:underline group-focus:underline">{{ $article->title }}</h3>
					<span class="text-xs dark:text-gray-400 line-clamp-3">{{ date_format($article->created_at, 'd F Y') }}</span>
					<p class="line-clamp-2">{{ $article->text }}</p>
				</div>
			</a>
            @endforeach

            {{-- @foreach ($paginates as $paginate)
                <a href="{{ $paginate['url']}}">Show</a>
            @endforeach --}}
            {{-- {{ $paginate->links('pagination::tailwind') }} --}}
            

		</div>
	</div>
</section>
@endsection