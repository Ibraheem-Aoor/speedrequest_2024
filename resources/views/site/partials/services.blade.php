@if (!$services->isEmpty())
<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block bg-custom text-primary py-1 px-4">{{ __('site.services') }}</p>
            <h1 class="text-uppercase">{{ __('site.what_we_provide') }}</h1>
        </div>
        <div class="row g-4">
            @foreach ($services as $service)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item position-relative overflow-hidden bg-custom d-flex h-100 p-5 ps-0">
                        <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <img class="img-fluid" src="{{ getImageUrl($service->image) }}" alt="">
                        </div>
                        <div class="ps-4">
                            <h3 class="text-uppercase mb-3 text-primary">{{ $service->title }}</h3>
                            <p>{{ $service->description }}</p>
                            <span class="text-uppercase text-primary">{{ formatPrice($service->price) }}</span>
                        </div>
                        {{-- <a class="btn btn-square" href=""><i class="fa fa-plus text-primary"></i></a> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Service End -->

@endif
