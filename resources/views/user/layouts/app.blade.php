<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogify</title>
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
        @include('user.layouts.navbar')
        @include('user.layouts.article_layout')
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