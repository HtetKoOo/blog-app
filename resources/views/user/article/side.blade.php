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
            <a href="{{url('article/'.$a->id)}}" class="col-6">
                <div class="bg-dark rounded">
                    <div style="
                    position:relative;
                    width:100%;
                    height: 100px;
                    border-radius:15px;
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
                            style="width:100%; height:100%; object-fit:contain; object-position:center; position:relative; z-index:1; display:block;">
                    </div>
                    <p class="text-white text-center p-2">{{$a->title}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <div class="bg-card p-3 mt-4">
        <h5 class="text-primary"> Most Love Articles</h5>
        <div class="row">
            @foreach($popularArticles as $a)
            <a href="{{url('article/'.$a->id)}}" class="col-6">
                <div class="bg-dark rounded">
                    <div style="
                    position:relative;
                    width:100%;
                    height:100px;
                    border-radius:15px;
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
                            style="width:100%; height:100%; object-fit:contain; object-position:center; position:relative; z-index:1; display:block;">
                    </div>
                    <p class="text-white text-center p-2">{{$a->title}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>

</div>