<div class="col-4">

    <div class="bg-card p-3">
        <a href="{{url('')}}" class="btn btn-primary my-2"><i class="fa fas-home"></i>Home</a>
        <a href="{{url('article')}}" class="btn btn-primary my-2">All Articles</a>
        @guest
        <a href="{{url('login')}}" class="btn btn-primary my-2">User Login</a>
        <a href="{{url('register')}}" class="btn btn-primary my-2">User Register</a>
        <a href="{{url('admin')}}" class="btn btn-primary my-2">Admin Login</a>
        @endguest
        @auth
        <a href="{{url('profile')}}" class="btn btn-primary my-2">Profile</a>
        <a href="{{url('logout')}}" class="btn btn-primary my-2">Logout</a>
        @endauth
    </div>

    <div class="bg-card p-3 mt-4">
        <h5 class="text-primary">Tags</h5>
        @foreach($tag as $t)
        <a href="{{url('article?tag='.$t->id)}}" class="btn btn-sm btn-dark mt-1 text-white">{{$t->name}} </a>
        @endforeach
    </div>
    <div class="bg-card p-3 mt-4">
        <h5 class="text-primary">Programmings</h5>
        @foreach($programming as $p)
        <a href="{{url('article?programming='.$p->id)}}" class="btn btn-sm btn-dark mt-1 text-white">{{$p->name}} </a>
        @endforeach
    </div>

    <div class="bg-card p-3 mt-4">
        <h5 class="text-primary"> Top Trending Articles</h5>
        <div class="row">
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

    <div class="bg-card p-3 mt-4">
        <h5 class="text-primary"> Most Love Articles</h5>
        <div class="row">
            @foreach($popularArticles as $a)
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

</div>
