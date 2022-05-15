{{-- common.phpの継承 --}}
@extends('layouts.common')

{{-- ヘッダーの呼び出し --}}
@include('common.header')
{{-- サイドバーの呼び出し --}}
@include('common.sidebar')
{{-- メイン部分 --}}
@section('content')
<div class="px-8 py-8 mx-auto bg-white">
    <div class="flex items-center justify-between">
        <span class="text-sm font-light text-gray-600">
            最終更新日:{{ $post->updated_at }}
        </span>
    </div>
    <div class="mt-2">
        <p class="text-2xl font-bold text-gray-800">{{ $post->title }}</p>
        <p class="mt-8 text-gray-600">{{ $post->body }}</p>
    </div>
</div>
@endsection
{{-- フッターの呼び出し --}}
@include('common.footer')
