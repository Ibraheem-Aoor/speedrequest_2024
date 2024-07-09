@extends('layouts.admin.master')
@section('page-title', $page->title)
@push('css')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .note-toolbar {
            background-color: #343a40;
            /* Dark background for the toolbar */
            color: #fff;
            /* Optional: white text color */
        }

        .note-toolbar .note-btn {
            color: #fff !important;
            /* Ensure buttons have white text */
        }
    </style>
@endpush
@section('content')
    @include('admin.partials.page_header', [
        'current_page_name' => $page->title,
        'sub_pages' => [
            $page->title => route('admin.contacts.index'),
        ],
    ])
    {{-- START FORM  --}}
    <form action="{{ route('admin.page.update', ['slug' => $page->slug]) }}" method="POST" class="custom-form">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Page Content</label>
                    <textarea id="summernote" name="content">{{ $page->content }}</textarea>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-sm-12">
                <input type="submit" class="btn btn-primary" value="{{ __('general.save') }}">
            </div><!--end col-->
        </div><!--end row-->
    </form>
    {{-- END  FORM  --}}

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onInit: function() {
                        $('.note-toolbar').addClass('bg-dark');
                    }
                }
            });

            // Set the content of the editor
            $('#summernote').summernote('code', {!! json_encode($page->content) !!});
            // Update the textarea with the Summernote content before submitting the form

        });

    </script>
@endpush
