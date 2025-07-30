<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERN Blog</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/css/argon-design-system.min.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Padauk:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;1,100;1,200;1,400&display=swap"
        rel="stylesheet">
    <!-- boxicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css">
    <!-- custom style -->
    <link rel="stylesheet" href="{{asset('asset/style/style.css')}}">

    @yield('styles')
</head>

<body>
    <div class="m-5">
        <div class="row">
            <div class="col-8">
                <h2 class="text-primary bg-card p-2 pl-5 rounded">MERN Fullstack Community Blogging -
                    <span class="text-success">MMCoder</span>
                </h2>

                @yield('content')

            </div>

            <div class="col-4">

                <div class="bg-card p-3">
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
                        <div class="col-6">
                            <div class="bg-dark rounded">
                                <img src="https://toka.b-cdn.net/wp-content/uploads/2021/11/3d-aesthetics.png"
                                    class="w-100 rounded">
                                <p class="text-white text-center p-2">What is PHP</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark rounded">
                                <img src="https://toka.b-cdn.net/wp-content/uploads/2022/01/black-man-looking-stock-market-exchange-information-computer-crypto-currency.png"
                                    class="w-100 rounded">
                                <p class="text-white text-center p-2">What is PHP</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark rounded">
                                <img src="https://toka.b-cdn.net/wp-content/uploads/2022/01/black-man-looking-stock-market-exchange-information-computer-crypto-currency.png"
                                    class="w-100 rounded">
                                <p class="text-white text-center p-2">What is PHP</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark rounded">
                                <img src="https://toka.b-cdn.net/wp-content/uploads/2021/11/3d-aesthetics.png"
                                    class="w-100 rounded">
                                <p class="text-white text-center p-2">What is PHP</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-card p-3 mt-4">
                    <h5 class="text-primary"> Most Love Articles</h5>
                    <div class="row">
                        <div class="col-6">
                            <div class="bg-dark rounded">
                                <img src="https://toka.b-cdn.net/wp-content/uploads/2021/11/3d-aesthetics.png"
                                    class="w-100 rounded">
                                <p class="text-white text-center p-2">What is PHP</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark rounded">
                                <img src="https://toka.b-cdn.net/wp-content/uploads/2022/01/black-man-looking-stock-market-exchange-information-computer-crypto-currency.png"
                                    class="w-100 rounded">
                                <p class="text-white text-center p-2">What is PHP</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark rounded">
                                <img src="https://toka.b-cdn.net/wp-content/uploads/2022/01/black-man-looking-stock-market-exchange-information-computer-crypto-currency.png"
                                    class="w-100 rounded">
                                <p class="text-white text-center p-2">What is PHP</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark rounded">
                                <img src="https://toka.b-cdn.net/wp-content/uploads/2021/11/3d-aesthetics.png"
                                    class="w-100 rounded">
                                <p class="text-white text-center p-2">What is PHP</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: "{{session('success')}}"
        });
        @endif

        @if(session('error'))
        Toast.fire({
            icon: 'error',
            title: "{{session('error')}}"
        });
        @endif

        const showSuccess = (message) => {
            Toast.fire({
                icon: 'success',
                title: message
            });
        }

        const showError = (message) => {
            Toast.fire({
                icon: 'error',
                title: message
            });

        }
    </script>
    @yield('scripts')
</body>

</html>