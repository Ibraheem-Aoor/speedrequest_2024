@extends('layouts.admin.master')
@section('page-title', __('general.dashbaord'))
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h6 class="text-muted mb-1">Welcome back, {{ getAuthUser('admin')->name }}</h6>
            <h5 class="mb-0">Dashboard</h5>
        </div>

        {{-- <div class="mb-0 position-relative">
            <select class="form-select form-control" id="dailychart">
                <option selected="">This Month</option>
                <option value="aug">August</option>
                <option value="jul">July</option>
                <option value="jun">June</option>
            </select>
        </div> --}}
    </div>

    <div class="row row-cols-xl-5 row-cols-md-2 row-cols-1">
        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-user-circle fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">{{ __('site.services') }}</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $service_count }}">{{ $service_count }}</span></p>
                    </div>
                </div>

                {{-- <span class="text-danger"><i class="uil uil-chart-down"></i> 0.5%</span> --}}
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-usd-circle fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">{{ __('general.barber') }}</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $barber_count }}">{{ $barber_count }}</span></p>
                    </div>
                </div>

                {{-- <span class="text-success"><i class="uil uil-arrow-growth"></i> 3.84%</span> --}}
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-shopping-bag fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">{{ __('general.bookings') }}</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $booking_count }}">{{ $booking_count }}</span></p>
                    </div>
                </div>

                {{-- <span class="text-success"><i class="uil uil-arrow-growth"></i> 1.46%</span> --}}
            </a>
        </div><!--end col-->

        <div class="col mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-store fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">{{ __('general.contacts') }}</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $contact_message_count }}">{{ $contact_message_count }}</span></p>
                    </div>
                </div>

                {{-- <span class="text-muted"><i class="uil uil-analysis"></i> 0.0%</span> --}}
            </a>
        </div><!--end col-->

        <div class="col mt-4 d-none">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-users-alt fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">Users</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="9">1.5</span>M</p>
                    </div>
                </div>

                <span class="text-danger"><i class="uil uil-chart-down"></i> 0.5%</span>
            </a>
        </div><!--end col-->
    </div><!--end row-->


@endsection
