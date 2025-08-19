@extends('user.layouts.article_layout')
@section('content')
<div id="root"></div>
@endsection

@section('scripts')
<script>
    const bladeArticleDetail = @json($data);
    const bladeIsAuth = @json(auth()->check());
</script>
@viteReactRefresh
@vite(['resources/js/ArticleDetail.jsx'])
@endsection