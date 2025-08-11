@extends('backend.layouts.app')
@section('title', 'Add Music Video')
@section('mv-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Add Music Video</div>
        </div>
    </div>
</div>

<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')

            <form action="{{url('admin/music-video')}}" method="POST" id="create" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Music Video Name</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Enter music video name">
                </div>
                <div class="form-group">
                    <label for="">Choose Singer</label>
                    <select name="singer[]" class="form-control" id="singer" multiple>
                        @foreach($singers as $singer)
                        <option value="{{$singer->id}}">{{$singer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Choose Music Genre</label>
                    <select name="mg[]" class="form-control" id="mg" multiple>
                        @foreach($mgs as $mg)
                        <option value="{{$mg->id}}">{{$mg->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Music mp3 file</label>
                    <input type="file" name="music" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Music Video Link</label>
                    <input type="text" name="video_link" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Music Video Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Deleted</option>
                    </select>
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

    $('#singer,#mg').select2();
</script>

@endsection