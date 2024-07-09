@extends('layouts.admin.master')

@section('page-title', __('general.site_settings'))

@section('content')
    @include('admin.partials.page_header', [
        'current_page_name' => __('general.site_settings'),
        'sub_pages' => [
            __('general.site_settings') => route('admin.setting.edit'),
        ],
    ])

<div class="row">
    <div class="col-12 mt-4">
        <div class="card rounded shadow">
            <div class="p-4 border-bottom">
                <h5 class="title mb-0">{{ __('general.site_settings') }}</h5>
            </div>
            <div class="p-4">
                <form action="{{ route($route . '.update') }}" method="POST" class="custom-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('general.site_address') }}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input type="text" name="address" id="address" required value="{{ @$settings['address'] }}" class="form-control">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('general.site_phone') }}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input type="text" name="phone" id="phone" required value="{{ @$settings['phone'] }}" class="form-control">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('general.site_email') }}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input type="text" name="email" id="email" required value="{{ @$settings['email'] }}" class="form-control">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('general.facebook') }}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input type="text" name="facebook" id="facebook" value="{{ @$settings['facebook'] }}" required class="form-control">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('general.twitter') }}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input type="text" name="twitter" id="twitter" value="{{ @$settings['twitter'] }}" required class="form-control">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('general.youtube') }}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input type="text" name="youtube" id="youtube" required value="{{ @$settings['youtube'] }}" class="form-control">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('general.linkedin') }}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input type="text" name="linkedin" id="linkedin" required value="{{ @$settings['linkedin'] }}" class="form-control">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">{{ __('general.location_on_google_maps') }}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input type="text" name="location" id="location" required value="{{ @$settings['location'] }}" class="form-control">
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
                </form>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->


    @include('partials.confirm-delete-modal')
@endsection

