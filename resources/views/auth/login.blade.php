@extends('user.layouts.article_layout')
@section('content')
<div class="bg-card p-3 mt-3 rounded">
    <form action="{{url('login')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email" class="text-gray">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password" class="text-gray">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection