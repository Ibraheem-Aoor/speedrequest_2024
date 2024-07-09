@extends('layouts.admin.master')
@section('page-title', $page?->title)
@push('css')
@endpush
@section('content')
    @include('admin.partials.page_header', [
        'current_page_name' => $page?->title,
        'sub_pages' => [
            $page?->title => route('admin.contacts.index'),
        ],
    ])
    {{-- START FORM  --}}
    <form action="{{ route('admin.page.update_home') }}" method="POST" class="custom-form" enctype="multipart/form-data">
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered" id="sliders-table">
                <thead>
                    <tr>
                        <th>{{ __('general.slider_image') }} {{ __('general.max_size', ['size' => '1MB']) }}</th>
                        <th>{{ __('general.preview') }}</th>
                        <th>{{ __('general.slider_image_text') }}</th>
                        <th>{{ __('general.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($content['sliders']))
                        @foreach ($content['sliders'] as $key => $slider)
                            <tr>
                                <td>
                                    <input type="file" name="sliders[{{ $key }}][image]" class="form-control image-input">
                                    <input type="hidden" name="sliders[{{ $key }}][existing_image]" value="{{ $slider['image'] }}">
                                </td>
                                <td>
                                    <img src="{{ getImageUrl($slider['image']) }}" alt="" width="100" height="100" class="img-preview">
                                </td>
                                <td>
                                    <input type="text" name="sliders[{{ $key }}][text]" class="form-control" value="{{ $slider['text'] }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success add-row">{{ __('general.add') }}</button>
                                    <button type="button" class="btn btn-danger delete-row">{{ __('general.delete') }}</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <input type="file" name="sliders[0][image]" class="form-control image-input">
                                <input type="hidden" name="sliders[0][existing_image]" value="">
                            </td>
                            <td>
                                <img src="" alt="" width="100" height="100" class="img-preview" style="display:none;">
                            </td>
                            <td>
                                <input type="text" name="sliders[0][text]" class="form-control">
                            </td>
                            <td>
                                <button type="button" class="btn btn-success add-row">{{ __('general.add') }}</button>
                                <button type="button" class="btn btn-danger delete-row">{{ __('general.delete') }}</button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div><!--end table-responsive-->
        <div class="row">
            <div class="col-sm-12">
                <input type="submit" class="btn btn-primary" value="{{ __('general.save') }}">
            </div><!--end col-->
        </div><!--end row-->
    </form>
    {{-- END  FORM  --}}
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Initialize the counter based on the existing sliders
        var sliderCounter = {{ isset($content['sliders']) ? count($content['sliders']) : 1 }};

        // Function to preview image
        function readURL(input, preview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(preview).attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Add new row
        $(document).on('click', '.add-row', function() {
            var newRow = `<tr>
                <td>
                    <input type="file" name="sliders[` + sliderCounter + `][image]" class="form-control image-input">
                    <input type="hidden" name="sliders[` + sliderCounter + `][existing_image]" value="">
                </td>
                <td>
                    <img src="" alt="" width="100" height="100" class="img-preview" style="display:none;">
                </td>
                <td>
                    <input type="text" name="sliders[` + sliderCounter + `][text]" class="form-control">
                </td>
                <td>
                    <button type="button" class="btn btn-success add-row">{{ __('general.add') }}</button>
                    <button type="button" class="btn btn-danger delete-row">{{ __('general.delete') }}</button>
                </td>
            </tr>`;
            $('#sliders-table tbody').append(newRow);
            sliderCounter++;
        });

        // Delete row
        $(document).on('click', '.delete-row', function() {
            $(this).closest('tr').remove();
        });

        // Image input change event
        $(document).on('change', '.image-input', function() {
            readURL(this, $(this).closest('tr').find('.img-preview'));
        });
    });
</script>
@endpush
