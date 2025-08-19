@extends('user.layouts.article_layout')
@section('content')
<div id="root"></div>
@endsection

@section('scripts')
<script>
    
</script>
@viteReactRefresh
@vite(['resources/js/Profile.jsx'])
@endsection