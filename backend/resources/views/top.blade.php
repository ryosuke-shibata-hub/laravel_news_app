{{-- layouts.common.blade.phpの継承 --}}
@extends('layouts.common')

{{-- ヘッダーの呼び出し --}}
@include('common.header')
{{-- メイン部分 --}}
{{-- サイドバーの呼び出し --}}
@include('common.sidebar')
@section('content')
<section class="h-full bg-gray-50 text-gray-600 body-font">
    <div class="px-3 py-3 mx-auto">
        <div class="flex flex-wrap">
            <div class="p-2 flex flex-col items-start">
                <div class="flex">
                    <span class="bg-green-500 rounded-full text-white px-3 py-1 text-xs uppercase font-medium">
                        Category
                    </span>
                    <span class="ml-5 text-gray-600">投稿日時：</span>
                    <span class="text-gray-600">2022-05-14 15:15:15</span>
                    <span class="ml-5 text-gray-600">投稿者：</span>
                    <span class="text-blue-500">
                        <a class="underline" href="#">@lalala</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- 降ったの呼び出し --}}
@include('common.footer')
