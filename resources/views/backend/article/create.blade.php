@extends('backend.layouts.app')
@section('title', 'Create Article')
@section('article-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Create Article</div>
        </div>
    </div>
</div>

<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')

            <form action="{{url('admin/article')}}" method="POST" id="create" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Choose tags</label>
                    <select name="tag[]" class="form-control" id="tag" multiple>
                        @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Choose programmings</label>
                    <select name="programming[]" class="form-control" id="programming" multiple>
                        @foreach($programmings as $programming)
                        <option value="{{$programming->id}}">{{$programming->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Enter article title">
                </div>
                <div class="form-group">
                    <label for="">Image (only choose image file)</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
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
    
    $('#tag,#programming').select2();
</script>
@endsection