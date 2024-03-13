@extends('layout.index')

@section('container')
<section class=" mx-5 my-5 rounded-md">
	<div class="container max-w-6xl p-6 mx-auto space-y-6 sm:space-y-12">
        <div class="headers-area flex justify-between">
            <h1 class="font-semibold text-base md:text-2xl ml-8">Manage All Articles</h1>
            <div class="right-area flex  flex-wrap gap-2 justify-center">
                <button class="px-2 md:px-5 py-1 md:py-2 font-semibold text-white bg-blue-600 hover:bg-blue-800 rounded-md" onclick="location.href='/myarticles/create'">Add Articles</button>
                <button class="px-2 md:px-5 py-1 md:py-2 font-semibold text-white bg-blue-600 hover:bg-blue-800 rounded-md" onclick="location.href='/subscribe'">Show Subscriber</button>
                @if (auth()->user()->is_admin == 1)
                    <button class="px-2 md:px-5 py-1 md:py-2 font-semibold text-white bg-blue-600 hover:bg-blue-800 rounded-md" onclick="location.href='/category/create'">Create Category</button>    
                @endif
            </div>
        </div>

		<div class="grid justify-center grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
            <a rel="noopener noreferrer" class="max-w-sm mx-auto bg-white rounded-md shadow-md group hover:no-underline focus:no-underline dark:bg-gray-900 w-[20rem]">
				<img role="presentation" class="object-cover w-full rounded h-44 dark:bg-gray-500" src="{{ asset('/articleimages/' . $article->image) }}">
				<div class="p-6">
					<h3 class="text-2xl font-semibold group-hover:underline group-focus:underline h-20 line-clamp-2">{{ $article->title }}</h3>
					<span class="text-xs dark:text-gray-400 line-clamp-3">{{ date_format($article->created_at, 'd F Y') }}</span>

                    <div class="action-area flex gap-3 mt-3">
                        <button class="p-2 rounded-md bg-emerald-600 hover:bg-emerald-700" onclick="location.href='/articles/{{ $article->slug }}/show'"><img src="/icons/eye.svg" class="w-6" alt=""></button>
                        <button class="p-2 rounded-md bg-yellow-400 hover:bg-yellow-500" onclick="location.href='/myarticles/{{ $article->slug }}/edit'"><img src="/icons/pencil.svg" class="w-6" alt=""></button>
                        <form action="/myarticles/{{ $article->slug }}/delete" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirm('Sure to Delete?')" type="submit" class="p-2 rounded-md bg-red-600 hover:bg-red-700" onclick="location.href=''"><img src="/icons/trash-solid.svg" class="w-5" alt=""></button>
                        </form>
                    </div>
				</div>
			</a>
            @endforeach


		</div>
		<div class="flex justify-center">
		</div>
	</div>
</section>
@endsection

