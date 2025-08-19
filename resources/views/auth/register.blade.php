@extends('user.layouts.article_layout')
@section('content')
<div class="bg-dark p-3 mt-3 rounded">
    <form action="{{url('register')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="text-gray">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="email" class="text-gray">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password" class="text-gray">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection