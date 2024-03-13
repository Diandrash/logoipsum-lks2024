@extends('layout.index')

@section('container')
    

<div class="relative overflow-x-auto mx-10 mt-10">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                   Date
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscriber as $subscribe)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $subscribe->user->name }}
                </th>
                <td class="px-6 py-4 text-center font-semibold">
                    {{ $subscribe->user->email }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ date_format($subscribe->created_at, 'd F Y') }}
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection