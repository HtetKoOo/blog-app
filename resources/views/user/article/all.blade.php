@extends('user.layouts.article_layout')
@section('content')
<div class="mt-4">
    <form action="" class="d-flex">
        <input placeholder="Search Blog..." type="text" name="title" class="form-control rounded bg-card">
        <input type="submit" value="Searchh" class="btn btn-primary rounded ml-2">
    </form>
</div>
<div class="mt-4 blog-list">
    <div class="row p-0 m-0">
        @foreach($data as $d)
        <a href="{{url('article/'.$d->id)}}" class="col-6 pl-0 mt-4">
            <div class="rounded bg-card">
                <div style="
                    position:relative;
                    width:100%;
                    height: 250px;
                    border-radius:20px;
                    overflow:hidden;
                    display:flex;
                    align-items:center;   /* vertical centering */
                    justify-content:center; /* optional: horizontal centering */
                    ">
                    <!-- blurred background -->
                    <div style="
                        background:url('{{$d->image_url}}') center center / cover no-repeat;
                        filter: blur(20px);
                        position:absolute;
                        top:0; left:0; right:0; bottom:0;
                        z-index:0;
                        ">
                    </div>

                    <!-- actual image -->
                    <img
                        src="{{$d->image_url}}"
                        alt="Article Image"
                        style="width:100%; height:100%; object-fit:contain; position:relative; z-index:1; display:block;">
                </div>
                <div class="p-3 text-white">
                    <h4 class="text-white">{{$d->title}}</h4>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-dark"><span class="text-success"><i
                                    class='bx bx-happy-heart-eyes'></i></span> :
                            {{$d->view_count}}</button>
                        <button class="btn btn-dark"><span class="text-success"><i
                                    class='bx bx-heart'></i></span> :
                            {{$d->like_count}}</button>
                        <button class="btn btn-dark"><span class="text-success"><i
                                    class='bx bx-message-square-dots'></i></span> :
                            {{$d->comment_count}}</button>
                    </div>
                </div>
            </div>
        </a>
        @endforeach

    </div>
    <div class="mt-4">
        <div class="d-flex justify-content-center">
            {{ $data->links() }}
        </div>

    </div>
</div>
@endsection