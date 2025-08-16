@extends('user.layouts.app')
@section('content')
<div id="root"></div>
@endsection

@section('scripts')
<script>
    
</script>
@viteReactRefresh
@vite(['resources/js/Profile.jsx'])
@endsection