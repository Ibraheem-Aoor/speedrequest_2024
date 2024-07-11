@extends('layouts.admin.master')
@section('page-title', __('general.dashbaord'))
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h6 class="text-muted mb-1">Welcome back, {{ getAuthUser('admin')->name }}</h6>
            <h5 class="mb-0">Dashboard</h5>
        </div>

    </div>

    <div class="row row-cols-xl-4 row-cols-md-2 row-cols-1">
        <div class="col-12 mt-4">
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

        <div class="col-12 mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-usd-circle fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">{{ __('general.platform') }}</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $platform_count }}">{{ $platform_count }}</span></p>
                    </div>
                </div>

                {{-- <span class="text-success"><i class="uil uil-arrow-growth"></i> 3.84%</span> --}}
            </a>
        </div><!--end col-->

        <div class="col-12 mt-4">
            <a href="#!"
                class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                <div class="d-flex align-items-center">
                    <div class="icon text-center rounded-pill">
                        <i class="uil uil-shopping-bag fs-4 mb-0"></i>
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 text-muted">{{ __('general.order') }}</h6>
                        <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                data-target="{{ $booking_count }}">{{ $booking_count }}</span></p>
                    </div>
                </div>

                {{-- <span class="text-success"><i class="uil uil-arrow-growth"></i> 1.46%</span> --}}
            </a>
        </div><!--end col-->

        <div class="col-12 mt-4">
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

    {{-- Start Sales And Recent Orders --}}
    <div class="row">
        <div class="col-xl-8 col-lg-7 mt-4">
            <div class="card shadow border-0 p-4 pb-0 rounded">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0 fw-bold">Site Visits</h6>

                    <div class="mb-0 position-relative d-none">
                        <select class="form-select form-control" id="yearchart">
                            <option selected>2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                        </select>
                    </div>
                </div>
                <div id="dashboard" class="apex-chart"></div>
            </div>
        </div><!--end col-->

        <div class="col-xl-4 col-lg-5 mt-4 rounded">
            <div class="col-xl-12 mt-4">
                <div class="card rounded shadow border-0 p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h6 class="mb-0">Visits By Device</h6>
                    </div>
                    <div id="device-chart"></div>
                </div>
            </div><!--end col-->
        </div><!--end col-->
    </div><!--end row-->
    {{-- End Sales And Recent Orders --}}
    <div class="row mt-5">
        {{-- Browser  Visists --}}
        <div class="col-xl-6">
            <div class="card shadow border-0">
                <div class="p-4 border-bottom">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Visits By Browser</h6>
                        <a href="#!" class="text-primary">See More <i class="uil uil-arrow-right align-middle"></i></a>
                    </div>
                </div>

                <div class="p-4" data-simplebar style="height: 365px;">
                    @foreach ($browser_visits as $visit)
                        <a href="javascript:void(0)"
                            class="features key-feature d-flex align-items-center justify-content-between mt-4">
                            <div class="d-flex align-items-center">
                                <div class="icon text-center rounded-circle me-3">
                                    @php
                                        $browserIcon = 'ti ti-world'; // Default icon path
                                        $browserName = strtolower($visit->browser);

                                        if (stripos($browserName, 'chrome') !== false) {
                                            $browserIcon = asset('assets/user/images/browsers/chrome.png');
                                        } elseif (stripos($browserName, 'firefox') !== false) {
                                            $browserIcon = asset('assets/user/images/browsers/firefox.png');
                                        } elseif (stripos($browserName, 'edge') !== false) {
                                            $browserIcon = asset('assets/user/images/browsers/edge.png');
                                        } elseif (stripos($browserName, 'safari') !== false) {
                                            $browserIcon = asset('assets/user/images/browsers/safari.png');
                                        } elseif (stripos($browserName, 'opera') !== false) {
                                            $browserIcon = asset('assets/user/images/browsers/opera.png');
                                        } else {
                                            // Default icon path if none of the above conditions match
                                            $browserIcon = asset('assets/user/images/browsers/default.png');
                                        }
                                    @endphp
                                    <img src="{{ $browserIcon }}" class="browser-icon" width="50%" height="50%"
                                        alt="{{ ucfirst($visit->browser) }} Icon">
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-dark">{{ ucfirst($visit->browser) }}</h6>
                                    <small class="text-muted">{{ $visit->visits }} Visits</small>
                                </div>
                            </div>
                            <i class="ti ti-arrow-up text-warning"></i> <!-- Replace with appropriate icon -->
                        </a>
                    @endforeach
                </div>
            </div>


        </div>
        {{-- Recent Orders --}}
        <div class="col-xl-6">
            <div class="card shadow border-0">
                <div class="p-4 border-bottom">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-bold">Latest 10 Orders</h6>
                        <a href="{{ route('admin.order.index') }}" class="text-primary">See More <i
                                class="uil uil-arrow-right align-middle"></i></a>
                    </div>
                </div>

                <div class="p-4" data-simplebar style="height: 365px;">
                    @foreach ($today_orders as $order)
                        <a href="javascript:void(0)"
                            class="features key-feature d-flex align-items-center justify-content-between mt-4">
                            <div class="d-flex align-items-center">
                                <div class="icon text-center rounded-circle me-3">
                                    <img src="{{ getImageUrl($order->service->platform->logo) }}" class="browser-icon" width="50%" height="50%"
                                        alt="{{ ($order->service->platform->name) }} Icon">
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-dark">{{ $order->service->platform->name }}</h6>
                                    <small class="text-muted">{{ $order->service->name }}</small>
                                </div>
                            </div>
                            <i class="ti ti-arrow-up text-warning"></i> <!-- Replace with appropriate icon -->
                        </a>
                    @endforeach
                </div>
            </div>


        </div>
    </div>



@endsection

@push('js')
    <script>
        // Chart 1
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    name: 'Visits',
                    data: {!! json_encode($monthly_visits) !!} // Monthly visits data
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: {!! json_encode($month_labels) !!}, // Month labels
                },
                colors: ['#556ee6'], // Customize the color as needed
                grid: {
                    borderColor: '#f1f1f1',
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#dashboard"), options);
            chart.render();
        });

        // Chart 2
        var deviceVisitsOptions = {
            series: {!! json_encode($device_visits->pluck('visits')) !!},
            chart: {
                height: 350,
                type: 'pie',
            },
            labels: {!! json_encode($device_visits->pluck('platform')) !!},
            colors: ['#556ee6', '#34c38f', '#f46a6a', '#50a5f1', '#f1b44c'], // Customize colors as needed
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center',
                verticalAlign: 'middle',
                fontSize: '14px',
                offsetX: 0,
                offsetY: -10
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: false
                    }
                }
            }]
        };

        var deviceVisitsChart = new ApexCharts(document.querySelector("#device-chart"), deviceVisitsOptions);
        deviceVisitsChart.render();
    </script>
@endpush
