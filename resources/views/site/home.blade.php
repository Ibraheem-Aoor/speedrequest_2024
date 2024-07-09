@extends('layouts.site.master')
@section('title', $page_title)
@push('css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Anton+SC&display=swap" rel="stylesheet" />
    <style>
        /**
                                  -- Start Import Fonts
                                **/
        .baskervville-sc-regular {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
        }

        .anton-sc-regular {
            font-family: "Anton SC", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        /*
                                  -- End Import Fonts
                                */

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            /* color: white; */
            text-align: center;
            font-family: "Arial", sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .logo {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .description {
            font-size: 18px;
            margin-bottom: 40px;
        }

        .btn-light {
            background: #c00060;
            box-shadow: 0 5px 15px 0 rgba(25, 50, 165, 0.2);
            color: white;
            font-weight: bold;
            border: none;
            transition: background 0.3s;
        }

        .btn-light:hover {
            background: #bdc3c7;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .row>.col-xs-2 {
            padding: 10px;
        }

        /* Modal styles */
        .modal {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-header,
        .modal-footer {
            background: #c00060;
            color: white;
        }

        .modal-card {
            padding: 5px !important;
            border-radius: 15px;
            border-bottom: 1px solid black !important;
            color: black;
            box-shadow: 0 5px 15px 0 rgba(25, 50, 165, 0.2);
        }

        .modal-card ul {
            list-style-type: none !important;
            padding: 0;
        }

        .modal-card ul li {
            margin-bottom: 10px;
        }

        /* Split screen */
        .split-screen {
            height: 100vh;
        }

        .left {
            background-image: linear-gradient(208deg,
                    #004e92,
                    #0d80c1,
                    #34a8db,
                    #6fc1e2,
                    #93d4e6);

            justify-content: center;
            align-items: center;
            padding: 20px;
            color: white;
        }

        .right {
            background: white;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: black;
        }

        @media (max-width: 768px) {
            .left {
                clip-path: none !important;
            }

            .split-screen {
                flex-direction: column;
            }

            .split-line {
                width: 100%;
                height: 5px;
            }
        }

        .apps {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .app-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            color: white;
            box-shadow: 0 5px 15px 0 rgba(25, 50, 165, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            width: 150px;
            padding: 10px;
            text-align: center;
        }

        .app-card:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 75%;
            background: #c00060;
            box-shadow: 0 5px 15px 0 rgba(25, 50, 165, 0.2);
            z-index: 0;
        }

        .app-card.full-width {
            width: 100%;
        }

        .img-container {
            border-radius: 50%;
            margin: 0 auto;
            display: table;
            padding: 10px;
        }

        .app-card img {
            height: 80px;
            width: 80px;
            border-radius: 50% !important;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .app-card .card-title {
            position: relative;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .app-card.full-width {
                width: 100%;
                /* Make the Google Play card full width */
            }

            .app-card:not(.full-width) {
                width: calc(50% - 20px);
                /* Two cards per row with gap */
                margin-bottom: 20px;
                /* Adjust spacing between cards */
            }

            .apps {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
                /* Adjust gap between cards */
            }
        }

        .left {
            background-image: linear-gradient(208deg,
                    #004e92,
                    #0d80c1,
                    #34a8db,
                    #6fc1e2,
                    #93d4e6);
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: white;
            animation: slideLeft 1s forwards;
            margin-top: -20px;
        }

        .right {
            background: white;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            color: black;
            animation: slideUp 1s forwards;
        }

        .right .app-card {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .right .app-card:nth-child(odd) {
            animation-name: slideRight;
        }

        .right .app-card:nth-child(even) {
            animation-name: slideLeft;
        }

        @keyframes slideLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(100%);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .app-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .app-card:hover {
            transform: s(-10px) !important;
        }

        .app-card:nth-child(odd):hover {
            transform: translateX(-10px) translateY(-10px) !important;
        }

        .app-card:nth-child(even):hover {
            transform: translateX(10px) translateY(-10px) !important;
        }

        /** Image Platform Animation */

        .flip-vertical-left {
            -webkit-animation: flip-vertical-left 0.7s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite both;
            animation: flip-vertical-left 0.7s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite both;
        }

        /* ----------------------------------------------
                            * ----------------------------------------
                            * animation flip-vertical-left
                            * ----------------------------------------
                            */
        @-webkit-keyframes flip-vertical-left {
            0% {
                -webkit-transform: rotateY(0);
                transform: rotateY(0);
            }

            100% {
                -webkit-transform: rotateY(-180deg);
                transform: rotateY(-180deg);
            }
        }

        @keyframes flip-vertical-left {
            0% {
                -webkit-transform: rotateY(0);
                transform: rotateY(0);
            }

            100% {
                -webkit-transform: rotateY(-180deg);
                transform: rotateY(-180deg);
            }
        }

        /* Platform-specific colors */
        #google-card::before {
            background: linear-gradient(to bottom right, #34a853, #228b22);
        }

        #google-card .btn {
            background: linear-gradient(to bottom right, #34a853, #228b22);
            color: white;
        }

        #instagram-card::before {
            background: linear-gradient(to bottom right, #833ab4, #c13584);
        }

        #instagram-card .btn {
            background: linear-gradient(to bottom right, #833ab4, #c13584);
            color: white;
        }

        #tiktok-card::before {
            background: linear-gradient(to bottom right, #ff0000, #5800ff);
        }

        #tiktok-card .btn {
            background: linear-gradient(to bottom right, #ff0000, #5800ff);
            color: white;
        }

        #fb-card::before {
            background: linear-gradient(to bottom right, #1877f2, #04a6eb);
        }

        #fb-card .btn {
            background: linear-gradient(to bottom right, #1877f2, #04a6eb);
            color: white;
        }

        #pubg-card::before {
            background: linear-gradient(135deg, #0d1a2b, #ffc600) !important;
        }

        #pubg-card .btn {
            background: linear-gradient(135deg, #0d1a2b, #ffc600) !important;
            color: white;
        }

        #freefire-card::before {
            background: linear-gradient(135deg, #FF9500, #222222);
        }

        #freefire-card .btn {
            background: linear-gradient(135deg, #FF9500, #222222);
            color: white;
        }

        #twitter-card::before {
            background: linear-gradient(135deg, #1DA1F2, #ffffff);
        }

        #twitter-card .btn {
            background: linear-gradient(135deg, #1DA1F2, #ffffff);
            color: white;
        }

        #snapchat-card::before {
            background: linear-gradient(to bottom right, #fffc00, #ff0000);
        }

        #snapchat-card .btn {
            background: linear-gradient(to bottom right, #fffc00, #ff0000);
            color: white;
        }

        #telegram-card::before {
            background: linear-gradient(135deg, #0088cc, #ffffff);
        }

        #telegram-card .btn {
            background: linear-gradient(135deg, #0088cc, #ffffff);
            color: white;
        }


        #snapchat-card .btn {
            background: linear-gradient(to bottom right, #fffc00, #ff0000);
        }

        #youtube-card::before {
            background: linear-gradient(to bottom right, #ff0000, #ff4500);
        }

        #youtube-card .btn {
            background: linear-gradient(to bottom right, #ff0000, #ff4500);
        }


        .btn-google {
            background: linear-gradient(to bottom right, #34a853, #228b22);
            color: white !important;
        }

        .btn-instagram {
            background: linear-gradient(to bottom right, #833ab4, #fd1d1d, #fcb045);
            color: white !important;
        }

        .btn-youtube {
            background: #ff0000;
            /* Use YouTube's red color */
            color: white !important;
        }

        .btn-snapchat {
            background: #fffc00;
            /* Use Snapchat's yellow color */
            color: white;
        }

        .btn-tiktok {
            background: linear-gradient(to bottom right, #ff0000, #5800ff);
            color: white;
        }

        .btn-pubg {
            background: linear-gradient(135deg, #0d1a2b, #ffc600) !important;
            color: white !important;
        }

        .btn-freefire {
            color: white !important;
            background: linear-gradient(135deg, #FF9500, #222222);

        }

        .btn-twitter {
            background: linear-gradient(135deg, #1DA1F2, #ffffff);
            color: white !important;
        }

        .btn-twitter {
            background: linear-gradient(135deg, #0088cc, #ffffff);
            color: white !important;
        }

        .step-number {
            width: 100px !important;
            height: 100px !important;
        }

        .card-body.d-flex {
            align-items: center;
        }

        .steps-section .card-title {
            width: 100%;
            background-image: linear-gradient(208deg,
                    #004e92,
                    #0d80c1,
                    #34a8db,
                    #6fc1e2,
                    #93d4e6);
            color: white !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endpush
@section('content')
    <p style="font-size: 1px">s</p>
    <div class="split-screen">
        <div class="left">
            <div>
                <div class="logo r">
                    <img loading="lazy" src="{{ asset('assets/site/img/home-logo.webp') }}" alt="" width="60%" />
                    <p class="baskervville-sc-regular">
                        <b> SpeedRequest </b>
                    </p>
                </div>
                <div class="description anton-sc-regular">
                    Looking for free followers? Welcome, you are in the right place.
                </div>
            </div>
        </div>
        <div class="split-line"></div>
        <div class="right">
            <div class="apps">
                <h1 class="mt-5 anton-sc-regular"><b>Supported Apps:</b></h1>
                @foreach ($platforms as $platform)
                    <div class="app-card @if ($loop->first) full-width @endif"
                        id="{{ $platform->getCardId() }}">
                        <div class="img-container">
                            <img loading="lazy" class="image-fluid flip-vertical-left"
                                src="{{ getImageUrl($platform->logo) }}" alt="Google Play" />
                        </div>
                        <div class="card-title">{{ $platform->name }}</div>
                        <a href="{{ route('site.services' , encrypt($platform->id)) }}" class="btn btn-light">Start</a>
                    </div>
                @endforeach

            </div>
        </div>
        <section class="steps-section py-5 text-dark">
            <div class="container">
                <h2 class="text-center mb-4 anton-sc-regular">How to Get Started</h2>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex">
                                <div
                                    class="step-number text-white rounded-circle d-flex align-items-center justify-content-center mr-3">
                                    <img src="{{ asset('assets/site/img/choose.png') }}" alt="" width="50px"
                                        height="50px" />
                                </div>
                                <div>
                                    <h3 class="card-title">Choose App</h3>
                                    <p class="card-text">
                                        Select the social media app you want to boost your
                                        presence on.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex">
                                <div
                                    class="step-number text-white rounded-circle d-flex align-items-center justify-content-center mr-3">
                                    <img src="{{ asset('assets/site/img/task.png') }}" alt="" width="50px"
                                        height="50px" />
                                </div>

                                <div>
                                    <h3 class="card-title">Complete Task</h3>
                                    <p class="card-text">
                                        Complete a simple Task that takes less than 2 minutes.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex">
                                <div
                                    class="step-number text-white rounded-circle d-flex align-items-center justify-content-center mr-3">
                                    <img src="{{ asset('assets/site/img/complete.png') }}" alt="" width="50px"
                                        height="50px" />
                                </div>

                                <div>
                                    <h3 class="card-title">Get Result</h3>
                                    <p class="card-text">
                                        After Completeing The Task Successfully. You Will be able
                                        to get your servie
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-xxl py-5 bg-light">
            <div class="container py-5 px-lg-5 text-dark">
                <div class="wow fadeInUp" data-wow-delay="0.1s"
                    style="
              visibility: visible;
              animation-delay: 0.1s;
              animation-name: fadeInUp;
            ">
                    <h1 class="text-center mb-5 anton-sc-regular">Contact For Any Query</h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-dark">
                        <div class="wow fadeInUp" data-wow-delay="0.3s"
                            style="
                  visibility: visible;
                  animation-delay: 0.3s;
                  animation-name: fadeInUp;
                ">
                            <form action="{{ route('site.contact.submit') }}"  method="POST" class="custom-form">
                                <div class="row g-3 text-left">
                                    <div class="col-md-12">
                                        <label class="form-label text-initial" for="email">Your Email</label>
                                        <div class="form-group">

                                            <input type="email" class="form-control" id="email"
                                                placeholder="Your Email"  name="email"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="message">Message</label>

                                            <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px" name="message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">
                                            Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
@endpush
