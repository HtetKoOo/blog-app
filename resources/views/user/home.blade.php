@extends('user.layouts.app')

@section('content')
<div class="mt-4">
    <input placeholder="Search Blog..." type="text" class="form-control rounded bg-card mb-3">
</div>

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
        <div class="col-6">
            <div class="bg-dark rounded">
                <img src="{{$a->image_url}}"
                    class="w-100 rounded">
                <p class="text-white text-center p-2">{{$a->title}}</p>
            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection