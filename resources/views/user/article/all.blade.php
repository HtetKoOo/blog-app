@extends('user.layouts.app')
@section('content')
<div class="mt-4">
    <form action="" class="d-flex">
        <input placeholder="Search Blog..." type="text" name="title" class="form-control rounded bg-card">
        <input type="submit" value="Search" class="btn btn-primary rounded ml-2">
    </form>
</div>
<div class="mt-4 blog-list">
    <div class="row p-0 m-0">
        @foreach($data as $d)
        <a href="{{url('article/'.$d->id)}}" class="col-6  pl-0 mt-4">
            <div class="rounded bg-card">
                <img class="rounded" src="{{asset('images/'.$d->image)}}" style="width:100%" alt="">
                <div class="p-4 text-white">
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