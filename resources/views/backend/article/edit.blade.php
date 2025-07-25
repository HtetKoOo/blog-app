@extends('backend.layouts.app')
@section('title', 'Edit User')
@section('article-active', 'mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit Article</div>
        </div>
    </div>
</div>

<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')

            <form action="{{ route('article.update', $article->id) }}" method="POST" id="update">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Choose tags</label>
                    <select name="tag[]" class="form-control" id="tag" multiple>
                        @foreach($tags as $tag)
                        <option value="{{$tag->id}}"
                            @foreach($article->tag as $t)
                            @if($t->id == $tag->id)
                            selected
                            @endif
                            @endforeach
                            >{{$tag->name}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Choose programmings</label>
                    <select name="programming[]" class="form-control" id="programming" multiple>
                        @foreach($programmings as $programming)
                        <option value="{{$programming->id}}"
                            @foreach($article->programming as $p)
                            @if($p->id == $programming->id)
                            selected
                            @endif
                            @endforeach
                            >{{$programming->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" value="{{$article->title}}">
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($article->image)
                    <img src="{{ asset('images/' . $article->image) }}" alt="Article Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" class="form-control">{{$article->description}}</textarea>
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
    $('#tag,#programming').select2();
</script>
@endsection