@extends('backend.layouts.app')
@section('title', 'Edit Singer')
@section('singer-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit Singer</div>
        </div>
    </div>
</div>

<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')

            <form action="{{ route('singer.update', $singer->id) }}" method="POST" id="update" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$singer->name)}}">
                </div>
                <div class="form-group">
                    <label for="">Choose gender</label>
                    <select name="gender" class="form-control" id="gender">
                        <option value="male" @if($singer->gender == "male")selected @endif>male</option>
                        <option value="female" @if($singer->gender == "female")selected @endif>female</option>
                        <option value="other" @if($singer->gender == "other")selected @endif>other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">Singer's Photo (only image file)</label>
                    <input type="file" name="photo" class="form-control-file">
                    @if($singer->photo_url)
                        <img src="{{ $singer->photo_url }}" alt="{{ $singer->name }}" width="100" height="100" style="object-fit:cover; border-radius:5px;">
                    @else
                        <p class="text-muted">No photo uploaded</p>
                    @endif
                </div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-secondary mr-2 back-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{--{!! JsValidator::formRequest('App\Http\Requests\UpdateUser', '#update') !!}--}}

<script>
    $(document).ready(function() {

    });
</script>
@endsection