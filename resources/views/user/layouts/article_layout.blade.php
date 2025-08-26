@extends('user.layouts.app')

@section('article')
<div class="row">
    <div class="col-8">
        @yield('content')
    </div>
    @include('user.article.side')
</div>
@endsection