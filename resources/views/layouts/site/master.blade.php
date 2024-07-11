<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} || @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        /*** copyright Start ***/
        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: var(--bs-dark) !important;
        }

        /*** copyright end ***/
        /* Start Loader Style */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: linear-gradient(45deg, #ffffff, #ffffff);
            z-index: 9999999;
            visibility: visible;
            opacity: 1;
            transition: visibility 0s, opacity 0.5s linear;
        }

        #preloader.hidden {
            visibility: hidden;
            opacity: 0;
        }

        #preloader #status {
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        #preloader #status .spinner {
            width: 40px;
            height: 40px;
            position: relative;
            margin: 100px auto;
        }

        #preloader #status .spinner .double-bounce1,
        #preloader #status .spinner .double-bounce2 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #2f55d4;
            opacity: 0.6;
            position: absolute;
            top: 0;
            left: 0;
            animation: sk-bounce 2s infinite ease-in-out;
        }

        #preloader #status .spinner .double-bounce2 {
            animation-delay: -1s;
        }

        @keyframes sk-bounce {

            0%,
            100% {
                transform: scale(0);
            }

            50% {
                transform: scale(1);
            }
        }

        /* End Loader Style */
    </style>
    @stack('css')
</head>

<body>
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>


    @yield('content')

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4 d-none">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-12 text-center  mb-md-0">
                    <span class="text-white"><a href="#"><i
                                class="fas fa-copyright text-light me-2"></i>SpeedRequest</a>, All right
                        reserved.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- JavaScript Libraries -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LR5FVP3N39"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LR5FVP3N39');
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/user/js/admin/master.js') }}"></script>
    @stack('js')
</body>

</html>
