@extends('layouts.site.master')
@section('title', $page_title)
@push('css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/home_style.css') }}">

@endpush
@section('content')
    <div class="split-screen">
        <div class="left">
            <div>
                <div class="logo r">
                    @php
                        $logo = asset('assets/common/new_logo_offical.webp');
                        if(Session::get('color_mode') == 'dark')
                        {
                            $logo = asset('assets/common/new_logo_offical_light.webp');
                        }
                    @endphp
                    <img loading="lazy" src="{{ $logo }}" alt="{{ config('app.name') }}"
                        width="50%" />
                    <p class="baskervville-sc-regular mrn-12">
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
                <h1 class="mt-5 anton-sc-regular mrnt-5"><b>Supported Apps:</b></h1>
                @foreach ($platforms as $platform)
                    <div class="app-card @if ($loop->first) full-width @endif"
                        id="{{ $platform->getCardId() }}">
                        <div class="img-container">
                            <img loading="lazy" class="image-fluid flip-vertical-left"
                                src="{{ getImageUrl($platform->logo) }}" alt="Google Play" />
                        </div>
                        <div class="card-title">{{ $platform->name }}</div>
                        <a href="{{ route('site.services', encrypt($platform->id)) }}" class="btn btn-light">Start</a>
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
                                <form action="{{ route('site.contact.submit') }}" method="POST" class="custom-form">
                                    <div class="row g-3 text-left">
                                        <div class="col-md-12">
                                            <label class="form-label text-initial" for="email">Your Email</label>
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Your Email" name="email" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="message">Message</label>

                                                <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"
                                                    name="message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn @if(Session::get('color_mode') == 'dark') btn-dark @else btn-primary @endif w-100 py-3" type="submit">
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
        </section>

    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
@endpush
