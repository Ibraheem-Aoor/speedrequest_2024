@extends('layouts.site.master')
@section('title' ,$page->title )
@section('content')
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            {!! $page->content !!}
        </div>
    </div>
    <!-- About End -->
@endsection
