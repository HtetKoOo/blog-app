@extends('backend.layouts.app')
@section('title', 'Create Ads')
@section('ads-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Create Ads</div>
        </div>
    </div>
</div>

<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')

            <form action="{{url('admin/ads')}}" method="POST" id="create" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Enter ads title">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Image (only choose image file)</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Link</label>
                    <input type="text" name="link" class="form-control" value="{{old('link')}}" placeholder="Enter ads link">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{old('start_date')}}">
                </div>
                <div class="form-group">
                    <label for="">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{old('end_date')}}">
                </div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-secondary mr-2 back-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {

    });
</script>

@endsection