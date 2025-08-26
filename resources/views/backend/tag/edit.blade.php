@extends('backend.layouts.app')
@section('title', 'Edit Tag')
@section('tag-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit Tag</div>
        </div>
    </div>
</div>

<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')

            <form action="{{ route('tag.update', $tag->id) }}" method="POST" id="update">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$tag->name)}}">
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