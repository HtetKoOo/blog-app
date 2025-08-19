@extends('user.layouts.app')

@section('article')
<div class="row">
    <div class="col-8">
        <h2 class="text-primary bg-card p-2 pl-5 text-center rounded">Did You Know?
            <span class="text-success">(Random Access Facts)</span>
        </h2>
        @yield('content')
    </div>
    @include('user.article.side')
</div>
@endsection