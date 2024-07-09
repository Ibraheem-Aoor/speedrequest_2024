@extends('layouts.site.master')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

@push('css')
    <!-- Template Stylesheet -->
    <style>
        /*** Pricing Start ***/
        .price .price-item {
            position: relative;
            overflow: hidden;
            transition: 0.5s;
        }

        .price .price-item:hover {
            background: var(--bs-white) !important;
            box-shadow: 0 0 45px rgba(0, 0, 0, 0.2);
        }

        .price .price-item .pice-item-offer {
            position: absolute;
            width: 200px;
            height: 110px;
            top: -45px;
            right: -80px;
            background: var(--bs-primary) !important;
            color: var(--bs-white);
            transform: rotate(42deg);
            display: flex;
            align-items: end;
            justify-content: center;
            padding-bottom: 10px;
        }

        /*** Pricing End ***/
    </style>

@endpush
@section('content')
    <!-- Pricing Start -->
    <div class="container-fluid price py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">
                    <img src="{{ getImageUrl($platform->logo) }}" alt="" width="50" height="50">
                    {{ $platform->name }}
                </h4>
            </div>
            <div class="row g-5 justify-content-center">
                @foreach ($platform->services as $service)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="price-item bg-light rounded text-center">
                            @if ($loop->last)
                                <div class="pice-item-offer">Popular</div>
                            @endif
                            <div class="text-center text-dark border-bottom d-flex flex-column justify-content-center p-4"
                                style="width: 100%; height: 160px;">
                                <p class="fs-2 fw-bold text-uppercase mb-0">{{ $service->name }}</p>
                                <div class="d-flex justify-content-center">
                                </div>
                            </div>
                            <div class="text-start p-5">
                                @php
                                    $features = json_decode($service->features);
                                @endphp
                                @foreach ($features as $feature)
                                    <p><i class="fas fa-check text-success me-1"></i>{{ $feature }}</p>
                                @endforeach
                                <a href="{{ route('site.offer_redirect', encrypt($service->id)) }}"
                                    class="btn  btn-soft btn-primary rounded-pill py-2 px-5">Get Started</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Pricing End -->
@endsection

