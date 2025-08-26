@extends('user.layouts.article_layout')

@section('content')
<!-- Ads Carousel -->
<div id="adsCarousel" class="carousel slide" data-ride="carousel">
    <h4>Ads</h4>
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach($ads as $index => $ad)
        <li data-target="#adsCarousel" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>

    <!-- Carousel Items -->
    <div class="carousel-inner">
        @foreach($ads as $index => $ad)
        <div class="carousel-item {{ $index == 1 ? 'active' : '' }}">
            <img src="{{ $ad->image_url }}" class="d-block w-30 mx-auto rounded" alt="{{ $ad->title }}" style="max-width:60%; height: 300px; object-fit: cover;">

        </div>
        @endforeach
    </div>

    <!-- Controls -->
    <a class="carousel-control-prev" href="" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="mt-4 blog-list">
    <div class="row p-0 m-0">
        @foreach($trendingArticles as $a)
        <a href="{{url('article/'.$a->id)}}" class="col-6">
            <div class="bg-dark rounded">
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
                        background:url('{{$a->image_url}}') center center / cover no-repeat;
                        filter: blur(20px);
                        position:absolute;
                        top:0; left:0; right:0; bottom:0;
                        z-index:0;
                        ">
                    </div>

                    <!-- actual image -->
                    <img
                        src="{{$a->image_url}}"
                        alt="Article Image"
                        style="width:100%; height:100%; object-fit:contain; position:relative; z-index:1; display:block;">
                </div>
                <p class="text-white text-center p-2">{{$a->title}}</p>
            </div>
        </a>
        @endforeach

    </div>
</div>
@endsection