@extends('layouts.site.master')
@section('title', 'VPN BLOCKED')
@section('content')
    <!-- ERROR PAGE -->
    <section class="bg-home d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 text-center">
                    <img src="{{ asset('assets/user/images/vpn_block.jpg') }}" style="max-width: 500px;" alt="">
                    <div class="text-capitalize text-dark mb-4 error-page"></div>
                    {{-- <p class="text-muted para-desc mx-auto">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p> --}}
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- ERROR PAGE -->
@endsection
