@extends('layouts.site.master')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Anton+SC&display=swap" rel="stylesheet" />
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


        .anton-sc-regular {
            font-family: "Anton SC", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        /*** Pricing End ***/
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endpush
@section('content')
    <!-- Pricing Start -->
    <div class="container-fluid price py-5 anton-sc-regular">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">
                    <img src="{{ getImageUrl($order->service->platform->logo) }}" alt="" width="50"
                        height="50">
                    {{ $order->service->platform->name }}
                </h4>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="price-item  bg-light rounded text-center">
                        <div class="pice-item-offer">Completed</div>
                        <div class="text-center text-dark border-bottom d-flex flex-column justify-content-center p-4"
                            style="width: 100%; height: 160px;">
                            <p class="fs-2 fw-bold text-uppercase mb-0">{{ $order->service->name }}</p>
                            <div class="d-flex justify-content-center">
                            </div>
                        </div>
                        <form action="{{ route('site.confirm_order' , encrypt($order->id)) }}"  method="POST" class="custom-form">
                            <div class="text-center p-5">
                                <div class="form-group">
                                    <div class="w-100  m-auto text-start">
                                        <label class="text-left">{{ $order->service->task_title }}</label>
                                        <input type="text" name="profile" id="profile"
                                            placeholder="{{ $order->service->platform->name }} Profile"
                                            class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn  btn-soft btn-primary rounded-pill py-2 px-5 mt-4">GET
                                    {{ $order->service->name }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Pricing End -->
@endsection


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endpush
