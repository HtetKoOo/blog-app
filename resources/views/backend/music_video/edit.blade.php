@extends('backend.layouts.app')
@section('title', 'Edit Music Video')
@section('mv-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit Music Video</div>
        </div>
    </div>
</div>

<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')

            <form action="{{ route('music-video.update', $mv->id) }}" method="POST" id="update" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Music Video Name</label>
                    <input type="text" name="title" class="form-control" value="{{old('title',$mv->title)}}">
                </div>
                <div class="form-group">
                    <label for="">Choose Singer</label>
                    <select name="singer[]" class="form-control" id="singer" multiple>
                        @foreach($singers as $singer)
                        <option value="{{$singer->id}}"
                            @foreach($mv->singer as $s)
                            @if($s->id == $singer->id)
                            selected
                            @endif
                            @endforeach>{{$singer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Choose Music Genre</label>
                    <select name="mg[]" class="form-control" id="mg" multiple>
                        @foreach($mgs as $mg)
                        <option value="{{$mg->id}}"
                            @foreach($mv->genre as $g)
                            @if($g->id == $mg->id)
                            selected
                            @endif
                            @endforeach>{{$mg->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Music mp3 file</label>
                    <input type="file" name="music" class="form-control-file">
                    @if ($mv->music_url)
                    <audio controls style="width: 200px;">
                        <source src="{{ $mv->music_url }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    @else
                    -
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Music Video Link</label>
                    <input type="text" name="video_link" class="form-control" value="{{old('video_link',$mv->video_link)}}">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" class="form-control">{{old('description',$mv->description)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Music Video Photo</label>
                    <input type="file" name="photo" class="form-control-file">
                    @if($mv->thumbnail_url)
                    <img src="{{ $mv->thumbnail_url }}" alt="Music Video photo" class="img-thumbnail mt-2" style="max-width: 200px;">
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
    $('#singer,#mg').select2();
</script>
@endsection