@extends('layouts.site.master')
@section('title', $page_title)

@section('content')
    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-custom p-5">
                        <p class="d-inline-block bg-white text-primary py-1 px-4">{{ __('site.contact_us') }}</p>
                        <h1 class="text-uppercase mb-4 text-primary">{{ __('site.have_any_query') }}</h1>
                        {{-- <p class="mb-4">{{ __('site.contact_form_inactive') }} <a href="https://htmlcodex.com/contact-form">{{ __('site.download_now') }}</a>.</p> --}}
                        <form action="{{ route('site.contact.submit') }}" class="custom-form" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="name"
                                            name="name" placeholder="{{ __('site.your_name') }}">
                                        <label for="name">{{ __('site.your_name') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" id="email"
                                            name="email" placeholder="{{ __('site.your_email') }}">
                                        <label for="email">{{ __('site.your_email') }}</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="subject"
                                            name="subject" placeholder="{{ __('site.subject') }}">
                                        <label for="subject">{{ __('site.subject') }}</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-transparent" placeholder="{{ __('site.leave_message') }}" name="message" id="message"
                                            style="height: 100px"></textarea>
                                        <label for="message">{{ __('site.message') }}</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3"
                                        type="submit">{{ __('site.send_message') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100" style="min-height: 400px;">
                        {!! @$settings['location'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
