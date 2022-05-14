{{-- common.bladeの継承 --}}
@extends('layouts.common')

@include('user.parts.sidebar_user')
@section('content')
<div class="h-screen overflow-scroll">
    <div class="px-4 sm:px-4">
        <div class="flex justify-between">
            <div class="pt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md text-1xl font-midium hover:bg-blue-700
                    transition duration-300">新規追加
                </button>
            </div>
        </div>
        <div class="py-4">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800
                                    text-center text-sm uppercase font-normal">タイトル
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800
                                    text-center text-sm uppercase font-normal">投稿ID
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800
                                    text-center text-sm uppercase font-normal">カテゴリー
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800
                                    text-center text-sm uppercase font-normal">ステータス
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800
                                    text-center text-sm uppercase font-normal">日付
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800
                                    text-left text-sm uppercase font-normal">操作
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800
                                    text-center text-sm uppercase font-normal">PV数
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-gray-800
                                    text-center text-sm uppercase font-normal">お気に入り数
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-left text-gray-900 whitespace-nowrap">
                                        Laravel9ニュースサイト
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-left text-gray-900 whitespace-nowrap">
                                        215
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <span class="bg-green-500 rounded-full text-white px-3 py-1 text-xs uppercase font-medium">
                                        Category
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                        <span aria-hidden="true" class="absolute inset-0 bg-gray-200 opacity-50 rounded-full">
                                        </span>
                                        <span class="relative">
                                            公開済み
                                        </span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a class="text-center text-gray-900 whitespace-nowrap">
                                        2022-03-28 12:12:12
                                    </a>
                                </td>
                                <td class="px-5 py-5 mr-5 border-b border-gray-200 bg-white text-sm">
                                    <a class="mr-3 text-blue-700 whitespace-nowrap underline" href="#">
                                        Edit
                                    </a>
                                    <a class="ml-5 underline text-red-700 whitespace-nowrap" href="#">
                                        delete
                                    </a>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-nowrap">
                                        1,200
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-nowrap">
                                        55
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
