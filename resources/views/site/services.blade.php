    @extends('layouts.site.master')
    @section('title' , $page_title)
    @section('content')
        @include('site.partials.services', ['service' => $services])
    @endsection
