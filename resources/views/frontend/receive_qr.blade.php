@extends('frontend.layouts.app')
@section('title', 'Receive QR')
@section('content')
<div class="receive-qr">
    <div class="card my-card">
        <div class="card-body">
            <p class="text-center mb-0">QR Scan to pay me</p>
            <div class="text-center">
                {!! QrCode::size(250)->generate($authUser->phone) !!}
            </div>
            <p class="text-center mb-1"><strong>{{$authUser->name}}</strong></p>
            <p class="text-center mb-1">{{$authUser->phone}}</p>
        </div>
    </div>
</div>
@endsection