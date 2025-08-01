@extends('backend.layouts.app_plain')
@section('title', 'Admin Login')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6">
            <div class="card auth-form">
                <div class="card-body">
                    <h3 class="text-center">Admin Login</h3>
                    <p class="text-center text-muted">Fill the form to login</p>

                    <form method="POST" action="{{ url('/admin/login') }}">
                        {{-- Assuming the route for admin login is named 'admin.login' --}}
                        @csrf

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label for="">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button class="btn btn-dark btn-block mb-5">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
